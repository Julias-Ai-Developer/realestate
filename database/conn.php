<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = mysqli_connect('localhost', 'root', 'ceo@2005', 'realestate');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

?>