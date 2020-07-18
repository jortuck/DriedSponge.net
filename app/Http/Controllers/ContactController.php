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
            "your_name" => "required|max:50",
            "email" => "required|email:rfc,dns,spoof",
            "subject" => "required|max:50",
            "message" => "required|max:1000"
        ]);
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => getenv('CAPTCHASECRET'),
            'response' => $request->captcha_token,
        ]);
        if($response['success']){
            if ($validator->passes()) {
                return response()->json(['success' => 'Your message has been sent!']);
            }
            return response()->json($validator->errors());
        }else{
            return response()->json(['captcha' => 'Captcha failed, please try again.']);
        }
    }
}

