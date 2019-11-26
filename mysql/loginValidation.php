<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
        
// Create connection
$servername = 'rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com';
$username = '1800867CYH';
$password = '19ICT2103';
$database = '1800867CYH';

$conn = mysqli_connect($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$db_selected = mysqli_select_db($conn, $database)
or die("Could not select examples");

if (isset($_POST["userId"])) {
    $username = $_POST["userId"];
    if (isset($_POST["pwd"])) {
        $password = $_POST["pwd"];        
        $result = mysqli_query($conn, "SELECT account_name, account_type, account_password FROM accounts WHERE account_name = '$username' AND account_password = '$password'");        
        if (mysqli_num_rows($result) === 0) { 
           //results are empty, do something here
            $_SESSION["message"] = 'Incorrect Username and Password';
            //<script>alert("Wrong Credentials, Please check again.")</script>
            header("Location:login.php");
            mysqli_close($conn);
        }else{
            $row_result = mysqli_fetch_assoc($result);
            
            $_SESSION["user_type"] = $row_result['account_type'];
            $_SESSION["user_name"] = $row_result['account_name'];

            if($row_result['account_type'] === 'admin'){
               
                mysqli_close($conn);
                header("Location:dashboard.php");
            }else if($row_result['account_type'] === 'user'){
                mysqli_close($conn);
                header("Location:index.php");
            }
        }
    }
}
