<?php  
// Database configuration  
$dbHost = "localhost";  
$dbUsername = "jtbd4k";  
$dbPass = "password";
$dbName = "4830";  
  
// Create database connection  
$db = new mysqli($dbHost, $dbUsername, $dbPass,  $dbName);  
  
// Check connection  
if ($db->connect_error) {  
    die("Connection failed: " . $db->connect_error);  
}
