<?php

include '../../Constants/index.php';

$stateCode=$_GET['stateCode'];

$link=mysqli_connect($server,$user,$pass,$db);

$output = array();

$query='SELECT DISTINCT `dist_name`,`dist_code` FROM `locations`WHERE `state_code`="'.$stateCode.'"';
$result = mysqli_query($link,$query);

while ($row = mysqli_fetch_array($result)) {
  $output[] = array(
    'dist_name' => $row['dist_name'],
    'dist_code' => $row['dist_code'],
  );
}
echo json_encode($output);

?>