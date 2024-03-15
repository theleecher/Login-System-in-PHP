<?php
$conn = new mysqli("localhost","root","","login_youtube");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>