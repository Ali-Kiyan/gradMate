<?php


$city = 'Manchester';
$apiToken = 'pk.eyJ1IjoiYWxpa2l5YW4iLCJhIjoiY2pla21xamxjMTJ3ZDMzcGhhcWVib3dxYSJ9.jZ0kXaBcdetnYe-5NiFyug';
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
$cities['lat']=$latitude;
$cities['long']=$longitude;
$cities['city']=$city;
$y = json_encode($cities);

?>
