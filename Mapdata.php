<?php
header('Content-Type: application/json');
// header('secretToken: 007');
// if($_SERVER['HTTP_X_REQUESTED_WITH']){
  $connect = mysqli_connect("localhost","root","root","jobWizard");
  $cData = json_decode(file_get_contents('http://localhost:8888/dissertation/companiesPerCounty.php'), true);
  $numOfCompany = array();
  $county = array();
  $query = array();
  $result = array();
  $dbResult = array();
  $result = array();
  for($i=0; $i<sizeof($cData);$i++){
    $numOfCompany[$i]= $cData[$i]['companies'];
    $county[$i]= $cData[$i]['county'];
    $query[$i] = "SELECT Location, Latitude, Longitude from Location_Detail where Location != 'Unknown' AND Location LIKE '". trim($county[$i]) ."%' limit 1";
  }
  for($j=0;$j<sizeof($cData);$j++){
    $dbResult[$j] = mysqli_query($connect, $query[$j]);
    $result[$j]= mysqli_fetch_array($dbResult[$j]);
    unset($result[$j][0]);
    unset($result[$j][1]);
    unset($result[$j][2]);
    if($result[$j]['Latitude'] != 0 && $result[$j]['Longitude'] != 0){
      $result[$j]['Latitude']=(double)$result[$j]['Latitude'];
      $result[$j]['Longitude']=(double)$result[$j]['Longitude'];
      $result[$j]['numOfCompany']=(double)$numOfCompany[$j];
    }
    $result[$j]['Location'] = trim($cData[$j]['county']);
    //API is more accurate but lat and long 0 are shown in the map
    // $result[$j]['numOfCompany']=(double)$numOfCompany[$j];
  }
  $result = json_encode($result);
  echo $result;
// }
?>
