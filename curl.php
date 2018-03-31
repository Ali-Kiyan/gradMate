<?php
header('Content-Type: application/json');
$url = "https://api.companieshouse.gov.uk/search/companies?q=?WhatIf!Ltd";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: api.companieshouse.gov.uk',
    'Authorization: eFaPOGH7H2sFl1S2roAM8SE50WkcJQXrACJfSYOu'
    ));
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
echo $result;




?>
