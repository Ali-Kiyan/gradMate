<?php
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "select count(company_name) as companies, county from company group by county ";
$result = mysqli_query($connect, $query);
$json_array = array();
while($row = mysqli_fetch_array($result))
{
  $json_array[] = $row;

}
// var_dump($json_array);
$cPerCounty = json_encode($json_array);
echo $cPerCounty;

?>
