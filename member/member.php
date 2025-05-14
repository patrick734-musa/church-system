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
a{
    color: blue;
    text-align: end;
}
       

        .profile-table th, .events-table th, .offering-report-table th, .contribution-table th {
            background-color: #f4f4f4;
        }
        .contant{
            width: 100%;
            height: 80%;
            background-color: rgb(34, 138, 179);
            text-align: center;
            color: magenta;
            padding: 100px;
            background-color:darkkhaki;
            background-image: url(../images.kanisa/mikono.jpg) ,url(../images.kanisa/tamasha.jpg);
         background-repeat:repeat,repeat;
         background-blend-mode:soft-light;
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
/* footer and social media */

footer {
    background: rgb(5, 6, 54);
    padding: 15px;
    height: 290px;

}

footer .footer {

    display: flex;
    margin: 0 auto;
    max-width: 100%;
    opacity: 1;
    justify-content: space-between;
    border-bottom: 1px solid rgb(244, 244, 244);

}

footer .footer .media {
    display: flex;
    justify-content: space-between;
}

footer .footer p {
    color: white;
    padding: 20px;
    font-size: 1.0rem;

}
        
    </style>

</head>
<body>
    <div class="head" >
        <!-- <div id="EAGT LOGO.jpg" style="width: 20%;height:20%;"> -->
        <div id="" style="width: 20%;height:20%;">

     <!-- <img src="EAGT LOGO.jpg" alt="HAMNA PICHA" style="height: 150px;  align-items: left;"></div> -->
     <img style="height: 150px;  align-items: left;"></div>

    
     <!-- <h1 style="text-align: center;" > welcome Evangelistic Assemblies of God Tanzania</h1> -->
     <h1 style="text-align: center;" > welcome to learning system</h1>

     
     <!-- <h1 style="text-align: center;" > EAGT</h1></div>  -->
     <!-- <h1 style="text-align: center;" > learning system</h1></div>  -->
     
     <div class="logout">
      
<a href="../logout.php"><h2>LOGOUT</h2></a>
<div class="icon"> 
<!-- Button to open the sidebar -->
<button class="openbtn" onclick="openNav()">☰ </button>
</div>
<div class="contant" style="height: 400px;">
   
        <!-- The sidebar -->
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="myfile.php">MY profile</a>
            <!-- <a href="../PermanentSecretary/newTest.php">Register for Events</a> -->
            <a href="../PermanentSecretary/newTest.php">veiw uploaded quizzes</a>

           
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
    <div class="footer">
        <footer>
    
    
                <p>
                    MITANDAO YETU <br><i id="you" class="fa fa-youtube-play">eagt TV</i><br>
                    <i id="insta" class="fa fa-instagram"></i>eagt@.co.tz<br>
                    <i id="in" class="fa fa-twitter-square">eagt@.co.tz</i><br>
                    <i id="twiter" class="fa-brands fa-square-x-twitter"></i><br>
                </p>
                <!-- <p>MAWASILIANO<br> 0622444331 <br>0753345678 <br>eagttaifa@gmail.com</p> -->
                <!-- <p> copyright &copy;2024 <br>All rights and Conditions Are Reserved </p> -->
            </div>
        </footer>
    </div>
     
   
    </body>
    </html>