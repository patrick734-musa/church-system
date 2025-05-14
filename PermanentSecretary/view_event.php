<?php
session_start();
require_once 'db.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: view_event.php?delete_success=1");
        exit();
    } else {
        echo "<p>Error deleting event: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch all events
$view_sql = "SELECT * FROM events";
$result = $conn->query($view_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
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
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .event-details {
            margin-bottom: 20px;
        }
        .event-details p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }
        .event-details strong {
            color: #333;
        }
        .button-group {
            text-align: center;
        }
        .button-group a {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            color: #fff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 4px;
        }
        .button-group a.delete {
            background-color: #f44336;
        }
        .button-group a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Events</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($event = $result->fetch_assoc()): ?>
                <div class="event-details">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($event['name']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['event_date']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                    <div class="button-group">
                        <a href="edit_event.php?id=<?php echo $event['id']; ?>">Edit</a>
                        <a href="?delete_id=<?php echo $event['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
        <div class="button-group">
            <a href="create_event.php">Add New Event</a>
            <br><br>
            <a href="event_records.php">Back</a>
        </div>
    </div>
</body>
</html>
