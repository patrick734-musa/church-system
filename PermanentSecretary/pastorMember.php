<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Members</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- External stylesheet -->

    <style>
        /* General Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.5rem; /* Adjusted for responsiveness */
            font-weight: 600;
            margin: 0;
        }

        /* Search Container */
        .search-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-container .search-icon {
            cursor: pointer;
            font-size: 1.5rem; /* Adjusted for consistency */
            color: #2c3e50;
            padding: 10px;
            transition: color 0.3s;
        }

        .search-container .search-icon:hover {
            color: #2980b9;
        }

        .search-container input[type="text"] {
            width: 0;
            padding: 0;
            opacity: 0;
            border: none;
            border-bottom: 2px solid #2c3e50;
            border-radius: 0;
            font-size: 1rem;
            outline: none;
            transition: width 0.4s, opacity 0.4s;
            background-color: transparent;
        }

        .search-container input[type="text"].active {
            width: 300px;
            padding: 10px;
            opacity: 1;
        }

        .search-container button {
            padding: 10px 20px;
            border: none;
            background-color: #2c3e50;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 50px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .search-container button:hover {
            background-color: #2980b9;
        }

        .total-members {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .records-container {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: box-shadow 0.3s ease;
        }

        .records-container:hover {
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th,td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
            font-size: 1.125rem;
        }

        td {
            font-size: 1rem;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.2s ease;
        }

        .action-btn {
            padding: 8px 12px;
            color: white;
            font-size: 0.875rem;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
            display: inline-flex;
            align-items: center;
        }

        .edit-btn {
            background-color: #27ae60;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .edit-btn:hover {
            background-color: #2ecc71;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .action-btn i {
            margin-right: 5px;
        }

       
        @media screen and (max-width: 768px) {
            .records-container {
                width: 95%;
                padding: 15px;
            }

            .header-container {
                flex-direction: column;
                align-items: center;
            }

            .search-container {
                flex-direction: column;
                align-items: center;
            }

            .search-container input[type="text"], 
            .search-container button {
                width: 100%;
                margin-bottom: 10px;
            }

            table, th, td {
                font-size: 0.875rem;
            }
        }

       
        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
            position: relative;
        }

        .modal-content h2 {
            margin-top: 0;
        }

        .modal-content button {
            padding: 10px 15px;
            border: none;
            color: white;
            background-color: #2c3e50;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .modal-content button:hover {
            background-color: #2980b9;
        }

        .modal-content .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
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
            <a href="pastor.php">Back</a>
        </div>
        
    <div class="header-container">
        <h1>All Members</h1>
       
        <div class="search-container">
            <i class="fas fa-search search-icon" id="searchIcon" aria-label="Search"></i>
            <form method="GET" action="">
                <input type="text" id="search" name="search" placeholder="Enter name or username" aria-label="Search Input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" aria-label="Search Button">Search</button>
            </form>

            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                <form method="GET" action="" style="margin-left: 10px;">
                    <button type="submit" aria-label="Clear Search">Clear</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php
    include 'db.php';

    if (isset($_GET['update_success']) && $_GET['update_success'] == '1') {
        echo "<p style='text-align: center; color: green;'>Record edited successfully.</p>";
    }

    if (isset($_GET['delete'])) {
        $member_id = intval($_GET['delete']);
        $deleteQuery = "DELETE FROM members WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $member_id);

        if ($stmt->execute()) {
            echo "<p style='text-align: center; color: green;'>Record deleted successfully.</p>";
        } else {
            echo "<p style='text-align: center; color: red;'>Error deleting record: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $search = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $search_query = "%" . $search . "%";
        $query = "SELECT * FROM members WHERE first_name LIKE ? OR last_name LIKE ? OR username LIKE ? ORDER BY id ASC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $search_query, $search_query, $search_query);
    } else {
        $query = "SELECT * FROM members ORDER BY id ASC";
        $stmt = $conn->prepare($query);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    $total_members = $result->num_rows; // Total number of members
    ?>

    <div class="total-members">Total Members: <?php echo $total_members; ?></div>

    <div class="records-container">
        <table>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Marital Status</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['middle_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td><?php echo htmlspecialchars($row['marital_status']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['password']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td>
                            <a href="edit_member.php?id=<?php echo $row['id']; ?>" class="action-btn edit-btn" aria-label="Edit Member"><i class="fas fa-edit"></i>Edit</a>
                            <a href="delete_member.php" class="action-btn delete-btn" data-id="<?php echo $row['id']; ?>" aria-label="Delete Member" onclick="showDeleteModal(event)"><i class="fas fa-trash-alt"></i>Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="12">No records found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button id="confirmDelete">Delete</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
        // Toggle search input field
        const searchIcon = document.getElementById('searchIcon');
        const searchInput = document.getElementById('search');

        searchIcon.addEventListener('click', () => {
            searchInput.classList.toggle('active');
            if (searchInput.classList.contains('active')) {
                searchInput.focus();
            }
        });

        // Modal functionality
        const deleteModal = document.getElementById('deleteModal');
        let deleteId = null;

        function showDeleteModal(event) {
            event.preventDefault();
            deleteId = event.currentTarget.getAttribute('data-id');
            deleteModal.style.display = 'flex';
        }

        function closeModal() {
            deleteModal.style.display = 'none';
        }

        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (deleteId !== null) {
                window.location.href = `?delete=${deleteId}`;
            }
        });

        window.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                closeModal();
            }
        });
    </script>
</body>
</html>
