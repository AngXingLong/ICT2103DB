<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Start the session
session_start();

$userId = $pwd = $cfmPwd = $accountType = $firstName = $lastName = "";
$userIdErr = $pwdErr = $cfmPwdErr = $firstNameErr = $lastNameErr = "";

//Validate user input
$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountType = 2;
    
    $userId = trim($_POST["userId"]);
    if (empty($userId)) {
        $userIdErr = "Please enter an username";
        $valid = false;
    } else {
        $userId = trim($_POST["userId"]);
        $userIdErr = "";
    }
    
    $firstName = trim($_POST["firstName"]);
    if (empty($firstName)) {
        $firstNameErr = "Please enter first name";
        $valid = false;
    } else {
        $firstName = trim($_POST["firstName"]);
        $firstNameErr = "";
    }

    $lastName = trim($_POST["lastName"]);
    if (empty($lastName)) {
        $lastNameErr = "Please enter last name";
        $valid = false;
    } else {
        $lastName = trim($_POST["lastName"]);
        $lastNameErr = "";
    }

    $pwd = $_POST["pwd"];
    $cfmPwd = $_POST["cfmPwd"];
    $pwdPattern = "/^[0-9a-zA-Z]{8,}$/";
    $pwdValid = preg_match($pwdPattern, $pwd);
    $cfmPwdValid = preg_match($pwdPattern, $cfmPwd);

    if (!$pwdValid) {
        $pwdErr = "Password must be at least 8 alphanumeric characters";
        $valid = false;
    } else {
        $pwd = $_POST["pwd"];
        $pwdErr = "";
    }

    if (!$cfmPwdValid || $cfmPwd != $pwd) {
        $cfmPwdErr = "Confirm Password is incorrect";
        $valid = false;
    } else {
        $cfmPwd = $_POST["cfmPwd"];
        $cfmPwdErr = "";
    }

}

if(!$valid){
    $_SESSION['validate'] = false;
}

// Create connection
$servername = 'rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com';
$username = '1801767TYF';
$password = '19ICT2103';
$database = '1801767tyf';
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$db_selected = mysqli_select_db($conn, $database)
or die("Could not select examples");

$validateResult = mysqli_query($conn, "SELECT account_name FROM accounts WHERE account_name = '$userId' AND account_type_id = 2");

//Validate for existing account
while ($row = mysqli_fetch_assoc($validateResult)) {
    if ($userId == $row['account_name']) {
        $userIdErr = "Username already exist";
        $valid = false;
    } else {
        $userIdErr = "";
    }
}

if($valid){
    //Free result set
    mysqli_free_result($validateResult);
    
    //Insert into database
    $result = mysqli_query($conn, "INSERT INTO accounts(account_name, account_type_id, account_password, first_name, last_name)"
                                ."VALUES('$userId', '$accountType', '$pwd', '$firstName', '$lastName')");
    
    if($result){
        $_SESSION['insertSuccess'] = true;
        mysqli_close($conn);
        header("Location:index.php");
    }
}