<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Github extends Controller
{
    function SendGitEmbed($embed)
    {
        $response = \Http::post(config('extra.github_webhook_url'),["embeds" => [$embed]]);
    }

    function Webhook(Request $request)
    {
        $apikey = $request->header('X-Hub-Signature');
        if ($apikey != null) {
            $postBody = file_get_contents('php://input');
            if ($apikey == 'sha1=' . hash_hmac('sha1', $postBody, config('extra.github_webhook_secret'), false)) {
                if ($request->post('payload') != null) {
                    $data = json_decode($request->post('payload'), true);
                    $repo = $data['repository'];
                    $sender = $data['sender'];
                    switch ($request->header('X-GitHub-Event')) {
                        default:
                            return response()->json(['success' => false, 'message' => 'No action for this method'], 200);
                        case "push":
                            $commits = $data['commits'];
                            $fields = array();
                            $ccount = count($commits);
                            if ($ccount != 0) {
                                foreach ($commits as $commit) {
                                    if (strpos($commit['message'], "***") !== false) {
                                        $value = "*Commit message hidden*";
                                    } else {
                                        $value = $commit['message'];
                                    }
                                    array_push($fields, array("name" => $commit['committer']['username'] . " - " . date("n/j/Y g:i A", strtotime($commit['timestamp'])), "value" => $value));
                                }
                                $embed = array(
                                    "author" => array("name" => $sender['login'], "icon_url" => $sender['avatar_url'], "url" => $sender['html_url']),
                                    "title" => "Pushed " . $ccount . " commits to " . '[' . $repo['name'] . ':' . explode('/', $data['ref'])[2] . ']',
                                    "type" => "rich",
                                    "url" => $data['compare'],
                                    "color" => hexdec("FCA326"),
                                    "timestamp" => date("c"),
                                    "fields" => $fields,
                                );
                                $this->SendGitEmbed($embed);
                                return response()->json(['success' => true, 'message' => 'Push webhook success'], 200);
                            }
                            return response()->json(['success' => false, 'message' => 'Error with payload'], 200);
                        case "pull_request":
                            if ($data['action'] == 'closed' && $data['pull_request']['merged']) {
                                $embed = array(
                                    "author" => array("name" => $sender['login'], "icon_url" => $sender['avatar_url'], "url" => $sender['html_url']),
                                    "title" => "Merged changes from [" . $data['pull_request']['head']['label'] . "] into [" . $data['pull_request']['base']['label'] . "]",
                                    "type" => "rich",
                                    "url" => $data['pull_request']['html_url'],
                                    "color" => hexdec("FCA326"),
                                    "timestamp" => date("c"),
                                );
                                $this->SendGitEmbed($embed);
                                return response()->json(['success' => true, 'message' => 'Pull request webhook success'], 200);
                            }
                            return response()->json(['success' => true, 'message' => 'Pull request must be closing and merged'], 400);
                    }
                }
                return response()->json(['success' => false, 'message' => 'No payload attached'], 400);
            } else {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
        }
        return response()->json(['success' => false, 'message' => "Unauthenticated"], 401);
    }
}
