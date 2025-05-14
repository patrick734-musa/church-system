<?php
session_start();
require_once 'db.php';

$create_success = false; // Initialize success flag

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $event_date = $_POST['event_date'];
        $description = $_POST['description'];

        // Insert query
        $insert_sql = "INSERT INTO events (name, event_date, description) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sss", $name, $event_date, $description);

        if ($stmt->execute()) {
            $create_success = true; // Mark success
        } else {
            $error_message = "Error creating event: " . $stmt->error;
        }

        // Close the statement after execution, only once
        $stmt->close();
    } elseif (isset($_POST['cancel'])) {
        // Redirect to the events page if cancelled
        header("Location: view_event.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <!-- Include Lottie player library -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="newStyles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            height: 35px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        input[type="button"] {
            background-color: #f44336;
        }
        input[type="submit"]:hover,
        input[type="button"]:hover {
            opacity: 0.9;
        }
        .feedback-message {
            text-align: center;
            font-size: 18px;
            color: #d9534f;
            margin-top: 20px;
        }
        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .loading img {
            width: 50px;
            height: 50px;
        }
        /* Success message style */
        .success-message {
            text-align: center;
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }
        #success-message {
            background-color: #4CAF50;
            text-align: center;
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Event</h1>

        <!-- Loading animation -->
        <div class="loading" id="loading">
            <lottie-player 
                src="lottieflow-success-08-000000-easey.json" 
                background="transparent" 
                speed="1" 
                style="width: 200px; height: 200px;" 
                loop 
                autoplay>
            </lottie-player>
            <p id="loadingText">Please wait...</p>
        </div>

        <!-- Feedback message -->
        <?php if (isset($error_message)): ?>
            <div class="feedback-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form id="eventForm" action="create_event.php" method="post">
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            
            <input type="submit" name="create" value="Add Event">
            <input type="button" value="Cancel" onclick="cancelEvent()">
        </form>

        <!-- Success message container -->
        <div id="successMessage" class="success-message" style="display: none;">
            Event created successfully!
        </div>
    </div>

    <script>
        document.getElementById('eventForm').addEventListener('submit', function() {
            document.getElementById('loading').style.display = 'block';
        });

        function cancelEvent() {
            if (confirm('Are you sure you want to cancel?')) {
                document.getElementById('eventForm').action = 'view_event.php';
                document.getElementById('eventForm').method = 'post';
                document.getElementById('eventForm').submit();
            }
        }

        <?php if ($create_success): ?>
            document.getElementById('loading').style.display = 'block';
            setTimeout(function() {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block'; // Show success message
            }, 2000); // Hide loading and show message after 2 seconds
        <?php endif; ?>
    </script>
</body>
</html>
