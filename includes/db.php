<?php

// Database configuration array
$db = [
  'db_host' => 'localhost',
  'db_user' => 'root',
  'db_password' => '',
  'db_name' => 'cms'
];

// Define constants for database configuration
foreach ($db as $key => $value) {
  define(strtoupper($key), $value);
}

// Establish a database connection
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if (!$connection) {
  die("Database connection failed: " . mysqli_connect_error());
}
?>