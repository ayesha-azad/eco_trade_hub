<?php
/**
 * Database Connection Configuration
 * Centralized database connection file for ECO Trade Hub
 * 
 * This file establishes a MySQL database connection using mysqli
 * and is included across all modules (admin, users, seller, etc.)
 */

// Database configuration
$servername = "mysql";      // MySQL service name from docker-compose
$username = "myuser";       // Database username
$password = "mypassword";   // Database password
$database = "mydatabase";   // Database name

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