<?php 
    $configJSON = json_decode(file_get_contents('./config.json'));
    $token = $configJSON['appAccessToken'];
    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$token;

    $input = json_decode(file_get_contents('php://input'), true);
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
    $message = $input['entry'][0]['messaging'][0]['message']['text']; 

    $response = array(
        'recipient' => array('id' => "$sender"),
        'message' => array('text' => "I am an automated bot.")
    );
    $headers = array(
        'http' => array(
            'method' => 'POST',
            'content' => json_encode($response),
            'header' => "Content-Type: application/json\n"
        )
    );

    $context = stream_context_create($headers);
    file_get_contents($url, false, $context);
?>