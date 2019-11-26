<?php

require "data.php";
session_start();

$error = ''; // Variable To Store Error Message
if (isset($_POST['submit1'])) {

    if (empty($_POST['userid']) || empty($_POST['pwd'])) {
        echo "<script type='text/javascript'>alert('Login Unsuccessful, Please try again');</script>";
        $error = "Username or Password is invalid";
    } else {
        sleep(2);
        $username = $_POST['userid'];
        $password = $_POST['pwd'];
        global $client;
        $dbName = "1800867CYH";
        $collection = $client->$dbName->accounts;
        $filter = array('account_name' => $username, 'account_password'=> $password );
        $rows = $collection->count($filter);
        $status = $collection->find($filter);

        if ($rows == 1) {
            foreach ($status as $seq => $val) {
           
                $_SESSION["user_type"] = $val['account_type'];
                $_SESSION["user_name"] = $val['account_name'];

                if ($val['account_type'] == 'admin'){
                    header("Location: dashboard.php?username=$username");
                }
                else if($val['account_type'] == 'user'){
                    //here need to link to user protal
                    header("Location: index.php");
                }
            }
        } else {
            echo "<script type='text/javascript'>alert('Login Unsuccessful, Please try again');</script>";
        }
    }
}
?>