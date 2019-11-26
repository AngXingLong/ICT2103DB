<!DOCTYPE html>

<?php
include('retrieveFromDB/data.php');



?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- Animation CSS -->
        <link href="css/animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style_1.css" rel="stylesheet">

        <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
        <link rel="stylesheet" href="plugins/amcharts/plugins/export/export.css" type="text/css" media="all" />
 <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>

            <script src="bootstrap/dist/js/bootstrap.min.js"></script>

            <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

            <script src="js/jquery.slimscroll.js"></script>

            <script src="js/waves.js"></script>

            <script src="js/custom.min.js"></script>

            <script src="plugins/amcharts/amcharts.js"></script>
            <script src="plugins/amcharts/serial.js"></script>
            <script src="plugins/amcharts/plugins/export/export.min.js"></script>

            <script src="plugins/amcharts/themes/light.js"></script>

            <script src="js/login.js"></script>
            <script src="js/moment.min.js"></script>
            <script>
             
                var time = moment().format('YYYY-MM-DD hh:mm:ss');



                var chart = AmCharts.makeChart("chartdiv", {
                    "type": "serial",
                    "theme": "light",
                    "marginRight": 40,
                    "marginLeft": 40,
                    "autoMarginOffset": 20,
                    "mouseWheelZoomEnabled": true,
                    "dataDateFormat": "YYYY-MM-DD",
                    "valueAxes": [{
                            "id": "v1",
                            "axisAlpha": 0,
                            "position": "left",
                            "ignoreAxisWidth": true
                        }],
                    "balloon": {
                        "borderThickness": 1,
                        "shadowAlpha": 0
                    },
                    "graphs": [{
                            "id": "g1",
                            "balloon": {
                                "drop": true,
                                "adjustBorderColor": false,
                                "color": "#ffffff"
                            },
                            "bullet": "round",
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "bulletSize": 5,
                            "hideBulletsCount": 50,
                            "lineThickness": 2,
                            "title": "red line",
                            "useLineColorForBulletBorder": true,
                            "valueField": "value",
                            "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                        }],
                    "chartScrollbar": {
                        "graph": "g1",
                        "oppositeAxis": false,
                        "offset": 30,
                        "scrollbarHeight": 80,
                        "backgroundAlpha": 0,
                        "selectedBackgroundAlpha": 0.1,
                        "selectedBackgroundColor": "#888888",
                        "graphFillAlpha": 0,
                        "graphLineAlpha": 0.5,
                        "selectedGraphFillAlpha": 0,
                        "selectedGraphLineAlpha": 1,
                        "autoGridCount": true,
                        "color": "#AAAAAA"
                    },
                    "chartCursor": {
                        "pan": true,
                        "valueLineEnabled": true,
                        "valueLineBalloonEnabled": true,
                        "cursorAlpha": 1,
                        "cursorColor": "#258cbb",
                        "limitToGraph": "g1",
                        "valueLineAlpha": 0.2,
                        "valueZoomable": true
                    },
                    "valueScrollbar": {
                        "oppositeAxis": false,
                        "offset": 50,
                        "scrollbarHeight": 10
                    },
                    "categoryField": "date",
                    "categoryAxis": {
                        "parseDates": true,
                        "dashLength": 1,
                        "minorGridEnabled": true
                    },
                    "export": {
                        "enabled": true
                    },
                    "dataProvider": [
<?php
$tracking_data = getAllstats();
foreach ($tracking_data as $seq => $data) {
    echo "{
                                       'date': '{$data['date']}',
                                       'value': {$data['active_times']}
                                   },";
}
?>]
                });

                chart.addListener("rendered", zoomChart);

                zoomChart();

                function zoomChart() {
                    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
                }
            </script>
                <script src="js/logincheck.js"></script>
                    <style>
        #chartdiv {
            width	: 100%;
            height	: 500px;
        }

    </style>
    </head>

    <body>
        <!-- Preloader -->

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                    <div class="top-left-part"><a class="logo" href="dashboard.php"><b>EduAdvice</b></a></div>

                    <ul class="nav navbar-top-links navbar-right pull-left" style="margin-left:10px; margin-top:10px;">
                        <li>
                            <h4 style="color:white;">Dashboard</h4>
                        </li>
                    </ul>

                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li>
                            <a href="logout.php"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i><b class="hidden-xs">Sign out</b> </a>

                        </li>
                    </ul>
                </div>
            
            </nav>
       
            <?php include("navigation.php") ?>
        </div>
            <div id="page-wrapper">
                <div class="container-fluid">

                    <div class="row" style="margin-top:15px;">
                        <!--col -->
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic"></i>
                                        <h5 class="text-muted vb">Active user</h5> </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-danger"><?php $a = countAlluser();echo $a; ?></h3> </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php $a = countAlluser(); $b = countAllacc();echo (int)(($a / $b) * 100+.5) . "%"; ?>"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                        <h5 class="text-muted vb">Poly Course</h5> </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-megna"><?php $a = countPolycourse();echo $a ?></h3> </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php $a = countPolycourse(); $b = countUnicourse();echo (int)(($a / ($a+$b)) * 100+.5) . "%"; ?>">  </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <div class="col-in row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                        <h5 class="text-muted vb">Uni Course</h5> </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h3 class="counter text-right m-t-15 text-megna"><?php $a = countUnicourse();echo $a ?></h3> </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php $a = countPolycourse(); $b = countUnicourse();echo (int)(($b / ($a+$b)) * 100+.5) . "%"; ?> ">  </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>


                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                            <div class="white-box">
                                <div class="col-md-8 box-title">User Activate times</div>
                                <div id="chartdiv"></div>

                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>

            </div>

           
</body>

</html>
