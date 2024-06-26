<?php

// Database connection 
$host = "db"; # docker compose service name
$username = "root";
$password = "root";
$database = "nibm";

// Create a database connection
$connect = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Make the $connect variable available globally
$GLOBALS['connect'] = $connect;
