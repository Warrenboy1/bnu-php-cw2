<?php

  header("Content-type: image/jpeg");

  //$conn = mysqli_connect("localhost", " mysqlusername "," mysqlpassword ", "databasename ");
  $conn = mysqli_connect('127.0.0.1', "root", "", 'cw2');

  $sql = "SELECT image FROM student WHERE studentid='" . $_GET['studentid'] ."';";
	
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  
  $jpg = $row["image"];

  echo $jpg;
?>
