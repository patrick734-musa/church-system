<?php
session_start();
require_once '../db.php';

// Fetch the event details if an ID is provided
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Prepare a statement to fetch the event details
    $select_sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($select_sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $event = $result->fetch_assoc();
        $stmt->close();
    } else {
        die("Error fetching event: " . $stmt->error);
    }
} else {
    die("No event ID specified.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $event_date = $_POST['event_date'];
        $description = $_POST['description'];

        // Update query
        $update_sql = "UPDATE events SET name = ?, event_date = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sssi", $name, $event_date, $description, $event_id);

        if ($stmt->execute()) {
            $stmt->close();
            // Redirect to the events page with a success message
            header("Location: view_event.php?update_success=1");
            exit();
        } else {
            $error_message = "Error updating event: " . $stmt->error;
        }

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
    <title>Edit Event</title>
    
    <link rel="stylesheet" href="newEdit.css">
    <script src="scripts.js" defer></script>
    <style>
        /* Same CSS as before, or adjust as needed */
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Event</h1>

        <!-- Feedback message -->
        <?php if (isset($error_message)): ?>
            <div class="feedback-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form id="eventForm" action="edit_event.php?id=<?php echo htmlspecialchars($event_id); ?>" method="post">
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required>
            
            <label for="event_date">Event Date:</label>
            <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea>
            
            <input type="submit" name="update" value="Edit Event">
            <input type="button" value="Cancel" onclick="cancelEvent()">
        </form>
    </div>

    <script>
        function cancelEvent() {
            if (confirm('Are you sure you want to cancel?')) {
                window.location.href = 'view_event.php'; // Redirect to the events page
            }
        }
    </script>
</body>
</html>
