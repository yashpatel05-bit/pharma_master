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

    // Prepared statement to check if email and password match
    $sql = "SELECT * FROM user_det WHERE email_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
		
		   if ($email_id === 'admin@pharma.com') {
			echo "<script>";
			echo "alert('admin ..');";
			echo "window.location.href='admin_site.html';";
			echo "</script>";
			} else {
				echo "<script>";
				echo "alert('customer..');";
				echo "window.location.href='index.html';";
				echo "</script>";	
			}
	}
		
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 400px; margin-top: 50px; }
        .card { padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email_id">Email ID</label>
                <input type="email" class="form-control" id="email_id" name="email_id" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center mt-3"><?php echo $message; ?></p>
        </form>
    </div>
</div>

</body>
</html>
