<?php

require "navmenu.php";


$stmt = $conn->prepare("SELECT fc.faculty_category, fc.course_name, fc.mean_salary FROM full_course_view fc, 
(select faculty_category, max(mean_salary) as mean_salary from full_course_view group by faculty_category) fc2 WHERE fc.faculty_category = fc2.faculty_category and 
fc.mean_salary = fc2.mean_salary group by fc.faculty_category");
$stmt->execute();
$top_course_industry = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT school_name, course_name, mean_salary FROM full_course_view order by mean_salary desc limit 5");
$stmt->execute();
$top_course_salary = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT faculty_category, count(*) as count FROM full_course_view group by faculty_category;");
$stmt->execute();
$total_course = $stmt->fetchAll(PDO::FETCH_ASSOC);
getHeader();

function extractAsArray($sqlArray, $count, $count2 = -1){
    $output = [];

    foreach ($sqlArray as $v){
        $value = array_values($v);
        if( $count2 == -1 ){
            $output[] = $value[$count];
        }else{
            $output[] = array($value[$count],$value[$count2]);
        }
    }
    return $output;
}


?>

<h2>Top Course With Highest Mean Salary From Each Industry</h2>
<canvas id="top_course_industry" class="col-sm-6"></canvas>
<br>
<h2>Top 5 Course With Highest Mean Salary </h2>
<canvas id="top_course_salary" class="col-sm-6"></canvas>
<br>
<h2>Total Of Course From Each Industry</h2>
<canvas id="total_course" class="col-sm-6"></canvas>

<script>
new Chart(document.getElementById("top_course_industry"), {
    type: 'horizontalBar',
    data: {
      labels: <?php echo json_encode(extractAsArray($top_course_industry,0,1));?>,
      datasets: [
        {
          label: "Mean Salary",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: <?php echo json_encode(extractAsArray($top_course_industry,2));?>
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
      labels: <?php echo json_encode(extractAsArray($top_course_salary,0,1));?>,
      datasets: [
        {
          label: "Mean Salary",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: <?php echo json_encode(extractAsArray($top_course_salary,2));?>
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
      labels: <?php echo json_encode(extractAsArray($total_course,0));?>,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        data: <?php echo json_encode(extractAsArray($total_course,1));?>
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