<?php

var_dump($_FILES);

$target_dir = "uploads/";
move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir.$_FILES["file1"]["name"]);

move_uploaded_file($_FILES["file2"]["tmp_name"], $target_dir."2".$_FILES["file2"]["name"]);

?>