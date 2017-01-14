<?php
    if (isset($_REQUEST['hub_verify_token'])) {
        print_r($_REQUEST['hub_challenge']);
        exit;
    }

    $configJSON = json_decode(file_get_contents('./config.json'),true);
    $token = $configJSON['pageAccessToken'];
    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$token;

    $input = json_decode(file_get_contents('php://input'), true);
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
    $message = $input['entry'][0]['messaging'][0]['message']['text'];

    if(!empty($message)) {
        $answer = " world :)";
        $response = array(
            'recipient' => array('id' => "$sender"),
            'message' => array('text' => "$answer")
        );

        $headers = array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode($response),
                'header' => "Content-Type: application/json\n"
            )
        );
        $context = stream_context_create($headers);
        file_get_contents("$url", false, $context);
        http_response_code(200);
        /*
        $ch = curl_init("$url");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_exec($ch);
        */
    }
?>