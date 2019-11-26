<!DOCTYPE html>
<?php
include('retrieveFromDB/data.php');

if (isset($_GET['loanid']) && isset($_GET['lname']) && isset($_GET['pname']) && isset($_GET['lrate'])) {
    $a = $_GET['loanid'];
    $lname = $_GET['lname'];
    $pname = $_GET['pname'];
    $lrate = $_GET['lrate'];
    doUpdateloan($lname, $pname, $lrate, $a);
    
}
if (isset($_GET['loname']) && isset($_GET['proname']) && isset($_GET['irate'])) {
    $loname = $_GET['loname'];
    $proname = $_GET['proname'];
    $irate = $_GET['irate'];
    doCreateloan($loname, $proname, $irate);
    
}
if (isset($_GET['remove'])) {
    $a = $_GET['remove'];
    doRemoveloan($a);
}

?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->


        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">

        <link href="css/style_1.css" rel="stylesheet">

        <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
        
        <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

        <script src="js/jquery.slimscroll.js"></script>

        <script src="js/waves.js"></script>

        <script src="js/custom.min.js"></script>
       
        <script src="js/moment.min.js"></script>

        <script src="js/logincheck.js"></script>        
    <script>

                function edit(a) {
                         window.location.replace("editLoan.php?loanid=" + a);
                }
                function deletefunc(a) {
                     var del=confirm("Are you sure you want to delete this record?\n"+a);
                        //$("#cfmModal").modal();
                     if (del==true){
                        window.location.replace("loan.php?remove="+a);
                     }
                         //window.location.replace("loan.php?remove="+a);
                }
                 function createNewloan() {
                    var loname = document.getElementById("loname").value;
                    var proname = document.getElementById("proname").value;
                    var irate = document.getElementById("irate").value;
                    window.location.replace("loan.php?loname=" + loname +"&proname="+ proname +"&irate=" + irate );
                }
                 $(document).ready(function () {
                    $("#myBtn").click(function () {
                        $("#myModal").modal();
                    });
                });
                
    </script>
    </head>

    <body>
        <!-- Preloader -->

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                    <div class="top-left-part"><a class="logo" href="dashboard.php.php"><b>EDUADVICE</b></a></div>
                    <ul class="nav navbar-top-links navbar-right pull-left" style="margin-left:10px; margin-top:10px;">
                        <li>
                            <h4 style="color:white;">LOAN</h4>
                        </li>
                    </ul>

                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li>
                            <a href="logout.php"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i><b class="hidden-xs">Sign out</b> </a>

                        </li>
                    </ul>
                </div>
                <!-- /.navbar-header -->
                <!-- /.navbar-top-links -->
                <!-- /.navbar-static-side -->
            </nav>
            <!-- Left navbar-header -->
            <?php include("navigation.php") ?>
            <!-- Left navbar-header end -->
            <div id="page-wrapper">
                <div class="container-fluid">
       <!-- /row -->
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-8 box-title">Loan</div>
                                </div>
                                <p><button class="fa fa-plus-circle btn btn-primary" id="myBtn" data-toggle="modal" data-target="#createModal"> New Loan</button></p>
     
                                <div class="modal fade" id="createModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body" id="message_content" style="min-height: 580px;">

                                                <article role="login">
                                                    <h3 class="text-center"><i class="fa fa-user"></i> New Loan</h3>
                                                    <hr>
                                                    <div id="error">
                                                        <!-- error will be shown here ! -->
                                                    </div>

                                                    <form class="form-signin" action="//" method="post" id="register_form">
                                                        <!-- Text input-->
                  

                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Loan name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="loname" id="loname" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Provider name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="proname" id="proname" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>  
                                                       <div class="form-group">    
                                                            <label class="col-md-5 control-label">Interest rate</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="irate" id="irate" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                      
                                                        <div class="form-group" style="min-height: 100px;">

                                                            <div class="col-md-7">
                                                                 <button class="btn btn-primary" id='formsub' name="create" value="Create" onclick='createNewloan()'>Add</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                    </form>


                                                    <br>
                                                </article>

                                            </div>

                                        </div>
                                    </div>
                                </div>                                                                                   
                                <hr/>       
 
                                 <!-- Populate the table -->

                                <div class="table-responsive" id="userTable">

                                    <table id="example"  cellspacing="0" width="100%" class="table " >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Loan Name</th>
                                                <th>Loan Provider</th>
                                                <th>Interest Rate</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $allcourses = getAllloans();
                                            $a=array();
                                            $ind = 0;
                                            foreach ($allcourses as $seq => $val) {
                    
                                            $ind +=1;
                                                echo "<script>
                                                        var user{$seq}='{$val['_id']}'; 
                                                        </script>
                                            <tr>
                                            <td>$ind</td>
                                            <td>{$val['loan_name']}</td>
                                            <td>{$val['provider_name']}</td>
                                            <td>{$val['interest_rate']}</td>";
                        
                                            echo"
                                            <td><button class='btn btn-primary fa fa-pencil-square-o' id='{$val['_id']}' onclick='edit(id)'></button></td>
                                            <td><button class='btn btn-danger fa fa-trash-o' id='{$val['_id']}' onclick='deletefunc(id)'></button></td>
                                    
                                            </tr>";
                                            }
                                               
                                                

                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </div>
             
                </div>
           

            </div>
        </div>
       </div>
    </body>

</html>

