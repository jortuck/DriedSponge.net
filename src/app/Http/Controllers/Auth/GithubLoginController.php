<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialAccounts;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubLoginController extends Auth
{
    public function auth(Request $request)
    {
        $socialresponse = Socialite::driver('github')->user();
        $socialaccount = SocialAccounts::where('provider', 'discord')->where('provider_id', $socialresponse->user['id'])->first();
        if (!$socialaccount) {
            $socialaccount = new SocialAccounts();
            $socialaccount->provider = "github";
        }

        $socialaccount->provider_id = $socialresponse->id;
        $socialaccount->provider_username = $socialresponse->nickname;
        $socialaccount->provider_email = $socialresponse->email;
        $socialaccount->provider_avatar = $socialresponse->avatar;
        $socialaccount->provider_token = $socialresponse->token;
        $socialaccount->provider_refresh_token = $socialresponse->refreshToken;
        $socialaccount->token_expires = Carbon::now()->addSeconds($socialresponse->expiresIn);
        $socialaccount->save();

        if (!$socialaccount->user) {
            $user = User::where('email',$socialresponse->email)->first();
            if($user){
                return redirect()->route('spa',['home'])->with('error',
                    'There is an account that already exist with that email. Log into that account using discord, and link your github in order to login using github.');
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
