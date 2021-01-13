<?php

namespace Database\Seeders;

use App\Models\SocialAccounts;
use App\Models\User;
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
        if(!User::where('email',"ADMIN_EMAIL")->first()){
            $user = User::create([
                'username' => "DriedSponge",
                'email' => config('app.adminemail'),
                'avatar' => "https://avatars0.githubusercontent.com/u/47679132?s=460&u=3c95ff256901a64a085bc2237c389d177d041b09&v=4"
            ]);

            $socialaccount = SocialAccounts::create([
               "provider"=>'discord',
                "provider_id"=>"283710670409826304"
            ]);
            $user->assignRole('Owner');
            $user->social_accounts()->save($socialaccount);
            echo "\nSeeded DriedSponge\n";
        }else{
            echo "\nNo user to seed\n";
        }
    }
}
