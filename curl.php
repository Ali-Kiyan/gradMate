<?php

$url = "http://localhost:8888/dissertation/coordinate.php";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER,1);
$response = curl_exec($client);
echo $response;
echo "hi";




?>
