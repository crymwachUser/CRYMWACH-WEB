<?php

function sendSMS($phone, $messages)
{

    $message = [
        "secret" => "70bbf69ca9e5c6ac9d8c54b7bebcfee1c0592d99", // your API secret from (Tools -> API Keys) page
        "mode" => "devices",
        "device" => "00000000-0000-0000-9467-a36e8965f371",
        "sim" => 1,
        "priority" => 1,
        "phone" => "$phone",
        "message" => "$messages"
    ];

    $cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
    $response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($response, true);

    // do something with response
    print_r($result);
}

if (isset($_POST['sendSMS'])) {
    $phone = $_POST['phone'];
    $messages = $_POST['message'];

    sendSMS($phone, $messages);
}
