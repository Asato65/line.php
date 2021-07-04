<?php 
$accessToken = "mxY+9htMhQMUjlPd9O3DEBij5buyAzhtj88zIbV4d1oWUteJ2hUh02vHmbKqjqgsZSf1baAzwNY+OYd8IrNxzixELiZi71cDY2rdunJV+LVkqUcxulvSC7lJwiz+qrjw0UXvdHn1eMs5Jf9eXTnXBgdB04t89/1O/w1cDnyilFU="; 
$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); $message = $jsonObj->{"events"}[0]->{"message"}; 
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

// それ以外は送られてきたテキストをオウム返し
$messageData = [ 'type' => 'text', 'text' => $message->{"text"} ]; 

$response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ]; 
error_log(json_encode($response)); 
$ch = curl_init('https://api.line.me/v2/bot/message/reply'); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response)); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $accessToken )); 
$result = curl_exec($ch); error_log($result); 
curl_close($ch);
