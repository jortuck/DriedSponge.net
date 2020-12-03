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
        $key = config("steam-login.api_key");
        $file = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$key&steamids=76561198357728256");
        $steamUser = json_decode($file)->response->players[0];
        if(!User::where('steamid',$steamUser->steamid)->first()){
            $user = User::create([
                'username' => "DriedSponge",
                'steamid' => $steamUser->steamid,
                'avatar' => $steamUser->avatarfull
            ]);
            $user->assignRole('Owner');
            echo "\nSeeded DriedSponge\n";
        }else{
            echo "\nNo user to seed\n";
        }

    }
}
