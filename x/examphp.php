<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facultyCode = $_POST["wer"];

    $stmt = $conn->prepare("INSERT INTO grantt (fname, access) VALUES (?, 1) ON DUPLICATE KEY UPDATE access = 1");

    if ($stmt) {
        $stmt->bind_param("s", $facultyCode);

        if ($stmt->execute()) {
            echo "Access granted to faculty code: $facultyCode";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}


$conn->close();
?>