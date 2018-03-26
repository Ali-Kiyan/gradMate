<?php
header('Content-Type: application/json');
$cData = json_decode(file_get_contents('http://localhost:8888/dissertation/companiesPerCounty.php'), true);
$numOfCompany = array();
$city = array();
for($i=0; $i<1; $i++){
  $numOfCompany[$i]= $cData[$i]['companies'];
  $city[$i]= $cData[$i]['county'];
}

$apiToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
for($i=0; $i<1;$i++){
$apiURL[] = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . $city[$i] . '.json?access_token=' . $apiToken . '&country=gb&limit=1';
$city_data[]= json_decode(file_get_contents($apiURL[$i]), true);
}
for($i=0; $i<1;$i++){
  $longitude[$i] = $city_data[$i]['features'][0]['center'][0];
  $latitude[$i] =  $city_data[$i]['features'][0]['center'][1];
}

for($i=0; $i<1; $i++){
  $companyPerCity [$i]["numOfCompany"] = $numOfCompany[$i];
  $companyPerCity [$i]["town"] = $city[$i];
  $companyPerCity [$i]["lon"] = $longitude[$i];
  $companyPerCity [$i]["lat"] = $latitude[$i];
}
$apiData = json_encode($companyPerCity);
echo $apiData;




//
// $apiToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
// $apiURL = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . $city . '.json?access_token=' . $apiToken . '&country=gb&limit=1';
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
//
// $city_data = file_get_contents($apiURL);
// $mapboxContent = json_decode($city_data, true);
// $longitude = $mapboxContent['features'][0]['center'][0];
// $latitude =  $mapboxContent['features'][0]['center'][1];
// $numOfCompany = 10;
// $cities[0]['long']=$longitude;
// $cities[0]['lat']=$latitude;
// $cities[0]['city']=$city;
// $cities[0]['numOfCompany']=$numOfCompany;
// $cities[1]['long']=-2.9915726;
// $cities[1]['lat']=53.4083714 ;
// $cities[1]['city']='Liverpool';
// $cities[1]['numOfCompany']=100;
// $cities[2]['long']=-2.1;
// $cities[2]['lat']=54.4083714 ;
// $cities[2]['city']='aa';
// $cities[2]['numOfCompany']=15000;
// $apiData = json_encode($cities);
// echo $apiData;
?>
