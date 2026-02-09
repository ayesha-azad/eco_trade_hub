<?php
// Enable error reporting for debugging (Remove/Comment out for production once fixed)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$isProduction = !file_exists(__DIR__ . '/../docker-compose.yaml');

if ($isProduction) {
    // ===== INFINITYFREE PRODUCTION SETTINGS =====
    // TODO: Update these with your actual InfinityFree database credentials
    // You can find these in your InfinityFree Control Panel → MySQL Databases
    
    $servername = "sql209.infinityfree.com";  // Your MySQL hostname (e.g., sql123.infinityfree.com)
    $username = "if0_41113413";              // Your MySQL username (starts with epiz_ or if0_)
    $password = "tGQKUBmiL5weRO";           // Your MySQL password
    $database = "if0_41113413_eco_trade_hub";     // Your database name
    
} else {
    // ===== LOCAL DOCKER DEVELOPMENT SETTINGS =====
    $servername = "mysql";      // MySQL service name from docker-compose
    $username = "myuser";       // Database username
    $password = "mypassword";   // Database password
    $database = "mydatabase";   // Database name
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Log error for debugging (in production, log to file instead of displaying)
    error_log("Database Connection Failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
}

// Set charset to UTF-8 for proper character encoding
if (!$conn->set_charset("utf8mb4")) {
    error_log("Error loading character set utf8mb4: " . $conn->error);
}

// Optional: Set timezone (uncomment if needed)
// $conn->query("SET time_zone = '+05:00'");

?>