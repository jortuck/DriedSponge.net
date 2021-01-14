<?php

namespace App\Http\Controllers\Auth;

use App\Models\SocialAccounts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class DiscordLoginController extends Auth
{
    public function auth(Request $request)
    {
        $socialresponse = Socialite::driver('discord')->user();
        $socialaccount = SocialAccounts::where('provider', 'discord')->where('provider_id', $socialresponse->user['id'])->first();
        if (!$socialaccount) {
            $socialaccount = new SocialAccounts();
            $socialaccount->provider = "discord";
        }

        $socialaccount->updateInfo($socialresponse);
        $connections = collect(Http::withToken($socialresponse->token)->get('https://discord.com/api/users/@me/connections')->json())->keyBy('type');
        if (!$socialaccount->user) {
            $user = User::where('email', $socialresponse->email)->first();
            if ($user) {
                if ($connections->has('github') && $connections->get('github')["verified"] && $connections->get('github')['id'] == $user->socialId("github")) {
                    $user->social_accounts()->save($socialaccount);
                    Auth::login($user);
                    return response()->redirectTo("/");
                }
                return redirect()->route('spa', ['home'])->with('error',
                    'There is an account that already exist with that email. Log into that account using github, and link your discord in order to login using discord.');
            } else {
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

        $user = $socialaccount->user;

        if ($connections->has('github') && $connections->get('github')['verified']) {
            $user->linkSocial('github', $connections->get('github')['id']);
        }

        Auth::login($socialaccount->user);
        return response()->redirectTo("/");
    }
}
