<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://gladtidingsdata.com/api/user/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Token 879da00ad592407688498842773d4bb85238594b',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
 file_put_contents("balance.txt", $response);
   $res = json_decode($response, true);
 $time=date("d-M-y  h:i A");
curl_close($curl);
echo $response;
?>