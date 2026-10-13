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

// Fetch recent additional feedback comments
$comments_query = "SELECT meal_time, additional_feedback FROM feedback WHERE additional_feedback IS NOT NULL AND additional_feedback != '' ORDER BY id DESC";
$comments_result = $conn->query($comments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Feedback Report</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center">
            <img src="https://www.sakthiauto.com/images/logo.png" alt="Sakthi Auto Logo" class="mx-auto w-32 mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Canteen Feedback Report</h1>
            <p class="text-gray-600">Date: <?php echo date("Y-m-d"); ?></p>
        </div>

        <h2 class="text-xl font-semibold mt-6 text-gray-700">📊 Summary of Feedback</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 mt-4">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Meal Time</th>
                        <th class="border border-gray-300 px-4 py-2">Total Feedbacks</th>
                        <th class="border border-gray-300 px-4 py-2">Avg Hygiene</th>
                        <th class="border border-gray-300 px-4 py-2">Avg Taste</th>
                        <th class="border border-gray-300 px-4 py-2">Avg Interior</th>
                        <th class="border border-gray-300 px-4 py-2">Avg Service</th>
                        <th class="border border-gray-300 px-4 py-2">Avg Overall</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['meal_time']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo $row['total_feedbacks']; ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo round($row['avg_hygiene'], 2); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo round($row['avg_taste'], 2); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo round($row['avg_interior'], 2); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo round($row['avg_service'], 2); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?php echo round($row['avg_overall'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h2 class="text-xl font-semibold mt-6 text-gray-700">💬 Recent Feedback Comments</h2>
        <ul class="mt-4 space-y-2">
            <?php while ($comment = $comments_result->fetch_assoc()) { ?>
                <li class="border border-gray-300 p-3 rounded-lg bg-gray-50">
                    <strong><?php echo $comment['meal_time']; ?>:</strong> <?php echo $comment['additional_feedback']; ?>
                </li>
            <?php } ?>
        </ul>

        <div class="mt-6 text-center">
            <a href="download_report.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg shadow">📥 Download Report as CSV</a>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
