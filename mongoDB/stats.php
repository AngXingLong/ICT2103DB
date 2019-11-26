<?php

require "navmenu.php";

/*
$collection = $client->$dbName->courses;

$ops = [
  [
      '$group' => [
          "_id" => '$faculty_name',
          "faculty_category" => '$faculty_category',
          "mean_salary"   => ['$max'=>1],
      ]
  ]
];
$result = $collection->aggregate($ops)->toArray();

echo json_encode($result);
*/


$collection = $client->$dbName->courses;
$unique_faculty_category = $collection->distinct('faculty_category');
$top_course_industry = array();

foreach ($unique_faculty_category as $v){
  $collection = $client->$dbName->courses;
  $querySelection = array('projection' => array('faculty_category' => 1, "course_name"=> 1, 'mean_salary' => 1, '_id'=> 0) ,'sort' => array("mean_salary" => -1) , 'limit' => 1);
  $result = $collection->find(['faculty_category' => $v], $querySelection)->toArray();
  array_push($top_course_industry, $result[0]);
}

$top_course_industry_labels = array();
$top_course_industry_values = array();

foreach ($top_course_industry as $v){
  array_push($top_course_industry_labels, array($v['faculty_category'], $v['course_name']));
  array_push($top_course_industry_values, $v['mean_salary']);
}

$querySelection = array('projection' => array('school_name' => 1, "course_name"=> 1, 'mean_salary' => 1, '_id'=> 0) ,'sort' => array("mean_salary" => -1) , 'limit' => 5);
$top_course_salary = $collection->find([],$querySelection)->toArray();

$top_course_salary_labels = array();
$top_course_salary_values = array();

foreach ($top_course_salary as $v){
  array_push($top_course_salary_labels, array($v['school_name'], $v['course_name']));
  array_push($top_course_salary_values, $v['mean_salary']);
}


$ops = [
  [
      '$group' => [
          "_id" => '$faculty_category',
          "count"   => ['$sum'=>1],
      ]
  ]
];

$total_course = $collection->aggregate($ops)->toArray();
$total_course_labels = array();
$total_course_values = array();

foreach ($total_course as $v){
  array_push($total_course_labels, $v['_id']);
  array_push($total_course_values, $v['count']);
}


/*
$stmt = $conn->prepare("SELECT fc.faculty_category, fc.course_name, fc.mean_salary FROM full_course_view fc, 
(select faculty_category, max(mean_salary) as mean_salary from full_course_view group by faculty_category) fc2 WHERE fc.faculty_category = fc2.faculty_category and 
fc.mean_salary = fc2.mean_salary group by fc.faculty_category");
*/



//$querySelection = array('projection' => array('faculty_category' => 1, "course_name"=> 1, 'mean_salary' => 1, '_id'=> 0));
/*
$top_course_industry = $collection->distinct('faculty_name');

var_dump($top_course_industry);
*/
getHeader();

?>

<h2>Top Course With Highest Mean Salary From Each Industry</h2>
<canvas id="top_course_industry" class="col-sm-6"></canvas>
<br>
<h2>Top 5 Course With Highest Mean Salary </h2>
<canvas id="top_course_salary" class="col-sm-6"></canvas>
<br>
<h2>Total Number Of Course From Each Industry</h2>
<canvas id="total_course" class="col-sm-6"></canvas>
<script>

var color = ["#FF9919", "#E85146","#CC291F","#103E54","#39ACBF","#FFC64C","#FF6737", "#FF6737", "#5779C8"];

new Chart(document.getElementById("top_course_industry"), {
    type: 'horizontalBar',
    data: {
      labels: <?php echo json_encode($top_course_industry_labels);?>,
      datasets: [
        {
          label: "Mean Salary",
          backgroundColor: color,
          data: <?php echo json_encode($top_course_industry_values);?>
        }
      ]
    },
    options: {
        scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                      
                    }
                }]                
            },
      legend: { display: false },
      title: {
        display: true,
        text: ''
      }
    }
});

new Chart(document.getElementById("top_course_salary"), {
    type: 'horizontalBar',
    data: {
      labels: <?php echo json_encode($top_course_salary_labels);?>,
      datasets: [
        {
          label: "Mean Salary",
          backgroundColor: color,
          data: <?php echo json_encode($top_course_salary_values);?>
        }
      ]
    },
    options: {
        scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                      
                    }
                }]                
            },
      legend: { display: false },
      title: {
        display: true,
        text: ''
      },
      
    }
});



new Chart(document.getElementById("total_course"), {
    type: 'pie',
    data: {
      labels: <?php echo json_encode($total_course_labels);?>,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: color,
        data: <?php echo json_encode($total_course_values);?>
      }]
    },
    options: {
      title: {
        display: true,
        text: ''
      },
      tooltips: {
    callbacks: {
      label: function(tooltipItem, data) {
        var dataset = data.datasets[tooltipItem.datasetIndex];
        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
        var total = meta.total;
        var currentValue = dataset.data[tooltipItem.index];
        var percentage = parseFloat((currentValue/total*100).toFixed(1));
        return currentValue + ' (' + percentage + '%)';
      },
      title: function(tooltipItem, data) {
        return data.labels[tooltipItem[0].index];
      }
    }
  },
    }
});
</script>
<?php 

getFooter();
?>