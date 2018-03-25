<?php
header('Content-Type: application/json');


$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "select count(industry) as num, industry from company where county != ' ' and industry != ' ' and county = 'Greater Manchester' or county = 'Manchester' group by industry";
$result = mysqli_query($connect, $query);
$json_array = array();

while($row = mysqli_fetch_array($result))
{
  $json_array[] = $row;
}

for($i=0;$i<sizeof($json_array);$i++){
  unset($json_array[$i][0]);
  unset($json_array[$i][1]);
}


$industryPerCounty = json_encode($json_array);
echo $industryPerCounty;

?>
