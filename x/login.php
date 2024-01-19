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
    $email = $_POST["name1"];
    $password = $_POST["password"];

    // Example: Retrieve user information from the database
    $sql = "SELECT * FROM login WHERE id = '$email'";
    $result = $conn->query($sql);
    print_r($result->num_rows);

    if ($result->num_rows > 0) {
        // User found, check password
        $row = $result->fetch_assoc();


        if ($password == $row["pwd"]) {
            session_start(); // Start the session
            $_SESSION['username'] = $row['name']; // Store the user's name in the session
            header("location:./student1.php");
            exit(); 
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
