<?php

$conn = new mysqli("localhost","phpmyadmin","root","register01");
// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
}


?>