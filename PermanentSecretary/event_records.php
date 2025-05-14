<?php
session_start();
require_once 'db.php';

// Fetch all event registrations and concatenate event names with their dates for each member
$registrations_sql = "
    SELECT m.id AS member_id, 
           CONCAT(m.first_name, ' ', m.last_name) AS member_name,
           GROUP_CONCAT(CONCAT(e.name, ' (', e.event_date, ')') ORDER BY e.event_date DESC SEPARATOR ', ') AS events
    FROM registrations er
    JOIN events e ON er.event_id = e.id
    JOIN members m ON er.member_id = m.id
    GROUP BY m.id
    ORDER BY MAX(e.event_date) DESC, m.last_name ASC
";
$registrations_result = mysqli_query($conn, $registrations_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Event Records</title> -->
    <title>uploaded quizzes</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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


        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            text-decoration: none;
            color: #007bff;
            padding: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .actions a:hover {
            background-color: #e9ecef;
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
            background-color: #007bff;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .modal-content button:hover {
            background-color: #0056b3;
        }

        .modal-content .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-message {
            margin-top: 10px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
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
    <main>
        <h1>Event Records</h1>
        <div class="button-group">
            <!-- <a href="view_event.php">view and edit events</a> -->
            <a href="view_event.php">view and edit quizzes</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Member Name</th>
                    <th>Event(s)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php while ($registration = mysqli_fetch_assoc($registrations_result)): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($registration['member_name']); ?></td>
                        <td><?php echo htmlspecialchars($registration['events']); ?></td>
                        <td class="actions">
                            <!-- Single view and delete links -->
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

   
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete all events for this member?</p>
            <div class="modal-message"></div>
            <button id="confirmDelete">Delete</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
        // Modal functionality
        const deleteModal = document.getElementById('deleteModal');
        const modalMessage = document.querySelector('.modal-message');
        let deleteId = null;

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                deleteId = this.getAttribute('data-id');
                deleteModal.style.display = 'flex';
            });
        });

        function closeModal() {
            deleteModal.style.display = 'none';
            modalMessage.innerHTML = ''; // Clear the message
        }

        document.getElementById('confirmDelete').addEventListener('click', () => {
            if (deleteId !== null) {
                // Perform AJAX request for deletion
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_event.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Parse the JSON response
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            modalMessage.innerHTML = `<p class="success">Events deleted successfully.</p>`;
                            setTimeout(() => {
                                location.reload(); 
                            }, 1500);
                        } else {
                            modalMessage.innerHTML = `<p class="error">Error deleting events: ${response.message}</p>`;
                        }
                    } else {
                        modalMessage.innerHTML = `<p class="error">Request failed. Please try again.</p>`;
                    }
                };
                xhr.send('member_id=' + deleteId);
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
