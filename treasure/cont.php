<!DOCTYPE html>
<html><head><title>countribution</title>
<style>
    table{
    border-collapse:collapse;
    width:100%;
}
 #table2{
    border-collapse:collapse;
       width:15%;
   }
    .header{
        background-color:silver;
    }
    .body{
        width:100%;
        height:470px;
        background-image:url("msalaba.webp");
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
   <center> <div class="logo" ><img src="../images/logo.png" style="height:100px;width:100px;"></div></center>
   <center><div class="cont"><b>CONTRIBUTION DETAILS</b><button id="gomha" style="float:right;">GO BACK</button></div></center>
</div>
<div class="body">
<div id="table2">
    <?php
     session_start();
     include'../db.php';
    $sql="SELECT sum(amount) as total_amount FROM contributions ";
    $results=$conn->query($sql);
    if($results->num_rows>0){
     echo "<table border='2'>";
     echo "<tr><th>TOTAL  AMOUNT</th></tr>";
          
     while($row=$results->fetch_assoc()){

        echo "<tr>";
         echo "<td> Tsh. ".$row["total_amount"]."/=</td>";
         echo "</tr>";
         }echo "</table>";
     }
     else{
         echo "0 results";
     } 
    ?>
    

    <?php
    $sql="SELECT count(amount) as count FROM contributions ";
    $results=$conn->query($sql);
    if($results->num_rows>0){
     echo "<table border='2'>";
     echo "<tr><th>NO.MEMBER PAID</th></tr>";
          
     while($row=$results->fetch_assoc()){

        echo "<tr>";
         echo "<td>   ".$row["count"]."</td>";
         }echo "</table>";
     }
     else{
         echo "0 results";
     }
    ?></div>
   <div class="search-container" style="width:100%;">
        <form method="POST" action="" style="float:right;height:40px;">
            <input type="text" id="search" name="search" placeholder="Enter contribution type or amount" style="border-radius:8px;height:35px;"  value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
            <button type="submit" style="border-radius:8px;height:40px;">Search</button>
            <?php if (isset($_POST['search']) && !empty($_POST['search'])): ?>
                <!-- "Clear" button to reset the search -->
                <form method="POST" action="" style="margin-left: 10px; display: inline;">
                    <button type="submit" name="clear" style="border-radius:8px;height:40px;">Clear</button>
                </form>
            <?php endif; ?>
        </form>
    </div><br><br>
    <?php
    // Prepare the search term
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $search = $conn->real_escape_string($search);

        // Clear search
        if (isset($_POST['clear'])) {
            $search = '';
        }

        // Modify the query based on the search term
        $sql = "SELECT * FROM contributions WHERE type LIKE '%$search%' OR amount LIKE '%$search%'";
        $results = $conn->query($sql);
        if (isset($_GET['update_success']) && $_GET['update_success'] == '1') {
            echo "<p style='text-align: center; color: green;'>Record updated successfully.</p>";
        }

        // Display results
        if ($results->num_rows > 0) {
            echo"<center>"."ALL CONTRIBUTION DETAILS"."</center>";
            echo "<table border='2'style='width:100%'>";
            echo "<tr><th>NAME</th><th>CONTRIBUTION TYPE</th><th>AMOUNT</th><th>DATE</th></tr>";

            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" .htmlspecialchars($row["full_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["type"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["amount"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        // Close connection
        $conn->close();
        ?></div>
    <footer ><marquee><p><b><i>"Bring the full amount of your tithes to the Temple,
        so that there will be plenty of food there.Put me to the test 
        and your wiil see that I will open the window of heaven and pour out on 
        you in abundance all kinds of good things".Malachi 3;10;</i></b></p></marquee></footer>
</body>
<script>
    document.getElementById("gomha").addEventListener("click",function(){window.location.href="mhazini.php";});
</script>
</html>