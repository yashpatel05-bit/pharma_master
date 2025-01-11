<?php
// Database connection
$servername = "localhost";
$username = "root"; // Adjust according to your MySQL settings
$password = ""; // Adjust according to your MySQL settings
$dbname = "contact_us";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
    
    $fname = $_POST['c_fname'];
    $lname = $_POST['c_lname'];
    $emaili = $_POST['c_email'];
    $subject = $_POST['c_subject'];
    $message = $_POST['c_message'];
    

    // Insert into database
    if ($_POST['id'] == "")
     {
        $sql = "INSERT INTO con_data (fr_name,la_name,email_id,sub,mess) VALUES ('$fname','$lname','$emaili','$subject','$message')";
        
    } else {
        $id = $_POST['id'];
        
        $sql = "UPDATE con_data SET fr_name='$fname',la_name='$lname',email_id='$emaili',sub='$subject',mess='$message' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>";
        echo "alert('Message Send..');";
        echo "window.location.href='contact.html';";
        echo "</script>";

    }
}

$con_data = $conn->query("SELECT * FROM con_data");

$conn->close();
?>
