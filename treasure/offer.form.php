<!DOCTYPE html>
<html>
    <head><title>form</title></head>
    <style>
        .form1{
            display: inline-block;
            margin-top: 30px;
            text-align: left;
            padding: 20px;
            
            background-color:silver;
            width:400px;
            border-radius:8px;
            height:1065px;
        }
        input{
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
    <center><div class="logo" ><img src="images/logo.png" style="height:100px;width:100px;float:center;"></div></center>
    <center><div class="cont" style="float:center;"><b>ADD NEW REPORT</b></div></center>
    <form id="form1" action="" method="POST">
                <label for="id">User ID</label><br>
                <input id="id" type="number" name="id" placeholder="Enter ID" required><br><br>
                <label for="username">Username</label><br>
                <input id="name" type="username" name="username" placeholder="Enter Username" required><br><br>
                <label for="password">password:</label><br>
                <input id="password" type="password" name="password" placeholder="Enter Password "required><br><br>
                <label for="fname" >First Name:</lable><br>
                <input id="fname" type="text" name="first_name" placeholder="Enter First Name" required><br><br>
                <label for="mname" >Middle Name:</lable><br>
                <input id="mname" type="text" name="middle_name" placeholder="Enter Middle Name" required><br><br>
                <label for="lname" >Last Name:</lable><br>
                <input id="last_name" type="text" name="last_name" placeholder="Enter Last Name" required><br><br>
                <label for="gender" >Gender:</lable><br>
                <select id="gender" type="text" name="gender" placeholder="Enter ender" required>
                    <option>MALE</option>
                    <option>FEMALE</option>
                </select><br><br>
                <label for="role" >Role:</lable><br>
                <select id="role" type="text" name="role" placeholder="Role" required>
                   <option>PASTOR</option>
                   <option>MEMBER</option>
                   <option>TREASURE</option>
                   <option>PERMANENT SECRETARY</option>
                </select><br><br>
                <label for="marital" >Marital Status:</lable><br>
                <select id="marital_status" type="text" name="marital_status" placeholder="Enter marital Status" required>
                   <option>SINGLE</option>
                   <option>MARRIED</option>
                   <option>WIDOWED</option>
                </select><br><br>
                <label for="address" >Address:</lable><br>
                <input id="address" type="text" name="address" placeholder="Enter Address" required><br><br>
                <label for="pnumber" >Phone Number:</lable><br>
                <input id="pnumber" type="number" name="phone_number" placeholder="Enter Phone Number" required><br><br>
               <center> <button id="submit" name="insert" >SUBMIT</button><br><br></center>
                <button id="close" type="close" name="close" style="float:right;"> <a href="katibu.php" >CLOSE</a></button><br>
    
            
            <?php
             session_start();
             include 'db.php';
             if($_SERVER['REQUEST_METHOD']==='POST'){
             if(isset($_POST["insert"])){
                    $id=$_POST['id']; 
                    $username=$_POST['username'];
                    $password=$_POST['password'];
                    $first_name=$_POST['first_name'];
                    $middle_name=$_POST['middle_name'];
                    $last_name=$_POST['last_name'];
                    $gender=$_POST['gender'];
                    $role=$_POST['role'];
                    $marital_status=$_POST['marital_status'];
                    $address=$_POST['address'];
                    $phone_number=$_POST['phone_number'];

                   $sql="INSERT  INTO members VALUES ('$id','$username','$password','$first_name','$middle_name','$last_name','$gender','$role','$marital_status','$address','$phone_number')";
                   if($conn->query($sql)===TRUE){
                    echo "New record added successfully";
                   }else{
                    echo "Error: ".$sql."<br>".$conn->error;
                   }
            }}
       ?></form></div>
    </body>
    </html>