<?php
header('Content-Type: application/json');
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "select `company_name`, `date_added` from company where year(CURRENT_DATE) - year(`date_added`) > 3";
$result = mysqli_query($connect, $query);
$json_array = array();

while($row = mysqli_fetch_array($result))
{
  $json_array[] = $row;
}

$cPerCounty = json_encode($json_array);
echo $cPerCounty;

?>
industires per county
select count(industry), ifnull(industry,'test') , county from company where county = 'London' group by industry with ROLLUP

// all county industeris
select count(industry), ifnull(industry,'test') , county from company group by industry, county with ROLLUP
