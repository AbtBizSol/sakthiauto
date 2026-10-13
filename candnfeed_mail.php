<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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

$summary_table = "<table border='1' cellspacing='0' cellpadding='5' style='border-collapse: collapse; width: 100%;'>
    <tr style='background-color: #f2f2f2;'>
        <th>Meal Time</th>
        <th>Total Feedbacks</th>
        <th>Avg Hygiene</th>
        <th>Avg Taste</th>
        <th>Avg Interior</th>
        <th>Avg Service</th>
        <th>Avg Overall</th>
    </tr>";

while ($row = $result->fetch_assoc()) {
    $summary_table .= "<tr>
        <td>{$row['meal_time']}</td>
        <td>{$row['total_feedbacks']}</td>
        <td>" . round($row['avg_hygiene'], 2) . "</td>
        <td>" . round($row['avg_taste'], 2) . "</td>
        <td>" . round($row['avg_interior'], 2) . "</td>
        <td>" . round($row['avg_service'], 2) . "</td>
        <td>" . round($row['avg_overall'], 2) . "</td>
    </tr>";
}
$summary_table .= "</table>";

// Fetch recent additional feedback comments
$comments_query = "SELECT meal_time, additional_feedback FROM feedback WHERE additional_feedback IS NOT NULL AND additional_feedback != '' ORDER BY id DESC LIMIT 10";
$comments_result = $conn->query($comments_query);

$comments_list = "<ul>";
while ($comment = $comments_result->fetch_assoc()) {
    $comments_list .= "<li><strong>{$comment['meal_time']}:</strong> {$comment['additional_feedback']}</li>";
}
$comments_list .= "</ul>";

// Email settings for Zoho SMTP
$mail = new PHPMailer(true);
try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'smtppro.zoho.in';  // Zoho SMTP Server
    $mail->SMTPAuth = true;
    $mail->Username = 'iot@sakthiauto.com'; // Your Zoho email
    $mail->Password = 'Saiot@2023'; // Your Zoho email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
    $mail->Port = 465; // SMTP port for SSL

    // Email Content
    $mail->setFrom('iot@sakthiauto.com', 'Canteen_Feedback_Report');
    $mail->addAddress('karthikeyan@abtbizsol.com'); // Recipient email
    $mail->addAddress('gt.arasu@sakthiauto.com'); // Additional recipient
    $mail->addAddress('selvakumaranpk@sakthiauto.com'); // Additional recipient
    $mail->addAddress('tamilarasan.kk@sakthiauto.com'); // Additional recipient
    $mail->addAddress('canteen@sakthiauto.in'); // Additional recipient
    $mail->addAddress('prakashkumar@abtinfocloud.com'); // Additional recipient
    $mail->Subject = "Daily Canteen Feedback Report - " . date("Y-m-d");
    $mail->isHTML(true);

    // HTML email body
    $mail->Body = "
    <html>
    <head>
        <title>Daily Canteen Feedback Report</title>
    </head>
    <body style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;'>
        <div style='max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);'>
            <div style='text-align: center;'>
                <img src='https://www.sakthiauto.com/images/logo.png' alt='Sakthi Auto Logo' style='width: 100px;'>
                <h2 style='color: #ff6600;'>Daily Canteen Feedback Report</h2>
            </div>
            <p>Here is a summarized report of today's feedback collected from the canteen:</p>
            $summary_table
            <h3 style='color: #ff6600;'>Recent Comments</h3>
            $comments_list
           <p style='text-align: center; font-size: 14px; color: #777;'>
    Best Regards,<br>
    <strong>ABT Business Solution</strong><br>
    <strong>Canteen Feedback System</strong><br>
    &copy; 2025 ABT Business Solution. All Rights Reserved.
</p>

        </div>
    </body>
    </html>";

    // Send Email
    $mail->send();
    echo "Email sent successfully!";
} catch (Exception $e) {
    echo "Failed to send email. Error: {$mail->ErrorInfo}";
}

// Close database connection
$conn->close();
?>
