<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Create connection
$servername = 'rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com';
$username = '1800867CYH';
$password = '19ICT2103';
$database = '1800867CYH';
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$db_selected = mysqli_select_db($conn, $database)
or die("Could not select examples");

$result = mysqli_query($conn, "SELECT s.school_id, s.school_name, st.school_type FROM school s, schooltype st 
                                WHERE s.school_type_id = st.school_type_id;");
if(mysqli_num_rows($result) > 0){
    echo'<div class="table-responsive" id="userTable">';

    echo'<table id="example"  cellspacing="0" width="100%" class="table " >';
    echo'<thead>';
    echo'<tr>';
    echo'<th>#</th>';
    echo'<th>School Name</th>';
    echo'<th>School Type</th>';


    echo'</tr>';
    echo'</thead>';

    echo'<tbody>';

    //Output all rows into table
    while($rows = mysqli_fetch_assoc($result)){
        echo'<tr>';
        echo'<td>'.$rows["school_id"].'</td>';
        echo'<td>'.$rows["school_name"].'</td>';
        echo'<td>'.$rows["school_type"].'</td>';

        //Edit Button
        echo'<form action="school.php" method="POST">';
        echo'<td><button class="btn btn-info fa fa-pencil-square-o" name="edit" value="'.$rows["school_id"].'"></button></td>';
        echo'</form>';
        
        //Delete Button
        echo'<form action="school.php" method="POST">';
        echo'<td><button class="btn btn-danger fa fa-trash-o" name="delSchool" value="'.$rows["school_id"].'"></button></td>';
        echo'</form>';
        
        echo'</tr>';

    }

    echo'</tbody>';
    echo'</table>';
    echo'</div>';
    mysqli_close($conn);
    
}else{
    echo '0 Results';
    mysqli_close($conn);
}
