<!DOCTYPE html>
<html>
    <head><title>form</title></head>
    <style>
        .form1{
            display: inline-block;
            margin-top: 30px;
            text-align: left;
            padding: 20px;
            float:center;
            background-color:lightblue;
            width:400px;
            border-radius:8px;
            height:640px;
        }
        select,input{
            border:none;
            width:400px;
            border-radius:6px;
            height:50px;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: lightyellow;
            color: #333;
            margin: 0;
            padding: 0;
        }
        button:hover {
            background-color: #357ae8;
        }
        #submit{
            cursor: pointer;
            width:400px;
            border:none;
            height:40px;
            border-radius:10px;
            background-color: #4285F4;
        }
    </style>
    <body>
        <div class="form1">
    <center><div class="logo" ><img src="../images/logo.png" style="height:100px;width:100px;float:center;"></div></center>
    <center><div class="cont" style="float:center;"><b>ADD NEW RECORD</b></div></center>
    <form id="form1" action="" method="POST">
                <label for="id">Full Name</label><br>
                <input id="full_name" type="text" name="full_name" placeholder="Enter ID" required><br><br>
                <label for="member_id">Member_ID</label><br>
                <input id="member_id" type="number" name="member_id" placeholder="Enter Member ID" required><br><br>
                <label for="type">Type Of Contribution</label><br>
                <select id="type" type="text" name="type" placeholder="Enter Cont.Type" style="" required>
                <option>Meeting</option>
                   <option>Tithe</option>
                   <option>Building</option>
                </select><br><br>
                <label for="amount">Amount:</label><br>
                <input id="amount" type="number" name="amount" placeholder="Enter Amount "required><br><br>
                <label for="date">Date:</label><br>
                <input id="date" type="date" name="date" placeholder="Enter Date "required><br><br>
               <center> <button id="submit" name="insert" >SUBMIT</button><br><br></center>
                <button id="close" type="close" name="close" style="float:right;background-color:red;height:40px;border-radius:8px; ">CLOSE</button><br>
    
            
                <?php
session_start();
include'../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["insert"])) {
        $full_name = $_POST['full_name'];
        $member_id = $_POST['member_id'];
        $type= $_POST['type'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];

        // SQL query with explicit column names
        $sql = "INSERT INTO contributions (full_name, member_id, type, amount, date) VALUES ('$full_name', '$member_id', '$type', '$amount', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "New record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
</body>
<script>
    document.getElementById("close").addEventListener("click",function(){window.location.href="mhazini.php";});
</script>
</html>
