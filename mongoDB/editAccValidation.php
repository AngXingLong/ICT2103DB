<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$newUserId = $newPwd = $newCfmPwd = $newFirstName = $newLastName = "";
$newUserIdError = $newPwdError = $newCfmPwdError = $newFirstNameError = $newLastNameError = "";
//$_SESSION['editUserIdError'] = $_SESSION['editFirstNameError'] = $_SESSION['editLastNameError'] = $_SESSION['editPwdError'] = $_SESSION['editCfmPwdError'] = "";
//Validate user input
$valid = true;
if (isset($_POST['update'])) {
    
    $newUserId = trim($_POST["newUserId"]);
    if (empty($newUserId)) {
        $newUserIdError = "Please enter an username";
        $valid = false;
    } else {
        $newUserId = trim($_POST["newUserId"]);
        $newUserIdError = "";
    }

    $newFirstName = trim($_POST["newFirstName"]);
    if (empty($newFirstName)) {
        $newFirstNameError = "Please enter first name";
        $valid = false;
    } else {
        $newFirstName = trim($_POST["newFirstName"]);
        $newFirstNameError = "";
    }

    $newLastName = trim($_POST["newLastName"]);
    if (empty($newLastName)) {
        $newLastNameError = "Please enter last name";
        $valid = false;
    } else {
        $newLastName = trim($_POST["newLastName"]);
        $newLastNameError = "";
    }

    $newPwd = $_POST["newPwd"];
    $newCfmPwd = $_POST["newCfmPwd"];
    $pwdPattern = "/^[0-9a-zA-Z]{8,}$/";
    $pwdValid = preg_match($pwdPattern, $newPwd);
    $cfmPwdValid = preg_match($pwdPattern, $newCfmPwd);

    if (!$pwdValid) {
        $newPwdError = "Password must be at least 8 alphanumeric characters";
        $valid = false;
    } else {
        $newPwd = $_POST["newPwd"];
        $newPwdError = "";
    }

    if (!$cfmPwdValid || $newCfmPwd != $editPwd) {
        $newCfmPwd = "Confirm Password is incorrect";
        $valid = false;
    } else {
        $newCfmPwd = $_POST["newCfmPwd"];
        $newCfmPwd = "";
    }
}

if($valid == false){
    $_SESSION['valid'] = false;
    header("Location:index.php");
}

if(valid){
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

    $newFullName = $newFirstName." ".$newLastName;
    
    $result = mysqli_query($conn, "UPDATE accounts". 
                            "SET account_name = '$newUserId', account_password = '$newPwd', first_name = '$newFirstName', last_name = '$newLastName', full_name = '$newFullName'");
}