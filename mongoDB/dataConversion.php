<?php

//https://docs.mongodb.com/php-library/v1.2/reference/method/MongoDBCollection-insertMany/
require "../mysql/database.php";
require "mongoDatabase.php";
/*LOANS*/
$stmt = $conn->prepare("select l.loan_name,l.interest_rate,lp.provider_name from loan l, loanprovider lp where l.loan_provider_id = lp.loan_provider_id");
$stmt->execute();
$json = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = array_values($json);

$collection = $client->$dbName->loan;
$collection->deleteMany([]);
$collection->insertMany($json);
/*LOANS*/

/*COURSES*/
$stmt = $conn->prepare("select account_name,account_password,description from accounts a , accounttype act where a.account_id = act.account_type_id;");
$stmt->execute();
$json = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = array_values($json);

$collection = $client->$dbName->accounts;
$collection->deleteMany([]);
$collection->insertMany($json);
/*COURSES*/

/*ACCOUNTS*/
$stmt = $conn->prepare("select shfc.year_of_study,shfc.mean_salary,f.faculty_name,s.school_name,c.course_name,shfc.course_fee from school_have_faculty_course shfc, school s, course c, faculty f where shfc.school_id = s.school_id and shfc.course_id = c.course_id and shfc.faculty_id = f.faculty_id");
$stmt->execute();
$json = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = array_values($json);

$collection = $client->$dbName->courses;
$collection->deleteMany([]);
$collection->insertMany($json);
/*ACCOUNTS*/


?>  