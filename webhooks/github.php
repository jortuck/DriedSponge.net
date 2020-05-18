<?php
$secret = $_ENV['GITHUB_SECRET'];
function SendGitEmbed($embed)
{
    $request = json_encode([
        "content" => "",
        "embeds" => [$embed]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init($_ENV['GUTHUB_WEBHOOKURL']);

    curl_setopt_array($ch, [
        CURLOPT_POST => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_HTTPHEADER => array("Content-type: application/json"),
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_RETURNTRANSFER => 1
    ]);


    curl_exec($ch);
}
if (isset($_POST['payload'])) {
    $postBody = file_get_contents('php://input');
    $ContentType = 'application/json';
    $data = json_decode($_POST['payload'], true);
    //$hook = $data['hook'];
    //$events = $hook['events'];
    $config = $data['config'];
    $repo = $data['repository'];
    $owner = $repo['owner'];
    $sender = $data['sender'];
    if (isset($_SERVER['HTTP_X_HUB_SIGNATURE']) && 'sha1=' . hash_hmac('sha1', $postBody, $secret, false) === $_SERVER['HTTP_X_HUB_SIGNATURE']) {

        if ($_SERVER['HTTP_X_GITHUB_EVENT'] == "push") {
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
                SendGitEmbed($embed);
            }
        }
        if ($_SERVER['HTTP_X_GITHUB_EVENT'] == "issues") {
            $issue = $data['issue'];
            $author = $issue['user'];
            if ($data['action'] == 'opened') {
                $embed = array(
                    "author" => array("name" => $author['login'], "icon_url" => $author['avatar_url'], "url" => $author['html_url']),
                    "title" =>  "New issue: " . $issue['title'],
                    "type" => "rich",
                    "url" => $issue['html_url'],
                    "color" => hexdec("FF0000"),
                    "timestamp" => date("c"),
                    "footer" => array("text" => "Powered by myself"),
                    "fields" => array(
                        array("name" => "Created At", "value" => date("n/j/Y g:i A", strtotime($issue['created_at'])), "inline" => false),
                        array("name" => "Repository", "value" => "[" . $repo['name'] . "](" . $repo['html_url'] . ") " . $commit['message'], "inline" => true),
                        array("name" => "Number", "value" => $issue['number'], "inline" => true)
                    )
                );
                SendGitEmbed($embed);
            } else if ($data['action'] == 'closed') {
                $embed = array(
                    "author" => array("name" => $sender['login'], "icon_url" => $sender['avatar_url'], "url" => $sender['html_url']),
                    "title" =>  "Issue closed: " . $issue['title'],
                    "type" => "rich",
                    "url" => $issue['html_url'],
                    "color" => hexdec("0CFF00"),
                    "timestamp" => date("c"),
                    "footer" => array("text" => "Powered by myself"),
                    "fields" => array(
                        array("name" => "Closed At", "value" => date("n/j/Y g:i A", strtotime($issue['closed_at'])), "inline" => false),
                        array("name" => "Repository", "value" => "[" . $repo['name'] . "](" . $repo['html_url'] . ") " . $commit['message'], "inline" => true),
                        array("name" => "Number", "value" => $issue['number'], "inline" => true)
                    )
                );
                SendGitEmbed($embed);
            }
        }

        if ($_SERVER['HTTP_X_GITHUB_EVENT'] == "release") {
            $release = $data['release'];
            $author = $release['author'];
            if ($data['action'] == 'created') {
                if($release['prerelease']){
                    $type = "New Pre-release";
                }else if($release['draft']){
                    $type = "New Draft Release";
                }else{
                    $type = "New Release";
                }
                $embed = array(
                    "author" => array("name" => $author['login'], "icon_url" => $author['avatar_url'], "url" => $author['html_url']),
                    "title" =>  $type.": " . $release['name'],
                    "type" => "rich",
                    "url" => $release['html_url'],
                    "color" => hexdec("007BFF"),
                    "timestamp" => date("c"),
                    "footer" => array("text" => "Powered by myself"),
                    "fields" => array(
                        array("name" => "Created At", "value" => date("n/j/Y g:i A", strtotime($issue['created_at'])), "inline" => false),
                        array("name" => "Repository", "value" => "[" . $repo['name'] . "](" . $repo['html_url'] . ") " . $commit['message'], "inline" => true),
                        array("name" => "Version Tag", "value" => "`" . $release['tag_name'] . "`", "inline" => true)
                    )
                );
                SendGitEmbed($embed);
            }
        }
    } else {
        echo "Invalid Token<br>";
    }
} else {
    echo "Unauthorized<br>";
}
