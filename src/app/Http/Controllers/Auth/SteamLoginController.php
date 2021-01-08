<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\AbstractSteamLoginController;
use kanalumaddela\LaravelSteamLogin\SteamUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Laravel\Sanctum\NewAccessToken;
class SteamLoginController extends Auth
{
    /**
     * {@inheritdoc}
     */
    public function auth(Request $request)
    {
        $socialresponse = \Socialite::driver('steam')->user();
        $user = User::where('steamid', $socialresponse->user)->first();
        if (!$user) {
            $guarded = [];
            $user = User::create([
                'username' => $user->nickname,
                'steamid' => $user->id,
                'avatar' => $user->avatar
            ]);
            $user->assignRole('User');
        }
        // login the user using the Auth facade
        Auth::login($user);
        return response()->redirectTo("/");
    }
}
