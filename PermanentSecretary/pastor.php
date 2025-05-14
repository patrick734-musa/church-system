<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMBER PAGE</title>
    <!-- link for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fbfbfd;
            margin: 0;
            position: relative;
            height: 100vh;
            text-align: center;
        }

        
        .head{
background-color: white;
width: 100%;
padding-bottom: 15px;

height:150px;
        }

.logout{
    text-align: right;
    background-color: white;
    margin-bottom: 2px solid black;
    color: blue;
    padding: 0px;
    padding-top: 5px;
    margin-top: 2px  black;
width: 100%;
}
#box{
    color: white;
    text-align: end;
}
       

        .profile-table th, .events-table th, .offering-report-table th, .contribution-table th {
            background-color: #f4f4f4;
        }
        .contant{
            width: 100%;
            height: 80%;
            background-color:rgb(163, 160, 160);
            text-align: center;
            color: magenta;
            padding: 20px;
        
        }
        .icon{
            text-align: left;
            background-color: white;
            padding-bottom: 5px;
        }
        .footer{
            font-size: 20px;
            width: 100%;
            height: 20%;
            background-color: rgb(5, 6, 54);
            padding: 15px;
            color: white;
        }
        #a1{
            text-align: left;
        }
        button{
            text-align: left;
            background-color: blue;
            display: left;
            padding:10px;
            font-size: 30px;
        }
        /* The button used to open the sidebar */
.openbtn {
    font-size: 20px;
    cursor: pointer;
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #2805c4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
}

/* The sidebar itself */
.sidebar {
    height: 85%;
    width: 0;
    position: fixed;
    top:0;
    right: 0; 
    background-color: #e9e0e0;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    z-index: 1000; /* Make sure it’s on top */
}

/* Sidebar links */
.sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #4a0fd3;
    display: block;
    transition: 0.3s;
}

/* Change color on hover */
.sidebar a:hover {
    color: #021d41;
}

/* The close button inside the sidebar */
.sidebar .closebtn {
    position: absolute;
    top: 0;
    left: 30px;
    font-size: 36px;
    margin-right: 100px;
}

/* The overlay */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(13, 3, 70, 0.5);
    display: none;
    z-index: 999; /* Make sure it’s behind the sidebar */
}


.bb {
    border: 2px solid grey;
    text-align: center;
    width: 50%;
    padding: 20px;
    background-color:blue;
    border-radius: 20px;
    font-size: 20px;
    color: white;
    font-size:awesome ;
    box-shadow: whitesmoke;
}
#LG{
    color: blue;
}
.bab{
    color: white;
    background-color: blue;
    border-radius: 30px;
    padding: 12px;
    width: 25%;
    text-align: center;
}
        
    </style>

</head>
<body>
    <div class="head" >
        <div id="EAGT LOGO.jpg" style="width: 20%;height:20%;">
     <img src="EAGT LOGO.jpg" alt="HAMNA PICHA" style="height: 150px;  align-items: left;"></div>
    
     <h1 style="text-align: center;" > welcome Evangelistic Assemblies of God Tanzania</h1>
     
     <h1 style="text-align: center;" > EAGT</h1>
     
    </div> 
     <h1 style="text-align: center;color:darkblue;"> WELCOME PASTOR</h1>
     
     <a id="LG" href="../home.php" style="text-align: left; text-decoration:none;"><h2>LOGOUT</h2></a>
<div class="icon"> 
</div>
<div class="contant" style="height: 450px;">
        <div id="room">
            <br></br>
        <button class="bb"onclick="" style="text-decoration:none;"><a id="box" href="pastorMember.php"><b>CHURCH MEMBERS</b></a></button><br><br>
        <button class="bb"onclick=""><a id="box" href="NEWrecord.php"><b>EVENTS ATTENDENCE</b></a></button><br><br>
          
           
            
           
        </div>
        <!-- The sidebar -->
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="myprofile.php">MY profile</a>
            <a href="#services">Veiw Events</a>
            <a href="chistory.php">Contribution History</a>
            <a href="offering.php">Contribution & Offering</a>
        </div>
    
        <!-- Overlay to close the sidebar when clicked -->
        <div id="overlay" class="overlay" onclick="closeNav()"></div>
    
        <script>
            function openNav() {
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("overlay").style.display = "block";
            }
    
            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("overlay").style.display = "none";
            }
        </script>
    
    
    </div>
    
   
    </body>
    </html>