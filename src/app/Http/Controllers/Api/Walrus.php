<?php

namespace App\Http\Controllers\Api;

use App\ApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Walrus extends Controller
{
    function Facts(Request $request){
        $keys = ApiKey::where('api_token', $request->get('api_token'))->first();
        $key = ApiKey::find($keys->id);
        $key->UpdateUsage();
        if ($key->hasPermissionTo('WalrusFacts', 'api')) {
            $facts = array(
                ['fact'=>'The greatest threat to walruses is climate change', 'message'=>'Melting sea ice means more Pacific walruses are resting on land, further from their feeding grounds. These ever growing gatherings can be deadly, especially for young calves. And as the Arctic opens up to more shipping, tourism, industry and noise, the Atlantic walruses are at greater threat of disturbance, and therefore stampedes.'],
                ['fact'=>'Walruses are highly susceptible to disturbance and noise', 'message'=>'During their mass gatherings, stampedes can occur as easily spooked walruses attempt to reach the water.'],
                ['fact'=>'Atlantic walruses prefer to rest ashore', 'message'=>'Unlike Pacific walruses, Atlantic walruses prefer to rest ashore, as most feeding grounds in the Atlantic are closer to land.'],
                ['fact'=>'Pacific walruses spend spring and summer feeding over a huge continental shelf', 'message'=>'They feed on the shallow continental shelf in the Chukchi Sea. These walruses use sea ice for resting between feeding bouts, breeding, giving birth and nursing their young, as well as for shelter from rough seas and predators.'],
                ['fact'=>'Walruses are rarely found in deep water', 'message'=>'They seem to prefer feeding at the bottom of shallow waters, eating clams, molluscs, worms, snails, soft shell crabs, shrimp and sea cucumbers. Tasty.'],
                ['fact'=>'They can live to around 40 years old', 'message'=>'And it shows. Most of them carry a vast map scars on their skin – wounds inflicted in disputes with fellow walrus during the breeding season.'],
                ['fact'=>'Mother walruses are very protective of their young', 'message'=>'A mother will pick a calf up with her flippers and hold it to her chest if it’s threatened, diving into the water with it to escape predators. Walruses have young fairly infrequently, so it is vital for them to protect their offspring.'],
                ['fact'=>'Both male and female walruses have large tusks', 'message'=>'They use these tusks to help them haul themselves out of the water and onto sea ice. Their tusks are also used for fighting with other walruses, and defence against predators.'],
                ['fact'=>'They weigh a tonne', 'message'=>'Male Pacific walruses can reach 3.6 m long and weigh over 1,500kg (that’s 1.5 tonnes!). And big is beautiful – they need fat to stay alive.'],
                ['fact'=>'There are two main subspecies of walrus', 'message'=>'The Atlantic and Pacific – which both occupy different areas of the Arctic. There\'s thought to be around 25,000 Atlantic and around 200,000 Pacific walrus in the wild.']
            );
            $rand = array_rand ($facts,1);
            return response()->json(['success' => true, 'data' => ['fact'=>$facts[$rand]['fact'],'message'=>$facts[$rand]['message']]],200);


        }else{
            return response()->json(['success' => false, 'message' => 'Unauthorized'],403);
        }
    }
}
