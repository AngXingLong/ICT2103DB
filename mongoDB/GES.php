<?php

require "navmenu.php";



$s_search = isset($_GET['search']) ? $_GET['search'] : "";
$s_order_by = isset($_GET['order_by']) ? $_GET['order_by'] : "";

$sql_order_by_extension  = "school_name";

switch ($s_order_by) {
    case 1:
        $sql_order_by_extension  = "school_name";
        break;
    case 2:
        $sql_order_by_extension  = "faculty_name";
        break;
    case 3:
        $sql_order_by_extension  = "mean_salary";
        break;
    case 4:
        $sql_order_by_extension  = "course_fee";
        break;
    case 5:
        $sql_order_by_extension  = "year_of_study";
        break;
    case 6:
        $sql_order_by_extension  = "course_name";
        break;
    default:

}

$collection = $client->$dbName->courses;
$querySelection = array('projection' => array('school_name' => 1, "faculty_name"=> 1, 'course_name' => 1, "mean_salary" => 1, "course_fee"=> 1, "year_of_study"=> 1, '_id'=> 0) ,'sort' => array($sql_order_by_extension  => 1));

if($s_search == ""){
    $result = $collection->find([], $querySelection)->toArray();
}
else{
    $result = $collection->find(['course_name' => new \MongoDB\BSON\Regex(".*".$s_search."*.(?-i)")], $querySelection)->toArray() ;
} 

getHeader();

?>

<h1>GES Records Courses</h1>

<form class="form-inline mt-4 mb-4" action="ges.php">
<label class="mr-3">Filter: </label>
<input type="text" name="search" class="form-control col-sm-5" value = '<?php echo isset($_GET['search']) ? $_GET['search'] : "";?>'placeholder="Search">

      <select class="form-control ml-1" name="order_by">
        <option value="">Order By</option>
        <option value=1>School Name</option>
        <option value=2>Faculty Name</option>
        <option value=3>Mean Salary</option>
        <option value=4>Course Fee</option>
        <option value=5>Year Of Study</option>
        <option value=6>Course Name</option>
      </select>

<button type="submit" class="btn btn-primary float-sm-right ml-2">Submit</button>
</form>


<?php
createBasicTable(array('School','Faculty','Course','Mean Salary','Course Fee','Year Of Study'), array("school_name", "faculty_name", "course_name", "mean_salary", "course_fee", "year_of_study"), $result);
getFooter();
?>