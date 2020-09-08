<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $key = env('STEAM_LOGIN_API_KEY');
        $file = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$key&steamids=76561198357728256");
        $steamUser = json_decode($file)->response->players[0];
        $user = User::create([
            'username' => "DriedSponge",
            'steamid' => $steamUser->steamid,
            'avatar' => $steamUser->avatarfull
        ]);
        $user->assignRole('Owner');
    }
}
