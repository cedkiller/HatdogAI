<?php
session_start();

// Create connection
$conn = mysqli_connect("localhost", "root", "", "hotdogai");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>