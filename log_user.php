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
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];

    // Query to check if email and password match
    $sql = "SELECT * FROM user_data WHERE email_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check password
        if ($sql) {
            echo "<script>";
        echo "alert('Login Done..');";
        echo "window.location.href='index.html';";
        echo "</script>";

        } else {
             echo "<script>";
        echo "alert('Check Email_id Or Password..');";
        echo "window.location.href='login.html';";
        echo "</script>";

        }
    } else {
        echo "<script>";
        echo "alert('No Data Found');";
        echo "window.location.href='login.html';";
        echo "</script>";

    }
    $stmt->close();
}
$conn->close();
?>
