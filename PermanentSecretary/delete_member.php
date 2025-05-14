<?php
include 'db.php';

$response = ['success' => false, 'message' => ''];

if (isset($_POST['id'])) {
    $member_id = intval($_POST['id']);
    $deleteQuery = "DELETE FROM members WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $member_id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = $stmt->error;
    }

    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
