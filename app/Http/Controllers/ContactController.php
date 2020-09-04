<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use App\ContactResponses;

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
            "your_name" => "required|max:150",
            "email" => "required|max:150|email:rfc,dns,spoof",
            "subject" => "required|max:256",
            "message" => "required|max:2000"
        ]);
        if ($validator->passes()) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('CAPTCHASECRET',null),
                'response' => $request->captcha_token,
            ]);
            if ($response['success']) {
                $data = new ContactResponses();
                $data->Name = $request->your_name;
                $data->Email = $request->email;
                $data->Subject = $request->subject;
                $data->Message = $request->message;
                $data->save();
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("no-reply@driedsponge.net", "DriedSponge.net");
                $email->setSubject('[Contact Form] '.$request->subject);
                $email->addTo("jordan@driedsponge.net", "Jordan Tucker");
                $email->setReplyTo($request->email);
                $email->addContent(
                    "text/html", "DriedSponge.net Contact Form<br><hr><br><strong>Sender:</strong> $data->Name ($request->email)<br><strong>Subject:</strong>  $data->Subject<br><br>$request->message"
                );
                $sendgrid = new \SendGrid(env('SENDGRID_API_KEY',null));
                try {
                    $response = $sendgrid->send($email);
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
                    $ch = curl_init(env('FEEDBACKHOOK',null));
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
