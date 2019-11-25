<?php

require "navmenu.php";

getHeader(array(),array(),false);



?>

 
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" >
  <div class="carousel-inner" ;">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/photo-1459257831348-f0cdd359235f.webp" width="920" height ="800" href="calculator.php"
        alt="First slide">
      
      <div class="carousel-caption">
          <h1 class="display-4" style="color:black;margin-right:58%;">Welcome To EduStats</h1><br>
    <p style="color:black;margin-bottom:20%;padding-right:50%;text-align: left;">A Singapore based higher education statistics website that aims to help students seeking to pursuing a degree make better informed decision though evaluation of local degrees financial opportunity cost.</p>
          <h3 class="h3-responsive"><a class="btn btn-secondary btn-lg" href="calculator.php">Try our Calculator</a></h3>
      </div>
    </div>
    <div class="carousel-item">
        <img class="d-block w-100" src="img/ges.webp" width="920" height ="800"
        alt="Second slide">
      <div class="carousel-caption">
      <h3 class="h3-responsive"><a class="btn btn-secondary btn-lg" href="GES.php">Try the GES</a></h3>
      </div>
    </div>
    <div class="carousel-item">
        <img class="d-block w-100" src="img/statistics.jpg" width="920" height ="800"
        alt="Third slide">
      <div class="carousel-caption">
      <h3 class="h3-responsive"><a class="btn btn-secondary btn-lg" href="stats.php">Try calculating custom statistics</a></h3>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" style="filter: invert(100%)" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" style="filter: invert(100%)" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php 
getFooter();
?>
<style>

#background {
  padding-left:100px;
}

</style>