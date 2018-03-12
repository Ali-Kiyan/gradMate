<?php
header('Content-Type: application/json');
$city = 'Manchester';
$cData = json_decode(file_get_contents('http://localhost:8888/dissertation/companiesPerCounty.php'), true);
$numOfCompany = array();
$city = array();
foreach($cData as $eachCity){
  $numOfCompany[]= $eachCity[0];
  $city[]= $eachCity[1];
}
var_dump($numOfCompany);
var_dump($city);
die();







$apiToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
$apiURL = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . $city . '.json?access_token=' . $apiToken . '&country=gb&limit=1';
// $connect = mysqli_connect("localhost","root","root","jobWizard");
// $query = "select distinct count(company_name) as companies, town from company group by county ";
// $result = mysqli_query($connect, $query);
// $json_array = array();
// while($row = mysqli_fetch_array($result))
// {
//   $json_array[] = $row;
//
// }
// // var_dump($json_array);
// $cPerCounty = json_encode($json_array);
// echo $cPerCounty;

// $cities = [a,s,s];
// for($i=0; $i<sizeof($cities);$i++){
//   echo "hi";
// }

$city_data = file_get_contents($apiURL);
$mapboxContent = json_decode($city_data, true);
$longitude = $mapboxContent['features'][0]['center'][0];
$latitude =  $mapboxContent['features'][0]['center'][1];
$numOfCompany = 10;
$cities[0]['long']=$longitude;
$cities[0]['lat']=$latitude;
$cities[0]['city']=$city;
$cities[0]['numOfCompany']=$numOfCompany;
$cities[1]['long']=-2.9915726;
$cities[1]['lat']=53.4083714 ;
$cities[1]['city']='Liverpool';
$cities[1]['numOfCompany']=100;
$cities[2]['long']=-2.1;
$cities[2]['lat']=54.4083714 ;
$cities[2]['city']='aa';
$cities[2]['numOfCompany']=15000;
$apiData = json_encode($cities);
echo $apiData;
?>
