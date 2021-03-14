<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Mail;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use App\Models\ContactResponses;
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
            "captcha" => "required",
            "name" => "required|max:150",
            "email" => "required|max:150|email:rfc,dns,spoof",
            "subject" => "required|max:256",
            "message" => "required|max:2000"
        ]);
        if ($validator->passes()) {
            // We have to check teh captcha after everything else has been validated, other wise the user will have to redo the captcha every single time
            // which would be annoying for them
            if (Validator::make($request->all(), ["captcha"=>new Captcha()])->passes()) {
                $data = new ContactResponses();
                $data->Name = $request->name;
                $data->Email = $request->email;
                $data->Subject = $request->subject;
                $data->Message = $request->message;
                $data->save();
                if (!App::environment('local')) {
                    Mail::to('jordan@driedsponge.net')->send(new ContactForm($data));
                }
                $embed = [
                    "type" => "rich",
                    "title" => "New Contact Form Response",
                    "description" => "**Sender:** $data->Name ($data->Email)\n**Subject:** $data->Subject",
                    "timestamp" => date("c"),
                    "color" => hexdec("00BE16"),
                ];
                $response = \Http::post(config('extra.discord_notification_hook'), ["embeds" => [$embed]]);
                return response()->json(['success' => 'Your message has been sent!'], 201);
            } else {
                return response()->json(['captcha' => ['You failed the captcha. Please try it again.']], 400);
            }
        }
        return response()->json($validator->errors(), 400);
    }
}
