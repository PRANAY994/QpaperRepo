<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving the value from the submitted form
    $value = $_POST['inputValue'];

    // You can now use $value in your PHP logic
    // For example, display it or perform operations with it
    echo "The submitted value is: " . $value;
}
?>
