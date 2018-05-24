<?php
header('Content-Type: application/json');
//connecting to the database
$connect = mysqli_connect("localhost","root","root","jobWizard");
//fetching all companies and their counties  from inner API
$cData = json_decode(file_get_contents('http://localhost:8888/dissertation/companiesPerCounty.php'), true);
$numOfCompany = array();
$county = array();
for($i=0; $i<sizeof($cData); $i++){
  $numOfCompany[$i]= $cData[$i]['companies'];
  $county[$i]= $cData[$i]['county'];
}
//setting the token and specific api request URL for each county
$apiToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
for($i=0; $i<sizeof($cData);$i++){
$apiURL[] = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . $county[$i] . '.json?access_token=' . $apiToken . '&country=gb&limit=1';
$county_data[]= json_decode(file_get_contents($apiURL[$i]), true);
}
//capturing logitude and latitude for each county
for($i=0; $i<sizeof($cData);$i++){
  $longitude[$i] = $county_data[$i]['features'][0]['center'][0];
  $latitude[$i] =  $county_data[$i]['features'][0]['center'][1];
}
//forming the associative array to be inserted in the database
for($i=0; $i<sizeof($cData);$i++){
  $companyPerLocation [$i]["county"] = $county[$i];
  $companyPerLocation [$i]["longitude"] = $longitude[$i];
  $companyPerLocation [$i]["latitude"] = $latitude[$i];
}

for ($j=0;$j<sizeof($cData);$j++){
  $query = "Insert into Location_Detail(Location, Latitude, Longitude) values ('".  $companyPerLocation [$j]["County"] ."',".  $companyPerLocation [$j]["latitude"]  .",".  $companyPerLocation [$j]["longitude"] .")";
  $result = mysqli_query($connect, $query);
}
?>
