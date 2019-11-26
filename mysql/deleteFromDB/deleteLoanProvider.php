<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['cfmDelProvider'])){
    
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
    
    $result = mysqli_query($conn, "DELETE FROM loan_provider WHERE loan_provider_id = $_POST[cfmDelProvider]");

    if ($result === true) {
        mysqli_close($conn);
        header("Location:../loanProvider.php");
    } else {
        mysqli_close($conn);
        header("Location:../loanProvider.php");
    }

    
}
