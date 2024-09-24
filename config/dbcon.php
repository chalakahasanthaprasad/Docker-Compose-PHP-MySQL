<?php

// Database connection parameters
$host = getenv('MYSQL_HOST', true) ?: getenv('MYSQL_HOST');
$username = getenv('MYSQL_USER', true) ?: getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD', true) ?: getenv('MYSQL_PASSWORD');
$database = getenv('MYSQL_DATABASE', true) ?: getenv('MYSQL_DATABASE');

// Create a database connection
$connect = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Make the $connect variable available globally
$GLOBALS['connect'] = $connect;
