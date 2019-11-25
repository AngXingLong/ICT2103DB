<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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

$result = mysqli_query($conn, "SELECT c.course_id, c.course_name, s.school_name, f.faculty_name, sfc.mean_salary, sfc.course_fee, sfc.year_of_study
FROM course c, school s, faculty f, school_have_faculty_course sfc WHERE c.faculty_id = f.faculty_id AND f.faculty_id = sfc.faculty_id AND c.course_id = sfc.course_id AND s.school_id = sfc.school_id;");

if(mysqli_num_rows($result) > 0){
    echo'<div class="table-responsive" id="userTable">';

    echo'<table id="example"  cellspacing="0" width="100%" class="table " >';
    echo'<thead>';
    echo'<tr>';
    echo'<th>#</th>';
    echo'<th>Course Name</th>';
    echo'<th>School</th>';
    echo'<th>Faculty Name</th>';
    echo'<th>Course Fee</th>';
    echo'<th>Average Salary</th>';
    echo'<th>Year Of Study</th>';

    echo'</tr>';
    echo'</thead>';

    echo'<tbody>';

    //Output all rows into table
    while($rows = mysqli_fetch_assoc($result)){
        echo'<tr>';
        echo'<td>'.$rows["course_id"].'</td>';
        echo'<td>'.$rows["course_name"].'</td>';
        echo'<td>'.$rows["school_name"].'</td>';
        echo'<td>'.$rows["faculty_name"].'</td>';
        echo'<td>'.$rows["mean_salary"].'</td>';
        echo'<td>'.$rows["course_fee"].'</td>';
        echo'<td>'.$rows["year_of_study"].'</td>';

        //Edit Button
        echo'<form action="courses.php" method="POST">';
        echo'<td><button class="btn btn-info fa fa-pencil-square-o" name="edit" value="'.$rows["course_id"].'"></button></td>';
        echo'</form>';
        
        //Delete Button
        echo'<form action="courses.php" method="POST">';
        echo'<td><button class="btn btn-danger fa fa-trash-o" name="delete" value="'.$rows["course_id"].'"></button></td>';
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
