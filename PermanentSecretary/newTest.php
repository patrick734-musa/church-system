<?php
session_start();
require_once 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Retrieve the user ID from session

// Initialize messages
$success_message = '';
$error_message = '';

// Check if 'register_event_id' or 'cancel_event_id' is set in the URL
if (isset($_GET['register_event_id']) || isset($_GET['cancel_event_id'])) {
    $event_id = intval($_GET['register_event_id'] ?? $_GET['cancel_event_id']); // Retrieve the event ID from URL

    // Prepare a statement for checking registration
    if ($stmt = $conn->prepare("SELECT * FROM registrations WHERE member_id = ? AND event_id = ?")) {
        $stmt->bind_param("ii", $user_id, $event_id); // Bind parameters as integers
        $stmt->execute();
        $check_registration_result = $stmt->get_result();

        if ($check_registration_result->num_rows == 0 && isset($_GET['register_event_id'])) {
            // Register the user if not already registered
            if ($stmt = $conn->prepare("INSERT INTO registrations (member_id, event_id) VALUES (?, ?)")) {
                $stmt->bind_param("ii", $user_id, $event_id); // Bind parameters as integers
                if ($stmt->execute()) {
                    $success_message = "You have successfully registered for the event!";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
            } else {
                die("Prepare failed: " . $conn->error);
            }
        } elseif ($check_registration_result->num_rows > 0 && isset($_GET['cancel_event_id'])) {
            // Cancel the registration if already registered
            if ($stmt = $conn->prepare("DELETE FROM registrations WHERE member_id = ? AND event_id = ?")) {
                $stmt->bind_param("ii", $user_id, $event_id); // Bind parameters as integers
                if ($stmt->execute()) {
                    $success_message = "You have successfully canceled your registration for the event!";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
            } else {
                die("Prepare failed: " . $conn->error);
            }
        } else {
            if (isset($_GET['register_event_id'])) {
                $error_message = "You are already registered for this event!";
            } elseif (isset($_GET['cancel_event_id'])) {
                $error_message = "You are not registered for this event!";
            }
        }

        $stmt->close();
    } else {
        die("Prepare failed: " . $conn->error);
    }
}

// Fetch all events and user's registration status
$events_sql = "SELECT e.*, IFNULL(r.member_id, 0) AS registered FROM events e LEFT JOIN registrations r ON e.id = r.event_id AND r.member_id = ? ORDER BY e.event_date DESC";
if ($stmt = $conn->prepare($events_sql)) {
    $stmt->bind_param("i", $user_id); // Bind parameters as integer
    $stmt->execute();
    $events_result = $stmt->get_result();
} else {
    die("Prepare failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <link rel="stylesheet" href="../styless.css">
    <script>
        function showPopup(message, type) {
            const popup = document.createElement('div');
            popup.className = `popup ${type}`;
            popup.innerText = message;

            document.body.appendChild(popup);

            // Center the popup
            const width = popup.offsetWidth;
            const height = popup.offsetHeight;
            popup.style.left = `calc(50% - ${width / 2}px)`;
            popup.style.top = `calc(50% - ${height / 2}px)`;

            setTimeout(() => {
                popup.remove();
            }, 3000); // Popup will disappear after 3 seconds
        }

        window.onload = function() {
            <?php if ($success_message): ?>
                showPopup("<?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>", "success");
            <?php endif; ?>
            <?php if ($error_message): ?>
                showPopup("<?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>", "error");
            <?php endif; ?>
        };
    </script>
    <style>
        .popup {
            position: fixed;
            background-color: rgba(33, 29, 253, 0.7);
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            text-align: center;
            white-space: nowrap;
        }
        .popup.success {
            background-color: #28a745;
        }
        .popup.error {
            background-color: #dc3545;
        }
        .popup {
            opacity: 1;
        }
    </style>
</head>
<body>
    <header>
        <h1>ASSIGNMENT</h1>
        <nav>
            <ul>
                <li><a href="../member/member.php">back</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="events-list">
            <h2>assignment uploaded</h2>
            <ul>
                <?php while ($event = $events_result->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($event['name'], ENT_QUOTES, 'UTF-8'); ?></strong> - <?php echo htmlspecialchars($event['event_date'], ENT_QUOTES, 'UTF-8'); ?>
                        <p><?php echo htmlspecialchars($event['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php if ($event['registered'] == $user_id): ?>
                            <!-- <a href="newTest.php?cancel_event_id=<?php echo urlencode($event['id']); ?>" class="register-button">Cancel Registration</a> -->
                        <?php else: ?>
                            <!-- <a href="newTest.php?register_event_id=<?php echo urlencode($event['id']); ?>" class="register-button">Register for this Event</a> -->
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
