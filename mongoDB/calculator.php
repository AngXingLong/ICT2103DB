<?php

require "navmenu.php";

getHeader();

$poly_get = isset($_GET['polyTag']) ? $_GET['polyTag'] : "";
$uni_get = isset($_GET['uniTag']) ? $_GET['uniTag'] : "";
$loan_get = isset($_GET['loanTag']) ? $_GET['loanTag'] : "";

$yearsCoverLoan = 0;
$yearsCoverOpportuntityCost = 0;
$polyYearlySalary = 0;
$uniYearlySalary = 0;
$interest_rate  = 0;
$polyEarning = array();
$degreeCost = array();
$accumulatedInterest = array();
$uniEarning = array();
$opportunityCost = array();
$years = array();
  
if($poly_get != "" & $uni_get != ""){


  $poly_get_split = explode(", ", $poly_get);


  $collection = $client->$dbName->courses;
  $querySelection = array('projection' => array('course_fee' => 1, "year_of_study"=> 1, "mean_salary"=> 1, 'faculty_category' => 1, '_id'=> 0));
  $polyData = $collection->find(['school_name' => $poly_get_split[0], 'course_name' => $poly_get_split[1]], $querySelection)->toArray();
  $polyData = $polyData[0];

  $uni_get_split = explode(", ", $uni_get);
  $uniData = $collection->find(['school_name' => $uni_get_split[0], 'course_name' => $uni_get_split[1]], $querySelection)->toArray();
  $uniData = $uniData[0];
  

  $querySelection = array('projection' => array('school_name' => 1, "faculty_name"=> 1, 'course_name' => 1, 'mean_salary' => 1, 'course_fee' => 1, 'year_of_study' => 1, '_id'=> 0));
  $recommendedCourses = $collection->find(['school_name' => $uni_get_split[0], 'course_name' => $uni_get_split[1]], $querySelection)->toArray() ;

  if($loan_get != ""){
    $collection = $client->$dbName->loan;
    $querySelection = array('projection' => array('loan_name' => 1, "interest_rate"=> 1, 'provider_name' => 1, '_id'=> 0));
    $loanData = $collection->find(['loan_name' => $loan_get], $querySelection)->toArray();

    $loanData = $loanData[0];
  }else{
    $loanData['interest_rate'] = 0;
  }

  $polyYearlySalary = $polyData['mean_salary'] * 12;
  $uniYearlySalary =  $uniData['mean_salary'] * 12;
  $interest_rate = $loanData['interest_rate'];

  for ($x = 0; $x < 30; $x++) { 

    if ($x < $uniData['year_of_study']) {
      $uniEarning[] = 0;
      $accumulatedInterest[] = 0;

      if ($x == 0){
        $polyEarning[] = 0;
      }else{
        $polyEarning[] = end($polyEarning) + $polyYearlySalary;
      }

      $yearsCoverLoan++;
    }
    else{
      if (end($uniEarning) > end($opportunityCost)){
        break;
      }

      if (end($uniEarning) < $uniData['course_fee']){
        $accumulatedInterest[] = end($accumulatedInterest) + (($uniData['course_fee'] - end($uniEarning)) / 100) * $loanData['interest_rate'];
        $yearsCoverLoan++;
        
      }else{
        $accumulatedInterest[] =  end($accumulatedInterest);
      }
  
      $polyEarning[] = end($polyEarning) + $polyYearlySalary;
      $uniEarning[] = end($uniEarning) + $uniYearlySalary;
    }
    $opportunityCost[] = $uniData['course_fee'] + end($polyEarning) + end($accumulatedInterest);
    $degreeCost[] = $uniData['course_fee'];
  }

  for ($x = 0; $x < count($polyEarning); $x++) {
    if ($x == 0){
      $years[] = date("Y");
    }else{
      $years[] = end($years) + 1;
    }
  }
  $yearsCoverOpportuntityCost = end($years) - $years[0];

  $number_of_years_opportuntity = end($years) - $years[0];
  $number_of_years_loan = end($years) - $years[0];


  $poly_mean_salary = $polyData['mean_salary'];
  $uni_mean_salary = $uniData['mean_salary'];
  $uni_cost = $uniData['course_fee'];
  //Interest From Loan

}
  

$collection = $client->$dbName->courses;
$querySelection = array('projection' => array('school_name' => 1, "course_name"=> 1, '_id'=> 0));
$unfilteredPolyTag = $collection->find(["school_type"=> "Polytechnic"], $querySelection)->toArray();


$collection = $client->$dbName->courses;
$querySelection = array('projection' => array('school_name' => 1, "course_name"=> 1, '_id'=> 0));
$unfilteredUniTag = $collection->find(["school_type"=> "University"], $querySelection)->toArray();

$collection = $client->$dbName->loan;
$querySelection = array('projection' => array('loan_name' => 1, '_id'=> 0));
$unfilteredLoanTag = $collection->find([], $querySelection)->toArray();

foreach ($unfilteredPolyTag as $v){
  $filteredPolyTag[] = $v['school_name'].", ".$v['course_name'];
}

foreach ($unfilteredUniTag as $v){
  $filteredUniTag[] = $v['school_name'].", ".$v['course_name'];
}

