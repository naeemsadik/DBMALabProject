<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "myfinancesolution";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // SQL to create table
    $sql = "CREATE TABLE IF NOT EXISTS user_info (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(100) NOT NULL,
        lname VARCHAR(100) NOT NULL,
        email VARCHAR(200) NOT NULL,
        user_name VARCHAR(100) NOT NULL,
        phone_number VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    )";

    if (!$conn->query($sql) === TRUE) {
        header("Location: pages-error-404.php");
    }
}
?>
