<?php

include '../../Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

$output = array();

$query="SELECT DISTINCT `state_name`,`state_code` FROM `locations`";
$result = mysqli_query($link,$query);

while ($row = mysqli_fetch_array($result)) {
  $output[] = array(
    'state_name' => $row['state_name'],
    'state_code' => $row['state_code'],
  );
}
echo json_encode($output);

?>