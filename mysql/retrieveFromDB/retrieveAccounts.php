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

$db_selected = mysqli_select_db($conn, $database)
or die("Could not select examples");

$result = mysqli_query($conn, "SELECT * FROM accounts");
if(mysqli_num_rows($result) > 0){
    echo'<div class="table-responsive" id="userTable">';

    echo'<table id="example"  cellspacing="0" width="100%" class="table " >';
    echo'<thead>';
    echo'<tr>';
    echo'<th>#</th>';
    echo'<th>First Name</th>';
    echo'<th>Last Name</th>';
    echo'<th>Username</th>';
    echo'<th>Password</th>';
    echo'<th>Account Type</th>';


    echo'</tr>';
    echo'</thead>';

    echo'<tbody>';

    //Output all rows into table
    while($rows = mysqli_fetch_assoc($result)){
        echo'<tr>';
        echo'<td>'.$rows["account_id"].'</td>';
        echo'<td>'.$rows["first_name"].'</td>';
        echo'<td>'.$rows["last_name"].'</td>';
        echo'<td>'.$rows["account_name"].'</td>';
        echo'<td>'.$rows["account_password"].'</td>';

        if($rows["account_type"] == '1'){
            echo "<td>Admin</td>";
        }else{
            echo "<td>User</td>";
        }

        //Edit Button
        echo'<form action="editUser.php" method="POST">';

        echo'<td> <button class="btn btn-info fa fa-pencil-square-o" id='.$rows["account_id"].' onclick="edit(id)" name="edit" ></button></td>';
        echo'</form>';
        
        //Delete Button
        echo'<form action="accounts.php" method="POST">';
        echo'<td><button class="btn btn-danger fa fa-trash-o" name="delete" value="'.$rows["account_id"].'"></button></td>';
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


