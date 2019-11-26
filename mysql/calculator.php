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

  $stmt = $conn->prepare("select course_fee, mean_salary, year_of_study, faculty_category from full_course_view fcw where fcw.school_name = ? and fcw.course_name = ?;");
  $stmt->execute(explode(", ", $poly_get));
  $polyData = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  $stmt->execute(explode(", ", $uni_get ));
  $uniData = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

  $stmt = $conn->prepare("select s.school_name,  f.faculty_name, c.course_name, shfc.mean_salary, shfc.course_fee, shfc.year_of_study from school_have_faculty_course shfc, school s, course c, faculty f where 
  shfc.school_id = s.school_id and shfc.course_id = c.course_id and shfc.faculty_id = f.faculty_id and school_type_id = 1 and faculty_category = ? order by shfc.mean_salary desc limit 10");
  $stmt->execute(array($polyData['faculty_category']));
  $recommendedCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($loan_get != ""){
    $stmt = $conn->prepare("select * from loan where loan_name = ?;");
    $stmt->execute(array($loan_get));
    $loanData = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
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

$stmt = $conn->prepare("select concat(s.school_name, ', ', c.course_name) as poly from school s, faculty f, school_have_faculty_course shfc, course c where s.school_id = shfc.school_id and f.faculty_id = shfc.faculty_id and c.course_id = shfc.course_id and s.school_type_id = 2;");
$stmt->execute();
$unfilteredPolyTag = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("select concat(s.school_name, ', ', c.course_name) as uni from school s, faculty f, school_have_faculty_course shfc, course c where s.school_id = shfc.school_id and f.faculty_id = shfc.faculty_id and c.course_id = shfc.course_id and s.school_type_id = 1;");
$stmt->execute();
$unfilteredUniTag = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("select * from loan");
$stmt->execute();
$unfilteredLoanTag = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($unfilteredPolyTag as $v){
  $filteredPolyTag[] = $v['poly'];
}

foreach ($unfilteredUniTag as $v){
  $filteredUniTag[] = $v['uni'];
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
<h2>Recommended Courses</h2>
  <?php
      if($poly_get != "" & $uni_get != ""){

        createBasicTable(array('School','Faculty','Course','Mean Salary','Course Fee','Year Of Study'),$recommendedCourses);
       

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