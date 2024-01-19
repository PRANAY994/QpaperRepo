<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST["name11"];
    $user_password = $_POST["passwordd"];

    // Sanitize inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $user_password = $conn->real_escape_string($user_password);

    // Example: Retrieve user information from the database
    $sql = "SELECT * FROM flogin WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // User found, check password
        $row = $result->fetch_assoc();

        if ($user_password === $row["pwd"]) {
            echo "Login successful";
            header("Location: ./faculty.html");
            exit(); // Ensure script stops execution after redirection
        } else {
            echo "<script>alert('Incorrect password');</script>";
            echo "<script>window.location='./login.html';</script>";
            exit(); // Ensure that script stops execution after redirection
        
        }
    } else {
        echo "<script>alert('User Not found');</script>";
        echo "<script>window.location='./login.html';</script>";
    }
} else {
    // Handle cases where the form is not submitted properly
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
