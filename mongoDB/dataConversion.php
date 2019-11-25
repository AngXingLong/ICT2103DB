<?php

require "navmenu.php";

getHeader(array(),array(),false);

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

/*ACCOUNTS*/
$stmt = $conn->prepare("select account_name,account_password,description from accounts a , accounttype act where a.account_id = act.account_type_id;");
$stmt->execute();
$json = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = array_values($json);

$collection = $client->$dbName->accounts;
$collection->deleteMany([]);
$collection->insertMany($json);
/*ACCOUNTS*/

/*COURSES*/
$stmt = $conn->prepare("select shfc.year_of_study,shfc.mean_salary,f.faculty_name,f.faculty_category,s.school_name,c.course_name,shfc.course_fee from school_have_faculty_course shfc, school s, course c, faculty f where shfc.school_id = s.school_id and shfc.course_id = c.course_id and shfc.faculty_id = f.faculty_id");
$stmt->execute();
$json = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = array_values($json);

$collection = $client->$dbName->courses;
$collection->deleteMany([]);
$collection->insertMany($json);
/*COURSES*/


?>  
<html>
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <p>Data updated!</p>
        </div>
        <div class="modal-footer">
          <a href="./index.php" class="btn btn-primary">Confirm</a>
        </div>
      </div>
      	
    </div>
  </div>
  
</div>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
</html>

<style>

#background {
  padding-left:100px;
}

</style>