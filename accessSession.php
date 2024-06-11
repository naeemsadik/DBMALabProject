<?php
session_start(); // Start the session

include("connect.php");

if (!isset($_SESSION['userName'])) {
    header("Location: pages-login.php");
    exit(); // Make sure to exit after header redirection
} else {
    // Get the username from the session
    $username = $_SESSION['userName'];

    // Sanitize the input
    $username = mysqli_real_escape_string($conn, $username);

    // Query to fetch user data based on username
    $sql = "SELECT * FROM user_info WHERE user_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $userData = $result->fetch_assoc();
        $fname = $userData['fname'];
        $lname = $userData['lname'];
        $username = $userData['user_name'];
        $useremail = $userData['email'];
        $phoneNumber = $userData['phone_number'];
        $facebookLink = $userData['facebook_link'];
        $instaLink = $userData['insta_link'];
        $twitterLink = $userData['twitter_link'];
        $linkedinLink = $userData['linkedin_link'];
        $aboutInfo = $userData['about_info'];
    } else {
        echo "No user found with the username: " . htmlspecialchars($username);
    }

    // Close the connection
    $conn->close();
}
?>
