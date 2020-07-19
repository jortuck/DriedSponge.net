<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;


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
            "message" => "required|max:1000"
        ]);

        if ($validator->passes()) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => '6Ld9SaQUAAAAACIaPxcErESw-6RvtljAMd3IYsQL',
                'response' => $request->captcha_token,
            ]);
            if ($response['success']) {
                $request = json_encode([
                    "content" => "",
                    "embeds" => [
                        [
                            "author" => [
                                "name" => $request->your_name . " (" . $request->email . ")"
                            ],
                            "type" => "rich",
                            "timestamp" => date("c"),
                            "fields" => array(
                                array('name' => 'Subject', 'value' => $request->subject),
                                array('name' => 'Message', 'value' => $request->message)
                            ),
                        ]
                    ]
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                $ch = curl_init(env('FEEDBACKHOOK'));
                curl_setopt_array($ch, [
                    CURLOPT_POST => 1,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => 1
                ]);
                curl_exec($ch);
                return response()->json(['success' => 'Your message has been sent!']);
            } else {
                return response()->json(['captcha' => 'Captcha failed, please try again.']);
            }
        }
        return response()->json($validator->errors());
    }
}
