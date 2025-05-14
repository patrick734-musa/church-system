<?php
session_start();
include 'db.php';

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Permanent Secretary') {
    header("Location: ../index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $name = $_POST['name'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    // Prepare and execute SQL statement
    $sql = "INSERT INTO events (name, description, event_date) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $description, $event_date);

        if ($stmt->execute()) {
            echo "Event added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        form {
            margin-top: 200px;
            transform: translate(75%);
            background-image: url('image6.jpg');
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* semi-transparent background for readability */
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            margin-top: 5px;
            padding: 8px;
        }
        button {
            margin-top: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add New Event</h1>
    </header>
    
    <main>
        <form action="add_event.php" method="POST">
            <label for="name">Event Name</label>
            <input type="text" id="name" name="name" required>
            
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
            
            <label for="event_date">Event Date</label>
            <input type="date" id="event_date" name="event_date" required>
            
            <button type="submit">Add Event</button>
        </form>
    </main>
</body>
</html>
