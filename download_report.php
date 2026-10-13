<?php
// Database connection details
$servername = "localhost";
$username = "sakthiauto_sakthiauto";
$password = "Abt@06061996";
$database = "sakthiauto_feedback";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Set CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="canteen_feedback_report_' . date("Y-m-d") . '.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Meal Time', 'Total Feedbacks', 'Avg Hygiene', 'Avg Taste', 'Avg Interior', 'Avg Service', 'Avg Overall']);

// Fetch summarized analytics data
$query = "
    SELECT 
        meal_time, 
        COUNT(*) AS total_feedbacks, 
        AVG(hygiene) AS avg_hygiene,
        AVG(taste) AS avg_taste,
        AVG(interior) AS avg_interior,
        AVG(service) AS avg_service,
        AVG(overall) AS avg_overall
    FROM feedback 
    GROUP BY meal_time
";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['meal_time'], 
        $row['total_feedbacks'], 
        round($row['avg_hygiene'], 2), 
        round($row['avg_taste'], 2), 
        round($row['avg_interior'], 2), 
        round($row['avg_service'], 2), 
        round($row['avg_overall'], 2)
    ]);
}

fclose($output);
$conn->close();
exit();
?>
