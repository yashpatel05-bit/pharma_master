<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'contact_us';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert record into database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medicine_name = $_POST['medicine_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "pharma-master" . basename($image);

    // Move uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO medicines (medicine_name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $medicine_name, $description, $price, $image);

        if ($stmt->execute()) {
            
			echo "<script>";
			echo "alert('Record added successfully');";
			echo "window.location.href='admin_site.html';";
			echo "</script>";
			
			
        } else {
			echo "<script>";
			echo "alert('Error: ');";
			echo "window.location.href='admin_site.html';";
			echo "</script>";
            
        }
    } else {
		
		echo "<script>";
			echo "alert('Failed to upload image.');";
			echo "window.location.href='admin_site.html';";
			echo "</script>";
        
    }
}

$conn->close();
?>
