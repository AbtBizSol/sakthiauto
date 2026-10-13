<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://www.sakthiauto.com/images/logo.png') no-repeat center center fixed;
            background-size: 20%;
            background-color: #f9f9f9;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            color: #333;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .header-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .header-logo img {
            width: 120px;
            margin-bottom: 10px;
        }

        .rating-icons input[type="radio"] {
            display: none;
        }

        .rating-icons label {
            font-size: 2.5rem; /* Emoji size */
            cursor: pointer;
            transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .rating-icons label span {
            font-size: 1rem; /* Number size */
            color: #555;
            transition: color 0.2s ease-in-out;
        }

        .rating-icons input[type="radio"]:checked + label span {
            color: #e87e04; /* Highlighted number color */
        }

        .rating-icons input[type="radio"]:checked + label {
            transform: scale(1.2);
            color: #e87e04; /* Highlighted emoji color */
        }

        .current-time {
            font-weight: bold;
            font-size: 1rem;
            color: #333;
        }

        .submit-btn {
            background-color: #f97316; /* Orange */
            transition: background-color 0.3s ease-in-out;
        }

        .submit-btn:hover {
            background-color: #ea580c; /* Darker orange */
        }
    </style>
    <script>
        // Dynamically update the current time
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            timeElement.textContent = timeString;
        }

        setInterval(updateTime, 1000);

        function validateForm(event) {
            const fields = ["meal_time", "hygiene", "taste", "interior", "service", "overall"];
            let isValid = true;

            fields.forEach(field => {
                const options = document.getElementsByName(field);
                const isChecked = Array.from(options).some(option => option.checked);

                if (!isChecked) {
                    isValid = false;
                    alert(`Please select an option for ${field.charAt(0).toUpperCase() + field.slice(1).replace('_', ' ')}.`);
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-3xl">
        <div class="header-logo">
            <img src="https://www.sakthiauto.com/images/logo.png" alt="Sakthi Auto Logo">
            <h1 class="text-4xl font-extrabold text-gray-700">Canteen Feedback Form</h1>
        </div>

        <div class="card rounded-lg shadow-lg p-8">
            <form class="space-y-6" action="store_feedback.php" method="POST" onsubmit="validateForm(event)">
                <!-- Meal Time Selection -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-lg font-semibold">
                            Select Meal Time (Required)
                        </label>
                        <span id="current-time" class="current-time"></span>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            <input type="radio" id="meal-breakfast" name="meal_time" value="Breakfast">
                            <label for="meal-breakfast" class="text-lg font-medium">Breakfast</label>
                        </div>
                        <div>
                            <input type="radio" id="meal-lunch" name="meal_time" value="Lunch">
                            <label for="meal-lunch" class="text-lg font-medium">Lunch</label>
                        </div>
                        <div>
                            <input type="radio" id="meal-dinner" name="meal_time" value="Dinner">
                            <label for="meal-dinner" class="text-lg font-medium">Dinner</label>
                        </div>
                    </div>
                </div>

                <!-- Hygiene -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Hygiene <span class="text-gray-500 text-sm">(1: Bad, 4: Excellent)</span></label>
                    <div class="flex space-x-6 justify-center rating-icons">
                        <input type="radio" id="hygiene-1" name="hygiene" value="1">
                        <label for="hygiene-1"><span>1</span>😠</label>
                        <input type="radio" id="hygiene-2" name="hygiene" value="2">
                        <label for="hygiene-2"><span>2</span>😐</label>
                        <input type="radio" id="hygiene-3" name="hygiene" value="3">
                        <label for="hygiene-3"><span>3</span>😊</label>
                        <input type="radio" id="hygiene-4" name="hygiene" value="4">
                        <label for="hygiene-4"><span>4</span>😁</label>
                    </div>
                </div>

                <!-- Taste -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Taste <span class="text-gray-500 text-sm">(1: Bad, 4: Excellent)</span></label>
                    <div class="flex space-x-6 justify-center rating-icons">
                        <input type="radio" id="taste-1" name="taste" value="1">
                        <label for="taste-1"><span>1</span>😠</label>
                        <input type="radio" id="taste-2" name="taste" value="2">
                        <label for="taste-2"><span>2</span>😐</label>
                        <input type="radio" id="taste-3" name="taste" value="3">
                        <label for="taste-3"><span>3</span>😊</label>
                        <input type="radio" id="taste-4" name="taste" value="4">
                        <label for="taste-4"><span>4</span>😁</label>
                    </div>
                </div>

                <!-- Interior Arrangements -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Interior Arrangements <span class="text-gray-500 text-sm">(1: Bad, 4: Excellent)</span></label>
                    <div class="flex space-x-6 justify-center rating-icons">
                        <input type="radio" id="interior-1" name="interior" value="1">
                        <label for="interior-1"><span>1</span>😠</label>
                        <input type="radio" id="interior-2" name="interior" value="2">
                        <label for="interior-2"><span>2</span>😐</label>
                        <input type="radio" id="interior-3" name="interior" value="3">
                        <label for="interior-3"><span>3</span>😊</label>
                        <input type="radio" id="interior-4" name="interior" value="4">
                        <label for="interior-4"><span>4</span>😁</label>
                    </div>
                </div>

                <!-- Service -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Service <span class="text-gray-500 text-sm">(1: Bad, 4: Excellent)</span></label>
                    <div class="flex space-x-6 justify-center rating-icons">
                        <input type="radio" id="service-1" name="service" value="1">
                        <label for="service-1"><span>1</span>😠</label>
                        <input type="radio" id="service-2" name="service" value="2">
                        <label for="service-2"><span>2</span>😐</label>
                        <input type="radio" id="service-3" name="service" value="3">
                        <label for="service-3"><span>3</span>😊</label>
                        <input type="radio" id="service-4" name="service" value="4">
                        <label for="service-4"><span>4</span>😁</label>
                    </div>
                </div>

                <!-- Overall Rating -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Overall Rating <span class="text-gray-500 text-sm">(1: Bad, 4: Excellent)</span></label>
                    <div class="flex space-x-6 justify-center">
                        <input type="radio" id="overall-1" name="overall" value="1">
                        <label for="overall-1" class="text-green-800"><span>1</span> Poor</label>
                        <input type="radio" id="overall-2" name="overall" value="2">
                        <label for="overall-2" class="text-green-600"><span>2</span> Neutral</label>
                        <input type="radio" id="overall-3" name="overall" value="3">
                        <label for="overall-3" class="text-blue-600"><span>3</span> Good</label>
                        <input type="radio" id="overall-4" name="overall" value="4">
                        <label for="overall-4" class="text-pink-600"><span>4</span> Excellent</label>
                    </div>
                </div>

                <!-- Additional Feedback -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Additional Feedback</label>
                    <textarea name="additional_feedback" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-green-300" placeholder="Write your feedback here..."></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="submit-btn text-white font-medium px-6 py-3 rounded-lg shadow">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