foreach ($unfilteredLoanTag as $v){
  $filteredLoanTag[] = $v['loan_name'];
}


function getDataListValues($array){
    foreach ($array as $v){
      echo "<option value='$v'>";
    }
}

?>
<h1>Opportunity Cost Calculator</h1>

<form>

<div class='form-group'>
<label>Current Diploma: </label>
<input id="polyTag" name="polyTag" class="form-control col-sm-6" value = '<?php echo $poly_get; ?>' placeholder="Current Education Level, Diploma">
</div>

<div class='form-group'>
<label>Seeking Bachelor's Degree: </label>
<input id="uniTag" name="uniTag" class="form-control col-sm-6" value = '<?php echo $uni_get; ?>' placeholder="Desired Education Level, Bachelor Degree">
</div>

<div class='form-group'>
<label>Loan: </label>
<input id="loanTag" name="loanTag" class="form-control col-sm-6" value = '<?php echo $loan_get; ?>' placeholder="Desired Loan">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<canvas id="total_cost_chart" class="col-sm-6 d-inline"></canvas>
<canvas id="total_cost_compare_chart" class="col-sm-6 d-inline"></canvas>


<ul class="list-group col-lg-12  col-xl-5">
  <li class="list-group-item"><h2>Opportunity Cost Stats</h2></li>
  <li class="list-group-item">Yearly Poly Mean Salary: <span class='float-right'><?php echo  "$ ".number_format($polyYearlySalary, 2); ?></span></li>
  <li class="list-group-item">Yearly Uni Mean Salary: <span class='float-right'><?php echo  "$ ".number_format($uniYearlySalary, 2); ?></span></li>
  <li class="list-group-item">Yearly Salary Difference: <span class='float-right'><?php echo  "$ ".number_format($uniYearlySalary - $polyYearlySalary, 2); ?></span></li>
  <li class="list-group-item">Interest Rate: <span class='float-right'><?php echo  $interest_rate."%"; ?></span></li>
  <li class="list-group-item">Interest Accumulated (floating): <span class='float-right'><?php echo  "$ ".number_format(end($accumulatedInterest), 2);?></span></li>
  <li class="list-group-item">Time To Cover Poly Opportuntity Cost: <span class='float-right'><?php echo $yearsCoverOpportuntityCost . " Years"; ?></span></li>
  <li class="list-group-item">Time To Cover Degree Expenses: <span class='float-right'><?php echo $yearsCoverLoan . " Years"; ; ?></span></li>
</ul>
<br>
<br>
<h2>Recommanded Courses</h2>
  <?php
      if($poly_get != "" & $uni_get != ""){

        createBasicTable(array('School','Faculty','Course','Mean Salary','Course Fee','Year Of Study'),array('school_name', "faculty_name", 'course_name', 'mean_salary', 'course_fee', 'year_of_study'),$recommendedCourses);
      
      }
  ?>
  



<script>
  $( function() {
    var polyTag = <?php echo json_encode($filteredPolyTag) ?>;
    var uniTag = <?php echo json_encode($filteredUniTag) ?>;
    var loanTag = <?php echo json_encode($filteredLoanTag) ?>;
    $("#polyTag" ).autocomplete({source: polyTag});
    $("#uniTag" ).autocomplete({source: uniTag});
    $("#loanTag" ).autocomplete({source: loanTag});
    
  } );

  function float2dollar(value){
    return "$ "+(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
  }

  new Chart(document.getElementById("total_cost_chart"), {
  type: 'line',
  data: {
    labels: <?php echo json_encode($years) ?>,
    datasets: [{ 
        data: <?php echo json_encode($degreeCost) ?>,
        label: "Degree Cost",
        borderColor: "#2a4d69",
        backgroundColor: "#2a4d69",
        fill: true
      },
      { 
        data: <?php echo json_encode($accumulatedInterest) ?>,
        label: "Accumulated Interest",
        borderColor: "#4b86b4",
        backgroundColor: "#4b86b4",
        fill: true
      }, 
      { 
        data: <?php echo json_encode($polyEarning) ?>,
        label: "Accumulated Poly Salary",
        borderColor: "#adcbe3",
        backgroundColor: "#adcbe3",
        fill: true
      }, 
    ]
  },
  options: {
    scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return float2dollar(value);
                        }
                    },
                    stacked: true
                }]                
            },
    title: {
      display: true,
      text: 'Total Opportunity Cost'
    },
  }
});


new Chart(document.getElementById("total_cost_compare_chart"), {
  type: 'line',
  data: {
    labels: <?php echo json_encode($years) ?>,
    datasets: [{ 
        data: <?php echo json_encode($uniEarning) ?>,
        label: "Accumulated Degree Salary ",
        borderColor: "#2a4d69",
        backgroundColor: "#2a4d69",
        fill: false
      },
      { 
        data: <?php echo json_encode($opportunityCost) ?>,
        label: "Total Opportunity Cost",
        borderColor: "#4b86b4",
        backgroundColor: "#4b86b4",
        fill: false
      }, 
    ]
  },
  options: {
    scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return float2dollar(value);
                        }
                    }
                }]                
            },
    title: {
      display: true,
      text: 'Financial Opportunity Comparison'
    },
  }
});

  </script>


<?php 

getFooter();
?>