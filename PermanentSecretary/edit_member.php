<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <style>
        body {
            background-color: #ffff99;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            height: 30px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            height: 35px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
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
<div class="button-group">
            <a href="secretary_dashboard.php">Back</a>
        </div>
    <h1>Edit Member</h1>
    <div class="container">
        <?php
        session_start();
        include 'db.php';

       
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $id = $_POST['id'];
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $role = $_POST['role'];
            $marital_status = $_POST['marital_status'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone_number = $_POST['phone_number'];

            $updateQuery = "UPDATE members SET first_name=?, middle_name=?, last_name=?, gender=?, role=?, marital_status=?, address=?, username=?, password=?, phone_number=? WHERE id=?";
            $stmt = $conn->prepare($updateQuery);
            
            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("sssssssssss", $first_name, $middle_name, $last_name, $gender, $role, $marital_status, $address, $username, $password, $phone_number, $id);

            if ($stmt->execute()) {
                $stmt->close();
               
                header("Location: all_member.php?update_success=1");
                exit();
            } else {
                echo "<p>Error updating record: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM members WHERE id = ?";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="edit_member.php" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <label>First Name:</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required>
                    
                    <label>Middle Name:</label>
                    <input type="text" name="middle_name" value="<?php echo htmlspecialchars($row['middle_name']); ?>" required>
                    
                    <label>Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required>
                    
                    <label>Gender:</label>
                    <input type="text" name="gender" value="<?php echo htmlspecialchars($row['gender']); ?>" required>
                    
                    <label>Role:</label>
                    <input type="text" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" required>
                    
                    <label>Marital Status:</label>
                    <input type="text" name="marital_status" value="<?php echo htmlspecialchars($row['marital_status']); ?>" required>
                    
                    <label>Address:</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
                    
                    <label>User Name:</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                    
                    <label>Password:</label>
                    <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
                    
                    <label>Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo htmlspecialchars($row['phone_number']); ?>" required>
                    
                    <input type="submit" name="update" value="Edit">
                </form>
                <?php
            } else {
                echo "<p>No member found with that ID.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>No ID parameter provided.</p>";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
