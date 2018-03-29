<?php
header('Content-Type: application/json');
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
  $query[$i] = "SELECT location, latitude, longitude from locationDetail where location LIKE '". trim($county[$i]) ."%' limit 1";
}
for($j=0;$j<sizeof($cData);$j++){
  $dbResult[$j] = mysqli_query($connect, $query[$j]);
  $result[$j]= mysqli_fetch_array($dbResult[$j]);
  unset($result[$j][0]);
  unset($result[$j][1]);
  unset($result[$j][2]);
  $result[$j]['latitude']=(double)$result[$j]['latitude'];
  $result[$j]['longitude']=(double)$result[$j]['longitude'];
  $result[$j]['numOfCompany']=(int)$numOfCompany[$j];
}

$result = json_encode($result);
echo $result;

?>
