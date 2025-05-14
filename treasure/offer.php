<!DOCTYPE html>
<html><head><title>countribution</title>
<style>
    table{
    border-collapse:collapse;
    width:25%;
    float:left;
    }
    .header{
        background-color:silver;
    }
    .body{
        width: 100%;
        height:470px;
        background-image:url("msalaba.webp");
        padding-top:5px;
    }
    footer{
            height:50px;
            background-color:lightblue;
        }
        th{
            background-color:lightblue;
        }
   </style>
   <body>
    <div class="header" >
   <center> <div class="logo" ><img src="../images/logo.png" style="height:100px;width:100px;"></div>
    <div class="cont"><b>OFFERING REPORT</b><button id="back" style="float:right;">GO BACK</button></div>
   </center></div>
   <center><div class="body">
   <?php
   session_start();
   include'../db.php';
   $sql="SELECT sum(amount) as Thanks from  offering where offering_type='Thanks Giving'";
   $results=$conn->query($sql);
   if($results->num_rows>0){
    echo "<table border='2'>";
    echo "<tr><th>TOTAL THANKS GIVING</th></tr>";
         
    while($row=$results->fetch_assoc()){
        echo "<tr>";
        echo "<td> Tsh. ".$row["Thanks"]."/=</td>";
        echo "</tr>";
        }echo "</table>";
    }
    else{
        echo "0 results";
    } 
    $sql="SELECT sum(amount) as offering from  offering where offering_type='Offering'";
   $results=$conn->query($sql);
   if($results->num_rows>0){
    echo "<table border='2'>";
    echo "<tr><th>TOTAL OFFERING</th></tr>";
         
    while($row=$results->fetch_assoc()){
        echo "<tr>";
        echo "<td> Tsh. ".$row["offering"]."/=</td>";
        echo "</tr>";
        }echo "</table><br><br><br>";
    }
    else{
        echo "0 results";
    } 
    ?>
    <div class="off"><center> ALL CONTRIBUTION DETAILS</center>
    <?php
    $sql="SELECT * from offering";
   $results=$conn->query($sql);
   if($results->num_rows>0){
    echo "<table border='2' style='width: 100%;'>";
    echo "<th>TYPE</th><th>AMOUNT</th><th>DATE</th></tr>";
         
    while($row=$results->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["offering_type"]."</td>";
        echo "<td>".$row["amount"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "</tr>";
        }echo "</table>";
    }
    else{
        echo "0 results";
    }
    ?>
    </div>
</div></center>


    <footer ><marquee><p><b><i>"Bring the full amount of your tithes to the Temple,
        so that there will be plenty of food there.Put me to the test 
        and your wiil see that I will open the window of heaven and pour out on 
        you in abundance all kinds of good things".Malachi 3;10;</i></b></p></marquee></footer>
</body>
<script>
    document.getElementById('back').addEventListener('click',function(){window.location="mhazini.php";});
</script>
</html>