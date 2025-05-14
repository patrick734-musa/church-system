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
    <title>Event Records</title>
    <link rel="stylesheet" href="newstyles.css">
</head>
<body>
    <header>
        <h1>Event Registration Records</h1>
        <nav>
            <ul>
                <li><a href="pastor.php">back</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="records-container">
            <h2>Registered Events</h2>
            <table>
                <thead>
                    <tr>
                        <th>s/n</th>
                        <th>Member Name</th>
                        <th>Registered Events</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php while ($registration = mysqli_fetch_assoc($registrations_result)): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($registration['member_name']); ?></td>
                            <td><?php echo htmlspecialchars($registration['events']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>
