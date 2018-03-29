<?php
header('Content-Type: application/json');
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "SELECT location, latitude, longitude from locationDetail where location LIKE '". trim($_POST["Location"]) ."%' limit 1";
$result = mysqli_query($connect, $query);
$json_array = array();

while($row = mysqli_fetch_array($result))
{
  $json_array[] = $row;
}
for($i=0;$i<sizeof($json_array);$i++){
  unset($json_array[$i][0]);
  unset($json_array[$i][1]);
  unset($json_array[$i][2]);
}
$locationData = json_encode($json_array);
echo $LocationData;

?>
