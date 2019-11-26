<?php

require "navmenu.php";



$s_search = isset($_GET['search']) ? $_GET['search'] : "";
$s_order_by = isset($_GET['order_by']) ? $_GET['order_by'] : "";

$sql_order_by_extension  = "provider_name";

switch ($s_order_by) {
  case 1:
      $sql_order_by_extension  = "provider_name";
      break;
  case 2:
      $sql_order_by_extension  = "loan_name";
      break;
  case 3:
      $sql_order_by_extension  = "interest_rate";
      break;
  default:
}

$collection = $client->$dbName->loan;
$querySelection = array('projection' => array('loan_name' => 1, "provider_name"=> 1, 'interest_rate' => 1, '_id'=> 0) ,'sort' => array($sql_order_by_extension  => 1));


if($s_search == ""){
    $result = $collection->find([],$querySelection)->toArray();
}
else{
    $result = $collection->find(['loan_name' => new \MongoDB\BSON\Regex(".*".$s_search."*.(?-i)")], $querySelection)->toArray() ;
} 

getHeader();

?>

<h1>Loans</h1>

<form class="form-inline mt-4 mb-4" action="loan.php">
<label class="mr-3">Filter: </label>
<input type="text" name="search" class="form-control col-sm-5" value = '<?php echo isset($_GET['search']) ? $_GET['search'] : "";?>'placeholder="Search">
      <select class="form-control ml-1" name="order_by">
        <option value="">Order By</option>
        <option value=1>Provider</option>
        <option value=2>Loan</option>
        <option value=3>Interest Rate</option>
      </select>

<button type="submit" class="btn btn-primary float-sm-right ml-2">Submit</button>

</form>

<?php 


createBasicTable(array('Provider','Loan','Interest Rate'), array('provider_name','loan_name','interest_rate'),$result);
getFooter();
?>