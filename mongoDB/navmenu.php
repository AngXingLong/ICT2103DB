<?php
require "mongoDatabase.php";

function getHeader($js = array(), $css = array(), $padding = true){
  echo '<!DOCTYPE html>';
  echo '<html lang="en">';
  echo '<head>';
  echo '<title>Home</title>';
  echo '<meta charset="utf-8">';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1">';


  $css[] = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css";
  $css[] = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css";
  $css[] = "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css";
  $js[] = "https://code.jquery.com/jquery-3.4.1.js";
  $js[] = "https://code.jquery.com/ui/1.12.1/jquery-ui.js";
  $js[] = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js";
  $js[] = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js";
  $js[] = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js";


  foreach ($css as $v) {
    echo "<link rel='stylesheet' href='$v'>";
  }
  foreach ($js as $v) {
    echo "<script src='$v'></script>";
  }

      echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">';
      echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">';
      echo '<span class="navbar-toggler-icon"></span>';
      echo '</button>';
      echo '<a class="navbar-brand" href="index.php">EduStats</a>';
      echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo03">';
      echo '<ul class="navbar-nav mr-auto mt-2 mt-lg-0">';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="GES.php">GES</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="loan.php">Loans</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="calculator.php">Calculator</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="stats.php">Stats</a>';
      echo '</li>';
      echo '</ul>';
      echo '<form class="form-inline my-2 my-lg-0" action="dataConversion.php">';
      echo '<button class="btn btn-info my-2 my-sm-0" type="submit">Refresh Data</button>';
      echo '</form>';
      echo '<form class="form-inline my-2 my-lg-0" action="login.php">';
      echo '<button class="btn btn-info my-2 my-sm-0" type="submit">Login</button>';
      echo '</form>';
      echo '</div>';
      echo ' </nav>';
      echo '<body>';
      if($padding ){
        echo '<div class="m-4">';
      }else{
        echo '<div>';
      }
      
}

function getFooter(){
  echo '</div>';
  echo '</body>';
  echo '</html>';
}
function createBasicTable($tableHeaders, $tableHeadersPosition, $tableRows){

  echo '<table class="table">';
  echo '<thead>';
  echo '<tr>';
  
  foreach($tableHeaders as $v){
      echo "<th>$v</th>";
  }

  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  foreach ($tableRows as $v) {
      echo '<tr>';
      foreach($tableHeadersPosition as $v2){
          echo "<td>".$v[$v2]."</td>";
      }
      echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
}


?>