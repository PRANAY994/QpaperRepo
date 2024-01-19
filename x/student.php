<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $degreeID = $_POST["degree_select"];
    $programID = $_POST["program_select"];
    $semesterID = $_POST["semester_select"];
    $courseID = $_POST["course_name"];
    $year = $_POST["year_val"];
    $difficulty_level = $_POST["difficulty_level"];

    // Establish database connection (use your own connection function or method)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construct the SQL query
    $sql = "SELECT `file_path` FROM `questionpapers` WHERE degree_id = $degreeID and course_id = $courseID and program_id = $programID and difficulty_level = '$difficulty_level' and year = $year and semester_id = $semesterID";

    // Execute the query
    $result = $conn->query($sql);
    $resultData = [];

    if ($result && $result->num_rows > 0) {
        // Add file paths to the result data array
        while ($row = $result->fetch_assoc()) {
            $resultData[] = $row["file_path"];
        }
    } else {
        $resultData[] = "No question paper found for the selected criteria.";
    }

    // Close the connection
    $conn->close();

    // Output the result as JSON
    header('Content-Type: application/json');
    echo json_encode($resultData);
}
?>
