<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$coffee_type = $_POST['coffee_type'];
$size = $_POST['size'];
$milk = $_POST['milk'];
$sugar = $_POST['sugar'];
$extras = isset($_POST['extras']) ? implode(", ", $_POST['extras']) : '';
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pickup_time = $_POST['pickup_time'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (coffee_type, size, milk, sugar, extras, name, email, phone, pickup_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisssss", $coffee_type, $size, $milk, $sugar, $extras, $name, $email, $phone, $pickup_time);

// Execute the statement
if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
