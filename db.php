<?php  
// Database configuration  
$dbHost     = "den1.mysql6.gear.host";  
$dbUsername = "mymapstore";  
$dbPassword = "Om78!Bi!M209";  
$dbName     = "mymapstore";  
  
// Create database connection  
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);  
  
// Check connection  
if ($db->connect_error) {  
    die("Connection failed: " . $db->connect_error);  
}