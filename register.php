<?php
session_start(); // Start the session at the beginning

include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone_number = "+880" . mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Encrypt the password

    // Validate input data (basic example)
    if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($phone_number) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO user_info (fname, lname, email, user_name, phone_number, password)
            VALUES ('$fname', '$lname', '$email', '$username', '$phone_number', '$hashed_password')";

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
    }

    // Close the connection
    $conn->close();
}
?>
