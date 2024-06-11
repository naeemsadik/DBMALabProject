<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $sql = "SELECT * FROM user_info WHERE user_name = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }

    $conn->close();
}
?>
