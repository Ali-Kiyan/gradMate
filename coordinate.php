<?php

// https://api.mapbox.com/geocoding/v5/mapbox.places/Manchester.json?access_token=pk.eyJ1IjoiYWxpa2l5YW4iLCJhIjoiY2pla21xamxjMTJ3ZDMzcGhhcWVib3dxYSJ9.jZ0kXaBcdetnYe-5NiFyug&limit=

$city = 'Manchester';
$apiToken = 'pk.eyJ1IjoiYWxpa2l5YW4iLCJhIjoiY2pla21xamxjMTJ3ZDMzcGhhcWVib3dxYSJ9.jZ0kXaBcdetnYe-5NiFyug';
$apiURL = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . $city . '.json?access_token=' . $apiToken . '&country=gb&limit=1';
$city_data = file_get_contents($apiURL);
$json = json_decode($city_data, TRUE);
echo $city_data;

?>
