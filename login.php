<?php
include ("connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate input data
    if (empty($username) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Fetch user data from the database
    $sql = "SELECT * FROM user_info WHERE user_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Creating session for future operations
            $_SESSION['userName'] = $username;

            // echo $_SESSION['userName'];
            // Redirect to the original page
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            echo "Invalid password.";
            header("Location: pages-login.php");
        }
    } else {
        // User not found
        echo "No user found with that username.";
    }

    // Close the connection
    $conn->close();
}
?>

<!-- 
if ($conn->query($sql) === TRUE) {
        // Creating session for future operations
        $_SESSION['userName'] = $username;
        $_SESSION['lastName'] = $lname;

        // Redirect to the original page
        header("Location: index.php");
        exit();
    } else {
        // Log the error and redirect to a custom error page
        error_log("Database error: " . $conn->error);
        header("Location: pages-error-404.php");
        exit();
    } -->