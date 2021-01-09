<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialAccounts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
        }
        if (!$socialaccount->user) {
            $user = User::where('email',$socialresponse->email)->first();
            if($user){
                return Socialite::driver($user->social_accounts()->first()->provider)->redirect();
            }else{
                $user = User::create([
                    'username' => $socialresponse->user['username'],
                    'email' => $socialresponse->email,
                    'avatar' => $socialresponse->avatar
                ]);
                $user->assignRole('User');
                $user->social_accounts()->save($socialaccount);
                $socialaccount = SocialAccounts::where('provider', 'discord')->where('provider_id', $socialresponse->user['id'])->first();
            }

        }
        Auth::login($socialaccount->user);
        return response()->redirectTo("/");
    }
}