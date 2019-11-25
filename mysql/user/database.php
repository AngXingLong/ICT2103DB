<?php
$servername = "rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com";
$username = "1800867CYH";
$password = "19ICT2103";
$dbname = "1800867CYH";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}

?>