<?php

$url = "http://localhost:8888/dissertation/coordinate.php";
$client = curl_init();
$curl_setopt($client, CURL_URL, $url);
$curlcurl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$curlcurl_setopt($client, CURLOPT_POST, 1);
$curlcurl_setopt($client, CURLOPT_POST, 1);
//for setting it in a seperate variable you have to enable a curl option

// curl_setopt($client, CURLOPT_RETURNTRANSFER,1);
//for posting the data with curl
// curl_setopt($client, CURLOPT_POST,$data);


$response = curl_exec($client);
echo $client;
$result= json_decode($response);
var_dump($result);




?>
