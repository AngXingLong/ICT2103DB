<?php

 //$m = new MongoClient("mongodb://1800867CYH:19ICT2103@dds-gs55000587b16cd41891-pub.mongodb.singapore.rds.aliyuncs.com/1800867CYH");

 require 'vendor/autoload.php';

 //$client = new MongoDB\Client("mongodb://1800867CYH:19ICT2103@dds-gs55000587b16cd41891-pub.mongodb.singapore.rds.aliyuncs.com:3717");
 //$dbs =  $client->listDatabases();

 //$conn = new MongoDB\Driver\Manager("mongodb://1800867CYH:19ICT2103@dds-gs55000587b16cd41891-pub.mongodb.singapore.rds.aliyuncs.com:3717");


 //require 'vendor/autoload.php'; // include Composer goodies
 # Instance information
 
 $hostAddress = 'dds-gs55000587b16cd41891-pub.mongodb.singapore.rds.aliyuncs.com:3717';
 $dbUser= '1800867CYH';
 $dbPassword = '19ICT2103';
 $dbName = '1800867CYH';
 $connString = 'mongodb://' . $dbUser . ':' . $dbPassword . '@' . $hostAddress . '/' . $dbName;
 $client = new MongoDB\Client($connString);
 
 $collection = $client->$dbName->loan;
 $result = $collection->insertOne( [ 'name' => 'ApsaraDB for Mongodb', 'desc' => 'Hello, Mongodb'  ] );
 echo "Inserted with Object ID '{$result->getInsertedId()}'", "\n";
 $result = $collection->find( [ 'name' => 'ApsaraDB for Mongodb'] );
 foreach ($result as $entry)
 {
   echo $entry->_id, ': ', $entry->name, "\n";
 }

?>  