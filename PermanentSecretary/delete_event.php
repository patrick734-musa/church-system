<?php
session_start();
require_once 'db.php';

if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);

    // Delete event from the database
    $delete_sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $event_id);
    if ($stmt->execute()) {
        // Redirect to event records page after deletion
        header("Location: event_records.php");
        exit;
    } else {
        echo "Error deleting event: " . $conn->error;
    }
}
?>
