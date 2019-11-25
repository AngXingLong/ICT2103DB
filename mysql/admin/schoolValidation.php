<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$insertError = $radioBtn = $schoolTypeId = $schoolName = "";
$radioBtnErr = $schoolNameErr = "";
$_SESSION['validation'] = true;
$valid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $radioBtn = isset($_POST["schoolType"]);
    if(empty($radioBtn)){
        $radioBtnErr = "Please select the school type";
        $valid = false;
        $_SESSION['validation'] = false;
    }else {
        $radioBtnErr = "";
        $radioBtn = $_POST["schoolType"];
        if($radioBtn == "University"){
            $schoolTypeId = 1;
        }else{
            $schoolTypeId = 2;
        }
        $valid = true;
    }
    
    $schoolName = trim($_POST["schoolName"]);
    if (empty($schoolName)) {
        $schoolNameErr = "Please enter a school name";
        $valid = false;
        $_SESSION['validation'] = false;
    } else {
        $schoolName = trim($_POST["schoolName"]);
        $schoolNameErr = "";
        $valid = true;
    }
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

$validateResult = mysqli_query($conn, "SELECT school_name FROM school WHERE school_name = '$schoolName'");

//Validate for existing account
while ($row = mysqli_fetch_assoc($validateResult)) {
    if ($schoolName == $row['school_name']) {
        $schoolNameErr = "School already exist";
        $valid = false;
    } else {
        $schoolNameErr = "";
        $valid = true;
    }
}

if($valid){
    //Free result set
    mysqli_free_result($validateResult);
    
    //Insert into database
    $result = mysqli_query($conn, "INSERT INTO school(school_type_id, school_name)"
                                ."VALUES('$schoolTypeId', '$schoolName')");
    
    if($result){
        $_SESSION['validation'] = "";
        mysqli_close($conn);
    }else{
        $_SESSION['validation'] = "";
        mysqli_close($conn);
    }
}