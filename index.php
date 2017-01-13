<?php 
    $challenge = $_REQUEST['hub_challenge'];
    $verify_token = $_REQUEST['hub_verify_token'];

    if ($verify_token === 'EAAPZB8zxquycBAN6dZCLjGdnsZBgj3pHZC49KiyOkZA6jlX9PJYqBKSZBCCAVg2PhwWBjCl78zsUwBOpzamFIRHBrWrg7HQy0ufYE1g5n5k1yuUE5jZAZC4Kv2INkNMNeLi3UAyi62veiaOsr5BDCLEUBEqwWOXTNsICZCxHCMZBCz8AZDZD') {
        echo $challenge;
    }
    //Token of app
    $row = "EAAPZB8zxquycBAN6dZCLjGdnsZBgj3pHZC49KiyOkZA6jlX9PJYqBKSZBCCAVg2PhwWBjCl78zsUwBOpzamFIRHBrWrg7HQy0ufYE1g5n5k1yuUE5jZAZC4Kv2INkNMNeLi3UAyi62veiaOsr5BDCLEUBEqwWOXTNsICZCxHCMZBCz8AZDZD";


    $input = json_decode(file_get_contents('php://input'), true);

    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
    $message = $input['entry'][0]['messaging'][0]['message']['text'];

    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$row;

    $ch = curl_init($url);

    //Answer to the message adds 1
    if($message)
    {
    $jsonData = '{
        "recipient":{
            "id":"'.$sender.'"
        }, 
        "message":{
            "text":"'.$message. ' 1' .'"
        }
    }';
    };

    $json_enc = $jsonData;

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_enc);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  

    if(!empty($input['entry'][0]['messaging'][0]['message'])){
        $result = curl_exec($ch);
    }
?>