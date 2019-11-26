<?php

//require_once 'dbfunction.php';
//
//$table_account = "accounts";
//$table_course = "course";
//$table_school = "school";
//$table_faculty = "faculty";
//$table_sfc = "school_have_faculty_course";
//$table_main = "mainQuestion";
//$table_sys_col = "Syn_ColName_Dictionary";
//$table_sys_dict= "Syn_Dictionary";
//
//function getmain(){
//     return getcategoryBySql("SELECT * FROM {$GLOBALS['table_main']} ");
//    
//}
//
//function getAllusers() {
//    //return getcategoryBySql("SELECT * FROM accounts");
//    return getcategoryByNoSql("accounts");
//}
//
//function doUpdateusers($fname ="", $lname="", $accname = "", $accpwd="", $id="") {
//   global $connection;
//   $result = $connection->prepare ("UPDATE accounts SET first_name = '$fname', last_name = '$lname', account_name= '$accname', account_password = '$accpwd' WHERE account_id = $id ");
//   $result ->execute();
//}
//
//function getAllcourses() {
//    return getcategoryBySql("SELECT c.course_id, c.course_name, s.school_name, f.faculty_name, sfc.mean_salary, sfc.course_fee, sfc.year_of_study
//FROM {$GLOBALS['table_course']} c, {$GLOBALS['table_school']} s, {$GLOBALS['table_faculty']} f, school_have_faculty_course sfc WHERE c.faculty_id = f.faculty_id AND f.faculty_id = sfc.faculty_id AND c.course_id = sfc.course_id AND s.school_id = sfc.school_id;");
//}
//
//function doUpdatecourse($cname ="", $sname ="", $fname ="", $msal ="", $fee ="", $years ="", $id ="") {
//   global $connection;
//   $temp = getcategoryBySql("SELECT * FROM  Faculty WHERE faculty_name = '$fname'");
//   foreach ($temp as $seq => $val) {
//       $fid = "{$val['faculty_id']}";
//   }
//   $temp = getcategoryBySql("SELECT * FROM  School WHERE school_name = '$sname'");
//   foreach ($temp as $seq => $val) {
//       $sid = "{$val['school_id']}";
//   }
//
//   $result = $connection->prepare ("UPDATE {$GLOBALS['table_course']}  
//       SET course_name = '$cname', faculty_id = $fid WHERE course_id = $id");
//   $result ->execute();
//   
//   $result = $connection->prepare ("UPDATE {$GLOBALS['table_sfc']}  
//       SET mean_salary = $msal, course_fee = $fee, year_of_study = $year WHERE course_id = 1 ");
//   $result ->execute();
//}
//
//function getAlltracking() {
//    return getcategoryBySql("SELECT * FROM {$GLOBALS['table_tracking']}");
//}
//function getAllintent() {
//    return getcategoryBySql("SELECT * FROM {$GLOBALS['table_intent']}");
//}
//
//function getAllpattern() {
//    return getcategoryBySql("SELECT * FROM {$GLOBALS['table_pattern']}");
//}
//
//
//function getcategoryBySql($sql = "") {
//    $resultArray = array();
//    $resultSet = query($sql);
//    if($resultSet == ''){
//        
//        $resultArray = array();
//    }else{
//    
//    while ($row = fetch_array($resultSet)) {
//        $resultArray[]= $row;
//    }
//    return $resultArray;
//    }
//}
//
//function getcategoryByNoSql($Coll = "") {
//    $resultArray = array();
//    $resultSet = query1($Coll);
//    //if($resultSet == ''){      
//    //    $resultArray = array();
//    //}else{
//    
//   // while ($row = fetch_array($resultSet)) {
//   //     $resultArray[]= $row;
//   // }
//    return $resultSet;
//    //}
//}
//
//function getSat(){
//   return getcategoryBySql("SELECT Satisfaction FROM {$GLOBALS['table_user']} where role='user'");
//}
//
//function getReport(){
//   return getcategoryBySql("SELECT Report FROM {$GLOBALS['table_user']} where role='user'");
//}
?>

