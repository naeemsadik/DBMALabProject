<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$dbname = "myfinancesolution";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Select the database
    $conn->select_db($dbname);

    // SQL to create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS user_info (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(100) NOT NULL,
        lname VARCHAR(100) NOT NULL,
        email VARCHAR(200) NOT NULL,
        user_name VARCHAR(100) NOT NULL,
        phone_number VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) !== TRUE) {
        // Log the error and redirect to an error page
        error_log("Error creating table: " . $conn->error);
        header("Location: pages-error-404.php");
        exit();
    }
} else {
    // Log the error and redirect to an error page
    error_log("Error creating database: " . $conn->error);
    header("Location: pages-error-404.php");
    exit();
}

// Close the connection
$conn->close();
?>
