<?php

require "navmenu.php";

getHeader();


$s_search = isset($_GET['search']) ? $_GET['search'] : "";
$s_search = "%".$s_search."%";

$s_order_by = isset($_GET['order_by']) ? $_GET['order_by'] : "";

//s.school_name, f.faculty_name , c.course_name, shfc.mean_salary, shfc.course_fee, shfc.year_of_study

$sql_order_by_extension = "";

switch ($s_order_by) {
    case 1:
        $sql_order_by_extension  = "order by school_name desc";
        break;
    case 2:
        $sql_order_by_extension  = "order by faculty_name desc";
        break;
    case 3:
        $sql_order_by_extension  = "order by mean_salary desc";
        print "a";
        break;
    case 4:
        $sql_order_by_extension  = "order by course_fee desc";
        break;
    case 5:
        $sql_order_by_extension  = "order by year_of_study desc";
        break;
    case 6:
        $sql_order_by_extension  = "order by course_name desc";
        break;
    default:

}



$stmt = $conn->prepare("select school_name, faculty_name , course_name, mean_salary, course_fee, year_of_study from full_course_view where LOWER(course_name) like LOWER(?) $sql_order_by_extension;");
$stmt->execute(array($s_search));
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
createBasicTable(array('School','Faculty','Course','Mean Salary','Course Fee','Year Of Study'),$arr);
getFooter();
?>