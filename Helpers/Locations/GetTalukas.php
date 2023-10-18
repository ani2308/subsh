<?php

include '../../Constants/index.php';

$stateCode=$_GET['stateCode'];
$districtCode=$_GET['districtCode'];

$link=mysqli_connect($server,$user,$pass,$db);

$output = array();

$query='SELECT DISTINCT `taluka_name`,`taluka_code` FROM `locations` WHERE `state_code`="'.$stateCode.'" AND `dist_code`="'.$districtCode.'"';

$result = mysqli_query($link,$query);

while ($row = mysqli_fetch_array($result)) {
  $output[] = array(
    'taluka_name' => $row['taluka_name'],
    'taluka_code' => $row['taluka_code'],
  );
}
echo json_encode($output);

?>