<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\AbstractSteamLoginController;
use kanalumaddela\LaravelSteamLogin\SteamUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;
class SteamLoginController extends AbstractSteamLoginController
{
    /**
     * {@inheritdoc}
     */
    public function authenticated(Request $request, SteamUser $steamUser)
    {

        $user = User::where('steamid', $steamUser->steamId)->first();

        // if the user doesn't exist, create them
        if (!$user) {
            $steamUser->getUserInfo();
            $guarded = [];
            $user = User::create([
                'username' => $steamUser->name,
                'steamid' => $steamUser->steamId,
                'avatar' => $steamUser->avatarLarge
            ]);
            $user->assignRole('User');
        }
        // login the user using the Auth facade
        Auth::login($user);
        //Cookie::queue("session", $token, "60");
        //$token = $user->createToken("token")->plainTextToken;
        // let the extended controller handle redirect back to the page the user was just on
    }
}
