<?php

require "navmenu.php";

getHeader();

$s_search = isset($_GET['search']) ? $_GET['search'] : "";
$s_search = "%".$s_search."%";
$s_order_by = isset($_GET['order_by']) ? $_GET['order_by'] : "";

$sql_order_by_extension = "";

switch ($s_order_by) {
    case 1:
        $sql_order_by_extension  = "order by provider_name desc";
        break;
    case 2:
        $sql_order_by_extension  = "order by loan_name desc";
        break;
    case 3:
        $sql_order_by_extension  = "order by interest_rate desc";
        break;
    default:

}

$stmt = $conn->prepare("select lp.provider_name, l.loan_name, concat(l.interest_rate, '%') from loan l, loanprovider lp where l.loan_provider_id = lp.loan_provider_id and LOWER(l.loan_name) like LOWER(?) $sql_order_by_extension;");
$stmt->execute(array($s_search));
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
createBasicTable(array('Provider','Loan','Interest Rate'),$arr);
getFooter();
?>