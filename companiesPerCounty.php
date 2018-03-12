<?php
header('Content-Type: application/json');
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "select distinct count(company_name) as companies, county from company where county != ' ' group by county having count(company_name)>0";
$result = mysqli_query($connect, $query);
$json_array = array();



while($row = mysqli_fetch_array($result))
{
  $json_array[] = $row;
}

$cPerCounty = json_encode($json_array);
echo $cPerCounty;

?>
