<?php
header('Content-Type: application/json');
$connect = mysqli_connect("localhost","root","root","jobWizard");
if($_GET['type'] == 'stable'){
  $query = "select l.longitude,l.latitude, count(company_id) as numOfCompany from company as c inner join locationDetail as l on l.location = c.county where year(now()) - year(date_added) > 3 and date_added != '0000-00-00' and county != '' and industry = '" . $_GET['industry'] . "'GROUP by county ";
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
}
elseif($_GET['type'] == 'startup'){
  $query = "select l.longitude,l.latitude, count(company_id) as numOfCompany from company as c inner join locationDetail as l on l.location = c.county where year(now()) - year(date_added) < 2 and date_added != '0000-00-00' and county != '' and industry = '" . $_GET['industry'] . "'GROUP by county ";
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
}


?>
