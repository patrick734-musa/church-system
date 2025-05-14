<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member</title>
    <link rel="stylesheet" href="style1.css"> <!-- Path to CSS -->
    <style>
        .success-message {
            color: green;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            display: none; /* Hidden by default */
        }
        .popup {
            display: none; /* Hidden by default */
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .popup-overlay {
            display: none; /* Hidden by default */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .popup button {
            margin: 5px;
        }
    </style>
</head>
<?php
session_start();
include 'db.php';

$successMessage = '';
$showPopup = 'none';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if POST variables are set
    if (isset($_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $_POST['gender'], $_POST['role'], $_POST['marital_status'], $_POST['address'], $_POST['username'], $_POST['password'], $_POST['phone_number'])) {
        // Collect and sanitize user input
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $middle_name = $conn->real_escape_string($_POST['middle_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $role = $conn->real_escape_string($_POST['role']);
        $marital_status = $conn->real_escape_string($_POST['marital_status']);
        $address = $conn->real_escape_string($_POST['address']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        $phone_number = $conn->real_escape_string($_POST['phone_number']);

        // Check if the username already exists
        $check_sql = "SELECT * FROM members WHERE username='$username'";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            echo "Error: Username already exists.";
        } else {
            // Construct the SQL query
            $sql = "INSERT INTO members (first_name, middle_name, last_name, gender, role, marital_status, address, username, password, phone_number)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$gender', '$role', '$marital_status', '$address', '$username', '$password', '$phone_number')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                $successMessage = "New member registered successfully!";
                $showPopup = 'block'; // Show popup dialog
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    } else {
        echo "Error: Missing form fields.";
    }
}
?>
 
<body>
    <?php
    // PHP block for handling form submissions and showing messages
    ?>

    <header style="position:sticky">
        <a href="secretary_dashboard.php">Back to Permanent Secretary Page</a>
    </header>
    <div class="content">
        <h2>Register Member</h2>

        <!-- Success Message -->
        <div class="success-message" id="successMessage">
            <?php echo $successMessage; ?>
        </div>

        <form action="register_member.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name">
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="member">Member</option>
                <option value="pastor">Pastor</option>
                <option value="permanent_secretary">Permanent Secretary</option>
                <option value="treasurer">Treasurer</option>
            </select>
            
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status" required>
                <option value="single">Single</option>
                <option value="married">Married</option>
            </select>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            
            <button type="submit">Register Member</button>
        </form>
    </div>

    <!-- Popup Dialog -->
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popupDialog">
        <p><?php echo $successMessage; ?></p>
        <button id="confirmButton">OK</button>
        <button id="cancelButton">Cancel</button>
    </div>

    <!-- JavaScript to Show and Handle the Popup -->
    <script>
        window.onload = function() {
            var successMessage = "<?php echo $successMessage; ?>";
            var showPopup = "<?php echo $showPopup; ?>";
            
            if (successMessage) {
                document.getElementById('popupOverlay').style.display = 'block';
                document.getElementById('popupDialog').style.display = 'block';
                
                document.getElementById('confirmButton').onclick = function() {
                    document.getElementById('popupOverlay').style.display = 'none';
                    document.getElementById('popupDialog').style.display = 'none';
                    // You can redirect or show a new message here if needed
                };

                document.getElementById('cancelButton').onclick = function() {
                    document.getElementById('popupOverlay').style.display = 'none';
                    document.getElementById('popupDialog').style.display = 'none';
                };
            }
        };
    </script>
</body>
</html>
