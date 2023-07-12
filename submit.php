<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST["name"];
$age = $_POST["age"];
$weight = $_POST["weight"];
$email = $_POST["email"];
$report = file_get_contents($_FILES["report"]["tmp_name"]);
$stmt = $conn->prepare("INSERT INTO users (name, age, weight, email, report) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("siiss", $name, $age, $weight, $email, $report);

$stmt->execute();

echo "New record created successfully";

$stmt->close();
$conn->close();
?>
