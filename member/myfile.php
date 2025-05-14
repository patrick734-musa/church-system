<?php
session_start();
include '../db.php';

// Check if the form is submitted to upload a profile picture
if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id']; // assuming user_id is stored in session

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['profile_picture']['name'];
        $file_size = $_FILES['profile_picture']['size'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed)) {
            if ($file_size < 5000000) { // Limit file size to 5MB
                $new_file_name = uniqid('', true) . "." . $file_ext;
                $upload_directory = 'myfile.php' . $new_file_name;
                move_uploaded_file($file_tmp, $upload_directory);

                // Get the current profile picture path
                $sql = "SELECT profile_picture FROM members WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $user_data = $result->fetch_assoc();

                // Remove the old profile picture if it exists
                if (!empty($user_data['profile_picture']) && file_exists($user_data['profile_picture'])) {
                    unlink($user_data['profile_picture']);
                }

                // Update the database with the new profile picture path
                $sql = "UPDATE members SET profile_picture = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $upload_directory, $user_id);
                if ($stmt->execute()) {
                    $_SESSION['profile_picture'] = $upload_directory; // Update session variable
                    $success_msg = "Profile picture updated successfully.";
                } else {
                    $error_msg = "Failed to update profile picture in database.";
                }
            } else {
                $error_msg = "File size is too large. Maximum size is 5MB.";
            }
        } else {
            $error_msg = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $error_msg = "Please choose a file to upload.";
    }
}

// Handle profile picture removal
if (isset($_POST['remove_picture'])) {
    $user_id = $_SESSION['user_id'];

    // Get the current profile picture path
    $sql = "SELECT profile_picture FROM members WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();

    // Delete the profile picture file if it exists
    if (!empty($user_data['profile_picture']) && file_exists($user_data['profile_picture'])) {
        unlink($user_data['profile_picture']);
    }

    // Remove the profile picture from the database
    $sql = "UPDATE members SET profile_picture = NULL WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $_SESSION['profile_picture'] = null; // Remove from session
        $success_msg = "Profile picture removed successfully.";
    } else {
        $error_msg = "Failed to remove profile picture.";
    }
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM members WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
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
        .profile-picture-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-picture-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #8B4513;
        }
        .profile-picture-container input[type="file"] {
            display: block;
            margin: 10px auto;
        }
        .profile-picture-container button {
            background-color: #8B4513;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 50px;
            font-size: 16px;
            margin: 5px;
            transition: background-color 0.3s;
        }
        .profile-picture-container button:hover {
            background-color: #A0522D;
        }
        .remove-btn {
            background-color: #f44336;
        }
        .remove-btn:hover {
            background-color: #e60000;
        }
        .info-section {
            text-align: left;
        }
        .info-section p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }
        .success-msg {
            color: green;
            text-align: center;
        }
        .error-msg {
            color: red;
            text-align: center;
        }
        .button-group a {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            color: #fff;
            background-color: #4CAF70;
            text-decoration: none;
            border-radius: 4px;
            
        }
    </style>
</head>
<body>

<div class="container">
    <h1>My Profile</h1>

    <!-- Profile Picture Section -->
    <div class="profile-picture-container">
        <?php if (!empty($user_data['profile_picture'])): ?>
            <img src="<?php echo htmlspecialchars($user_data['profile_picture']); ?>" alt="Profile Picture">
        <?php else: ?>
            <!-- Display a default profile picture with an icon when no picture is uploaded -->
            <img src="../uploads/default-profile-with-icon.png" alt="Default Profile Picture">
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="profile_picture" accept="image/*">
            <button type="submit" name="submit">Upload Profile Picture</button>
        </form>

        <form action="" method="POST">
            <?php if (!empty($user_data['profile_picture'])): ?>
                <button type="submit" name="remove_picture" class="remove-btn">Remove Profile Picture</button>
            <?php endif; ?>
        </form>

        <!-- Display Success or Error Message -->
        <?php if (isset($success_msg)): ?>
            <p class="success-msg"><?php echo $success_msg; ?></p>
        <?php elseif (isset($error_msg)): ?>
            <p class="error-msg"><?php echo $error_msg; ?></p>
        <?php endif; ?>
    </div>

    <!-- Profile Info Section -->
    <div class="info-section">
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user_data['first_name']); ?></p>
        <p><strong>Middle name:</strong> <?php echo htmlspecialchars($user_data['middle_name']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user_data['last_name']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($user_data['gender']); ?></p>
        <p><strong>Marital status:</strong> <?php echo htmlspecialchars($user_data['marital_status']); ?></p>
        <p><strong>Your role:</strong> <?php echo htmlspecialchars($user_data['role']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user_data['username']); ?></p>
        <p><strong>Your Password:</strong> <?php echo htmlspecialchars($user_data['password']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['address']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user_data['phone_number']); ?></p>
        <div class="button-group">
            <a href="member.php">Back</a>
        </div>
    </div>
</div>

</body>
</html>
