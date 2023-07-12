<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["email"])) {
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT report FROM users WHERE email=?");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $stmt->bind_result($report);
    if ($stmt->fetch()) {
        header("Content-Type: application/pdf");
        header('Content-Disposition: inline; filename="report.pdf"');
        echo $report;
    } else {
        echo "No report found for email: $email";
    }

    $stmt->close();
} else {
    echo '<form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Submit">
    </form>';
}

$conn->close();
?>
