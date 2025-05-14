<!DOCTYPE html>
<html>
    <head> 
        <title>MHAZINI</title>
    </head>
    <style>
        div{
           
        }
    .header{
            height:100px;
            background-color:rgb(151, 172, 172);
            text-shadow: 2px 2px rgb(241, 137, 189);
        }
        .pic{
            float:left;
            height:100px;
            width:100px;
        }
        .title{
            float:;
            font-size:50px;
            text-align:center;
        }
        .logout{
            height:40px;
            background-color:silver;
        }
        .logoutbutton{
            height:40px;
            width:80px;
            background-color:lightyellow;
            border-radius:12px;
            float:right;
        }
        .body{
            height:400px;
            padding-left:500px;
            padding-top:100px;
            background-color:green;
            background-image:url("../images/msalababustani.webp");
        }
        .button{
            height:40px;
            width:300px;
            border-radius:10px;
        }
        footer{
            height:50px;
            background-color:lightblue;
        }
        
    </style>
    <body>
    <div class='header' >
        <div class='pic' ><img src="../images/logo.png" style="height:100px;width:100px;"></div>
        <div class='title' ><b>WELCOME TREASURE</b></div>
        <div><button id="out" class='logoutbutton'>LOGOUT</button></div>
    </div>
    <div class='body'>
       <button id="cont" class="button">ADD NEW RECORD</button><br><br>
       <button id="viewcont" class="button">VIEW CONTRIBUTION</button><br><br>
       <button id="addOffer" class="button">ADD OFFERING REPORT</button><br><br>
       <button id="viewoffer" class="button">VIEW OVERALL REPORT</button>
    </div>
    <footer ><marquee><p><i><b>"don't worry about anything ,
         but in all your prayers ask God for what you need,
         always ask him with thankful heart. And God's peace, 
         which is far beyound the human understanding, will keep your hearts
         and minds safe in union with christ jesus." philippians 4:6-7;</b></i></p></marquee></footer>
           

       
    </body>
    <script>
        document.getElementById("cont").addEventListener("click",function(){window.location.href="contribution.php";});
        document.getElementById("viewcont").addEventListener("click",function(){window.location.href="cont.php";});
        document.getElementById("addOffer").addEventListener("click",function(){window.location.href="addOffer.php";});
        document.getElementById("viewoffer").addEventListener("click",function(){window.location.href="offer.php";});
        document.getElementById("out").addEventListener("click",function(){window.location.href="../home.php"});
    </script>
    </html>