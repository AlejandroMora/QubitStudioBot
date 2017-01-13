<?php 
    $challenge = $_REQUEST['hub_challenge'];
    $verify_token = $_REQUEST['hub_verify_token'];
    
    //if ($verify_token === 'TOKENAPP') {
        echo $challenge;
    /*}
    $row = "TOKENAPP";
    $input = json_decode(file_get_contents('php://input'), true);
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
    $message = $input['entry'][0]['messaging'][0]['message']['text'];

    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$row;*/
?>