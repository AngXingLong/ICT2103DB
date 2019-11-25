<?php

 require 'vendor/autoload.php';

 $hostAddress = 'dds-gs55000587b16cd41891-pub.mongodb.singapore.rds.aliyuncs.com:3717';
 $dbUser= '1800867CYH';
 $dbPassword = '19ICT2103';
 $dbName = '1800867CYH';
 $connString = 'mongodb://' . $dbUser . ':' . $dbPassword . '@' . $hostAddress . '/' . $dbName;
 $client = new MongoDB\Client($connString);

?>  