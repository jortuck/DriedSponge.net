<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class FeedBackController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedback.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::guest()){
            return response()->json(['error' => 'Session expired']);
        }else{
        $user = User::find(auth()->user()->steamid);
        if(!$user->IsBanned()){
        $validator =  Validator::make($request->all(),[
            "subject" => "required|min:3|max:25",
            "message" => "required|min:10|max:1000"
        ]);
        if ($validator->passes()) {
            $request = json_encode([
                "content" => "",
                "embeds" => [
                    [
                        "author" => [
                            "name" => Auth::user()->username . " (" . Auth::user()->steamid . ")",
                            "icon_url" => Auth::user()->avatar
                        ],
                        "title" => "DriedSponge.net - Feedback - $request->subject",
                        "type" => "rich",
                        "description" =>  $request->message,
                        "timestamp" => date("c"),
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
            return response()->json(['success' => 'Message has been posted!']);
        }
        return response()->json($validator->errors());
    }else{
        return response()->json(['error' => 'You are banned for <b>'.$user->Bans->reason.'</b>']);

    }
}

}

   
}
