<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers Dashboard</title>
    <!-- <title>Secretary Dashboard</title> -->

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #fff;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #999966;
            color: white;
            padding: 10px;
            text-align: center;
            position: relative;
        }
        .menu-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Initially hidden */
            background-color: #3B4513;
            padding-top: 20px;
            color: white;
            overflow: auto;
            transition: left 0.3s ease;
            /* No shadow on sidebar */
        }
        .sidebar.active {
            left: 0;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #A0522D; /* Hover effect */
        }

        main {
            margin-left: 260px;
            padding: 20px;
        }

        /* Overlay for shadow effect on rest of the page */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Shadow effect */
            z-index: 1; /* Place it behind the sidebar */
        }
        .overlay.active {
            display: block;
        }

        /* Ensure the sidebar stays above the overlay */
        .sidebar {
            z-index: 2;
        }
    </style>
</head>
<body> 
    <header>
        <span class="menu-icon" id="menu-icon"><i class="fas fa-bars"></i></span>
        <div class="head" >
            
        <div id="../images/logo.png" style="width: 100%;height:20%; margin-top:20px">
        <div id="" style="width: 100%;height:20%; margin-top:20px">

     <img src="../images/logo.png" alt="HAMNA PICHA" style="height: 150px;  align-items: left;"></div>
     <img  style="height: 150px;  align-items: left;"></div>

    
     <h1 style="text-align: center;" >  Evangelistic Assemblies of God Tanzania</h1>
     <h1 style="text-align: center;" >  WELCOME TEACHER IN LEARNING SYSTEM</h1>

     
     <h1 style="text-align: center;" > EAGT</h1></div>
     <h1 style="text-align: center;" > LEANERS</h1></div>

    </header>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
    <img src="../images/logo.png" alt="HAMNA PICHA" style="height: 150px;  align-items: left;">
    <img  style="height: 150px;  align-items: left;">

    <br><br>
       
       
        <a href="register_member.php"><i class="fas fa-user-plus"></i> Register Member</a> 
        <a href="all_member.php"><i class="fas fa-users"></i> All Members</a>
        <a href="event_records.php"><i class="fas fa-calendar-alt"></i> View quizzes Records</a> 
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Overlay for sidebar -->
    <div class="overlay" id="overlay"></div>

    <main>
        
    </main>

    <script>
        // Sidebar toggle functionality
        const menuIcon = document.getElementById('menu-icon');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        // Show sidebar when menu icon is clicked
        menuIcon.addEventListener('click', function() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });

        // Hide sidebar when overlay is clicked
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Clicking a link will close the sidebar and overlay
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>
</body>
</html>
