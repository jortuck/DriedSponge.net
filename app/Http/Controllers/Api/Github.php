<?php

namespace App\Http\Controllers\Api;

use App\ApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Github extends Controller
{
    function Webhook(Request $request){
        $apikey = $request->header('HTTP_X_HUB_SIGNATURE');
        if($apikey!=''){
            if (ApiKey::authed($request->get('api_token'))) {
                $key = ApiKey::where('api_token', $request->get('api_token'))->first();
                if ($key->hasPermissionTo('GitHubWebhook', 'api')) {
                    if($request->post('payload')!=null){
                        $data = json_decode($request->post('payload'), true);
                        $config = $data['config'];
                        $repo = $data['repository'];
                        $owner = $repo['owner'];
                        $sender = $data['sender'];
                        switch ($request->header('HTTP_X_GITHUB_EVENT')){
                            case "push":
                                $commits = $data['commits'];
                                $fields = array();
                                $ccount = count($commits);
                                if ($ccount != 0) {
                                    foreach ($commits as $commit) {
                                        $commtlink = $commit['url'];
                                        if (strpos($commit['message'], "!hide") !== false) {
                                            $value = "*Commit message hidden*";
                                        } else {
                                            $value = "([`Link`]($commtlink)) " . $commit['message'];
                                        }
                                        array_push($fields, array("name" => "Commit from " . $commit['committer']['username'] . " - " . date("n/j/Y g:i A", strtotime($commit['timestamp'])), "value" => $value));
                                    }
                                    $embed = array(
                                        "author" => array("name" => $sender['login'], "icon_url" => $sender['avatar_url'], "url" => $sender['html_url']),
                                        "title" =>  "Pushed " . $ccount . " commits to " . $repo['name'],
                                        "type" => "rich",
                                        "url" => $repo['html_url'],
                                        "color" => hexdec("FCA326"),
                                        "timestamp" => date("c"),
                                        "fields" => $fields,
                                        "footer" => array("text" => "Powered by myself")
                                    );
                                    return response()->json(['success' => true,'message' => 'No payload attached'],200);

                                }
                        }
                    }
                    return response()->json(['success' => false,'message' => 'No payload attached'],200);
                }else{
                    return response()->json(['success' => false,'message' => 'Authenticated'],403);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Unauthorized'],403);
            }
        }
        return response()->json(['success' => false,'message' => 'Unauthenticated'],401);
    }
}
