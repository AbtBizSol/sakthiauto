<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
        .gradient-bg {
            background: url('https://www.sakthiauto.com/images/logo.png') no-repeat center center fixed;
            background-size: 20%;
            background-color: #f9f9f9;
        }
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
        }
    </style>
    <script>
        // Redirect to index page after 5 seconds
        setTimeout(() => {
            window.location.href = "https://sakthiauto.com/canteen_feedback.php";
        }, 5000);
    </script>
</head>
<body class="gradient-bg flex items-center justify-center min-h-screen text-gray-700">
    <div class="bg-white text-gray-700 rounded-lg shadow-2xl p-10 max-w-lg text-center fade-in">
        <div class="logo">
            <img src="https://www.sakthiauto.com/images/logo.png" alt="Sakthi Auto Logo">
        </div>
        <div class="text-green-500 text-7xl mb-6">🎉</div>
        <h1 class="text-4xl font-extrabold mb-4">Thank You!</h1>
        <p class="text-lg mb-6">Your feedback has been successfully submitted. We truly value your input and appreciate your time!</p>
        <div class="text-center">
            <p class="text-gray-600">You will be redirected back shortly...</p>
            <div class="mt-4">
                <a href="index.php" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg shadow-lg">Go Back Now</a>
            </div>
        </div>
    </div>
</body>
</html>
