<?php 
   function sendMessage($phone, $message){
    $senderId="NSUJSR";
    $serverUrl="msg.msgclub.net";
    $authKey="6a4743a8355fb97aa42dc2452185a1cd";
    $routeId="1";
    $postData = array(
        'mobileNumbers' => $phone,
        'smsContent' => $message,
        'senderId' => $senderId,
        'routeId' => $routeId,
        "smsContentType" =>'english'
    );
    $data_json = json_encode($postData);
    $url="http://".$serverUrl."/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey;
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json','Content-Length: ' . strlen($data_json)),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
    ));
    curl_exec($ch);
}
