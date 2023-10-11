<?php

$conn = new mysqli("localhost","phpmyadmin","root","register01");

// echo "jhfg";
// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
}


?>