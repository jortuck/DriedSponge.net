<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialAccounts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DiscordLoginController extends Auth
{
    public function auth(Request $request)
    {
        $socialresponse = \Socialite::driver('discord')->user();
        $socialaccount = SocialAccounts::where('provider', 'discord')->where('provider_id', $socialresponse->user['id'])->first();

        if (!$socialaccount) {
            $socialaccount = new SocialAccounts();
            $socialaccount->provider = "discord";
            $socialaccount->provider_id = $socialresponse->user['id'];
            $socialaccount->save();
            $user = User::create([
                'username' => $socialresponse->user['username'],
                'email' =>  $socialresponse->email,
                'avatar' => $socialresponse->avatar
            ]);
            $user->social_accounts()->save($socialaccount) ;
        }
        Auth::login($user);
        return response()->redirectTo("/");
    }
}
