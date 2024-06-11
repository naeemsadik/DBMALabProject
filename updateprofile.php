<?php
session_start();
include("connect.php");

// Ensure user is logged in
if (!isset($_SESSION['userName'])) {
    header("Location: pages-login.php");
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $username = $_SESSION['userName'];
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $aboutInfo = mysqli_real_escape_string($conn, $_POST['about']);
    $twitterLink = mysqli_real_escape_string($conn, $_POST['twitter']);
    $facebookLink = mysqli_real_escape_string($conn, $_POST['facebook']);
    $instaLink = mysqli_real_escape_string($conn, $_POST['instagram']);
    $linkedinLink = mysqli_real_escape_string($conn, $_POST['linkedin']);

    // Update data in the database
    $sql = "UPDATE user_info SET 
        fname = '$fname',
        lname = '$lname',
        phone_number = '$phoneNumber',
        email = '$email',
        about_info = '$aboutInfo',
        twitter_link = '$twitterLink',
        facebook_link = '$facebookLink',
        insta_link = '$instaLink',
        linkedin_link = '$linkedinLink'
        WHERE user_name = '$username'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the profile page with a success message
        header("Location: users-profile.php?update=success");
        exit();
    } else {
        // Log the error and redirect to an error page
        error_log("Database error: " . $conn->error);
        header("Location: pages-error-404.php");
        exit();
    }
}
?>
