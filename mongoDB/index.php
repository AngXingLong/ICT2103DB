<?php

require "navmenu.php";

getHeader(array(),array(),false);

?>

<div class="jumbotron jumbotron-fluid">
    <div id='background'>
    <h1 class="display-4">Welcome To EduAdvice</h1><br>
    <p>A singapore based higher education statistics website that aims to help students seeking <br>to pursuing a degree make better informed decision though evaluation of local degrees<br> financial opportunity cost</p>
    <a class="btn btn-primary btn-lg" href="calculator.php" role="button">Try Our Calculator</a>
    </div>
</div>


<?php 
getFooter();
?>
<style>

#background {
  padding-left:100px;
}

</style>