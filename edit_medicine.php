<?php
$conn = new mysqli('localhost', 'root', '', 'contact_us');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM medicines WHERE id = $id");
    $medicine = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $medicine_name = $_POST['medicine_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if ($_FILES['image']['name']) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    } else {
        $image = $medicine['image'];
    }

    $sql = "UPDATE medicines SET medicine_name = ?, description = ?, price = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $medicine_name, $description, $price, $image, $id);
    $stmt->execute();

    header("Location: display_data.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Medicine</title>
</head>
<body>
    <h2>Edit Medicine</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $medicine['id']; ?>">
        
        <label>Medicine Name:</label>
        <input type="text" name="medicine_name" value="<?php echo $medicine['medicine_name']; ?>" required><br><br>
        
        <label>Description:</label>
        <textarea name="description" required><?php echo $medicine['description']; ?></textarea><br><br>
        
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $medicine['price']; ?>" required><br><br>
        
        <label>Image:</label>
        <input type="file" name="image"><br>
        <img src="<?php echo $medicine['image']; ?>" width="50" height="50"><br><br>
        
        <input type="submit" value="Update Medicine">
    </form>
</body>
</html>
