<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'contact_us';
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $mobile_no = $_POST['mobile_no'];
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user_data (first_name, last_name, addre, city, mobile_no, email_id, pwd) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $address, $city, $mobile_no, $email_id, $password);

    if ($stmt->execute()) {
          echo "<script>";
        echo "alert('Registration Done..');";
        echo "window.location.href='login.html';";
        echo "</script>";

    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
