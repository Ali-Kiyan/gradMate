<?php
header('Content-Type: application/json');
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "select count(Company_id) AS numOfCompany,l.Longitude,l.Latitude from Company as c inner join Location_Detail as l ON l.Location = c.County where Industry='IT' group by County";
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
$result = json_encode($json_array);
echo $result;

?>
