<?php

$url = "http://localhost:8888/dissertation/coordinate.php";
$client = curl_init($url);
//for setting it in a seperate variable you have to enable a curl option

curl_setopt($client, CURLOPT_RETURNTRANSFER,1);
//for posting the data with curl
// curl_setopt($client, CURLOPT_POST,$data);


$response = curl_exec($client);
echo $client;
$result= json_decode($response);
var_dump($result);




?>
