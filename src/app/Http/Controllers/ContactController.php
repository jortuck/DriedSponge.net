<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\User;
use Illuminate\Http\Response;
use Mail;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use App\ContactResponses;
use Mailgun\Mailgun;
class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "captcha_token" => "required",
            "name" => "required|max:150",
            "email" => "required|max:150|email:rfc,dns,spoof",
            "subject" => "required|max:256",
            "message" => "required|max:2000"
        ]);
        if ($validator->passes()) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('extra.captcha_secret'),
                'response' => $request->captcha_token,
            ]);
            if ($response['success']) {
                $data = new ContactResponses();
                $data->Name = $request->name;
                $data->Email = $request->email;
                $data->Subject = $request->subject;
                $data->Message = $request->message;
                $data->save();
                Mail::to('jordan@driedsponge.net')->send(new ContactForm($data));
                try {
                    $request = json_encode([
                        "content" => "",
                        "embeds" => [
                            [
                                "type" => "rich",
                                "title"=>"New Contact Form Response",
                                "description"=>"**Sender:** $data->Name ($data->Email)\n**Subject:** $data->Subject",
                                "timestamp" => date("c"),
                                "color"=> hexdec("00BE16"),
                            ]
                        ]
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                    $ch = curl_init(config('extra.discord_notification_hook'));
                    curl_setopt_array($ch, [
                        CURLOPT_POST => 1,
                        CURLOPT_FOLLOWLOCATION => 1,
                        CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                        CURLOPT_POSTFIELDS => $request,
                        CURLOPT_RETURNTRANSFER => 1
                    ]);
                    curl_exec($ch);
                    return response()->json(['success' => 'Your message has been sent!']);
                } catch (Exception $e) {
                    return response()->json(['error' => 'Message failed to send, please try again later']);
                }
            } else {
                return response()->json(['captcha' => 'Captcha failed, please try again.']);
            }
        }
        return response()->json($validator->errors());
    }
}
