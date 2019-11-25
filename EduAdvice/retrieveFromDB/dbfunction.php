<?php

require_once 'config.php';
include 'AES.php';
function open_connection(){
    //require 'vendor/autoload.php';
     global $client;
    
    try {
         $connString = 'mongodb://' . dbUser . ':' . dbPassword . '@' . hostAddress . '/' . dbName;
       
        $client = new MongoDB\Client($connString);
      
    } catch (Exception $ex) {
        die ("Database connection failed: " .
                $e->getMessage() .
                " (" .$e->getMessage(). ")");
    }
    
}
function open_connection1(){
   
     global $connection;
    
    try {

        $connection = new PDO(DB_SERVER,DB_USER,DB_PASS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $ex) {
        die ("Database connection failed: " .
                $e->getMessage() .
                " (" .$e->getMessage(). ")");
    }
    
}

function close_connection(){
    global $connection;
    if(isset($connection)){
      $connection=null;
        
    }
    
}

function query($sql) {
   global $connection;
   $result = $connection->prepare ($sql);
   $result ->execute();
   return $result;
    
}
function query1($coll) {
   global $client;
   $dbName = "1800867CYH";
   $collection = $client->$dbName->$coll;
   $cursor = $collection->find();
   return $cursor;
    
}

function fetch_array($result_set){
   return $result_set->fetch(PDO::FETCH_ASSOC); 
    
}

open_connection();
?>