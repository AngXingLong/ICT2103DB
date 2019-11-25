<?php

require_once 'dbfunction.php';

$table_account = "accounts";
$table_course = "course";
$table_school = "school";
$table_faculty = "faculty";
$table_sfc = "school_have_faculty_course";
$table_main = "mainQuestion";
$table_sys_col = "Syn_ColName_Dictionary";
$table_sys_dict= "Syn_Dictionary";

function getmain(){
     return getcategoryBySql("SELECT * FROM {$GLOBALS['table_main']} ");
    
}

function getAllusers() {
    //return getcategoryBySql("SELECT * FROM accounts");
    return getcategoryByNoSql("accounts");
}

function doUpdateusers($fname ="", $lname="", $accname = "", $accpwd="", $id="") {

   //$result = $connection->prepare ("UPDATE accounts SET first_name = '$fname', last_name = '$lname', account_name= '$accname', account_password = '$accpwd' WHERE account_id = $id ");

   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->accounts;
   $collection->updateMany(['_id' => new \MongoDB\BSON\ObjectID($id)], ['$set' => ['first_name' => $fname, 'last_name' => $lname, 'account_name' => $accname, 'account_password' => $accpwd ]]);
}

function getAllcourses() {
    return getcategoryByNoSql("courses");
}

function doUpdatecourse($cname ="", $sname ="", $fname ="", $msal ="", $fee ="", $years ="", $id ="") {
   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->courses;
   $collection->updateMany(['_id' => new \MongoDB\BSON\ObjectID($id)], 
           ['$set' => ['course_name' => $cname, 
               'school_name' => $sname, 
               'faculty_name' => $fname, 
               'mean_salary' => $msal,
               'course_fee' => $fee, 
               'year_of_study' => $years]]);

}


function doUpdateschool($sname ="", $stype ="", $id= "") {
   $tempArr = array();
   $tempArr = getcategoryByNoSql("courses");
   $name = str_replace('_', ' ', $id);
   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->courses;
   
   foreach ($tempArr as $seq => $val) {
      $id = $val['_id'];                             
      if ($val['school_name'] == $name){
           $collection->updateMany(['_id' => new \MongoDB\BSON\ObjectID($id)], 
           ['$set' => ['school_name' => $sname, 
               'school_type' => $stype]]);                       
      }                                        
   }
}

function doUpdatefaculty($fname ="", $fcat ="", $id= "") {
   $tempArr = array();
   $tempArr = getcategoryByNoSql("courses");
   $name = str_replace('_', ' ', $id);
   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->courses;
   
   foreach ($tempArr as $seq => $val) {
      $id = $val['_id'];                             
      if ($val['faculty_name'] == $name){
           $collection->updateMany(['_id' => new \MongoDB\BSON\ObjectID($id)], 
           ['$set' => ['faculty_name' => $fname, 
               'faculty_category' => $fcat]]);                       
      }                                        
   }
}

function getAllloans() {
    return getcategoryByNoSql("loan");
}

function doUpdateloan($lname ="", $pname ="", $irate ="", $id ="") {
   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->loan;
   $collection->updateMany(['_id' => new \MongoDB\BSON\ObjectID($id)], 
           ['$set' => ['loan_name' => $lname, 
               'provider_name' => $pname, 
               'interest_rate' => $irate]]);

}
function doUpdateprovider($pname ="",$id ="") {
   $tempArr = array();
   $tempArr = getcategoryByNoSql("loan");
   $name = str_replace('_', ' ', $id);
   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->loan;
   
   foreach ($tempArr as $seq => $val) {
      $id = $val['_id'];                             
      if ($val['provider_name'] == $name){
           $collection->updateMany(['_id' => new \MongoDB\BSON\ObjectID($id)], 
           ['$set' => ['provider_name' => $pname]]);                       
      }                                        
   }

}

function getAllpattern() {
    return getcategoryBySql("SELECT * FROM {$GLOBALS['table_pattern']}");
}


function getcategoryBySql($sql = "") {
    $resultArray = array();
    $resultSet = query($sql);
    if($resultSet == ''){
        
        $resultArray = array();
    }else{
    
    while ($row = fetch_array($resultSet)) {
        $resultArray[]= $row;
    }
    return $resultArray;
    }
}

function getcategoryByNoSql($Coll = "") {
    $resultArray = array();
    $resultSet = query1($Coll);
    //if($resultSet == ''){      
    //    $resultArray = array();
    //}else{
    
   // while ($row = fetch_array($resultSet)) {
   //     $resultArray[]= $row;
   // }
    return $resultSet;
    //}
}

function getSat(){
   return getcategoryBySql("SELECT Satisfaction FROM {$GLOBALS['table_user']} where role='user'");
}

function getReport(){
   return getcategoryBySql("SELECT Report FROM {$GLOBALS['table_user']} where role='user'");
}
?>

