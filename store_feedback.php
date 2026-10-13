<?php
// Database connection details
$servername = "localhost";
$username = "sakthiauto_sakthiauto";
$password = "Abt@06061996";
$database = "sakthiauto_feedback";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$meal_time = $_POST['meal_time']; // New field for meal time
$hygiene = $_POST['hygiene'];
$taste = $_POST['taste'];
$interior = $_POST['interior'];
$service = $_POST['service'];
$overall = $_POST['overall'];
$additional_feedback = $_POST['additional_feedback'];
$current_time = date("Y-m-d H:i:s"); // Get the current time

// Prepare SQL query
$sql = "INSERT INTO feedback (meal_time, hygiene, taste, interior, service, overall, additional_feedback, submission_time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siiiiiss", $meal_time, $hygiene, $taste, $interior, $service, $overall, $additional_feedback, $current_time);

if ($stmt->execute()) {
    // Redirect to Thank You page
    header("Location: thank_you.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
