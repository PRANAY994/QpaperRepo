<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $degreeID = $_POST["degree_select"];
    $programID = $_POST["program_select"];
    $semesterID = $_POST["semester_select"];
    $courseID = $_POST["course_name"]; // Changed to course_code as per your HTML
    $year = $_POST["year_val"];
    $difficulty_level = isset($_POST["difficulty_level"]) ? $_POST["difficulty_level"] : '';
    $examID = $_POST["inputValue"]; // Retrieve the exam ID from the form field
    $file_path = $_POST["inputval3"]; // Retrieve the file path from the form field (inputval3)
    $facultycode = $_POST["facultycode"];
    echo $file_path; // Retrieve the file path from the form field
    echo $examID;

    // Ensure your database connection details are set correctly
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construct the SQL query to check access using faculty name
    $access_query = "SELECT access FROM grantt WHERE fname = ?";
    $access_stmt = $conn->prepare($access_query);
    $access_stmt->bind_param("s", $facultycode);
    $access_stmt->execute();
    $access_result = $access_stmt->get_result();
    
    if ($access_result->num_rows > 0) {
        $row = $access_result->fetch_assoc();
        $access = $row['access'];
        
        if ($access == 1) { // Assuming '1' denotes access
            // Construct the SQL query to insert data into the database
            $sql = "INSERT INTO questionpapers (question_paper_id, degree_id, course_id, semester_id, difficulty_level, file_path, year, program_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);

            // Bind parameters and execute the statement
            $stmt->bind_param("siiisssi", $examID, $degreeID, $courseID, $semesterID, $difficulty_level, $file_path, $year, $programID);

            if ($stmt->execute() === TRUE) {
                echo "Exam paper added successfully";
            } else {
                echo "Error adding exam paper: " . $conn->error;
            }

            // Close the statement for inserting data
            $stmt->close();
        } else {
            echo "No access";
        }
    } else {
        echo "No access";
    }

    // Close the access statement and the connection
    $access_stmt->close();
    $conn->close();
}
?>
