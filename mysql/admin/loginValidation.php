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
        $result = mysqli_query($conn, "SELECT account_name, a.account_type_id, account_password FROM accounts a, accounttype at WHERE account_name = '$username' AND account_password = '$password' AND a.account_type_id = at.account_type_id");        
        if (mysqli_num_rows($result) === 0) { 
           //results are empty, do something here
            $_SESSION["message"] = 'Incorrect Username and Password';
            //<script>alert("Wrong Credentials, Please check again.")</script>
            header("Location:index.php");
            mysqli_close($conn);
        }else{
            $row_result = mysqli_fetch_assoc($result);
            if($row_result['account_type_id'] === '1'){
                mysqli_close($conn);
                header("Location:dashboard.php");
            }else{
                /* Not done yet, do not test */
                mysqli_close($conn);
                header("Location:userDashboard.php");
            }
        }
    }
}
