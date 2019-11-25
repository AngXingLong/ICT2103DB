<!DOCTYPE html>
<?php
include('retrieveFromDB/data.php');

if (isset($_GET['pid']) && isset($_GET['pname'])) {
    $a = $_GET['pid'];
    $pname = $_GET['pname'];

    doUpdateprovider($pname, $a);
    
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
    <script>

                function edit(a) {
                         window.location.replace("editProvider.php?pid=" + a);
                }
    </script>
    </head>

    <body>
        <!-- Preloader -->

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                    <div class="top-left-part"><a class="logo" href="administrator.php"><b>EDUADVICE</b></a></div>
                    <ul class="nav navbar-top-links navbar-right pull-left" style="margin-left:10px; margin-top:10px;">
                        <li>
                            <h4 style="color:white;">Loan Provider</h4>
                        </li>
                    </ul>

                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li>
                            <a href="dbfunction/logout.php"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i><b class="hidden-xs">Sign out</b> </a>

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
                                <h3 class="box-title">Loan Provider</h3>
                                <p><button class="fa fa-plus-circle btn btn-primary" id="myBtn" data-toggle="modal" data-target="#myModal"> New Provider</button></p>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body" id="message_content" style="min-height: 580px;">

                                                <article role="login">
                                                    <h3 class="text-center">Add Loan Provider</h3>
                                                    <div id="error">
                                                        <!-- error will be showen here ! -->
                                                    </div>

                                                    <form class="form-signin" method="post" id="register_form">
                                                        <!-- Text input-->
                                                                                              
                                               
                                                        <div class="form-group">
                                                           
                                                            <label class="col-md-5 control-label">provider name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="FName" id="account" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                      
                                                        <div class="form-group" style="min-height: 100px;">

                                                            <div class="col-md-7">
                                                                <input type="submit" name="signup" value="Add" id="btn-submit" class="btn btn-primary" />
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
                                
                                 <!-- Populate the table -->

                                <div class="table-responsive" id="userTable">

                                    <table id="example"  cellspacing="0" width="100%" class="table " >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Loan Provider</th>
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
                    
                                            if (in_array($val['provider_name'], $a)){
                                                    
                                                }else{
                                                    array_push($a,$val['provider_name']);
                                                    $ind +=1;
                                                echo "<script>
                                                        var user{$seq}='{$val['_id']}'; 
                                                        </script>
                                            <tr>
                                            <td>$ind</td>
                                            <td>{$val['provider_name']}</td>";
                                            $name = $val['provider_name'];
                                            $name = str_replace(' ', '_', $name);
                                            echo"
                                            <td><button class='btn btn-primary fa fa-pencil-square-o' id='{$name}' onclick='edit(id)'></button></td>
                                            <td><button class='btn btn-danger fa fa-trash-o' name='delete' value='{$val['_id']}'></button></td>
                                            <form action='courses.php' method='POST></form>
                                            </tr>";
                                            }
                                               
                                            }  

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Delete Confirmation Model -->
                                <?php
                                if (isset($_POST['delProvider'])) {
                                    echo'<script>$(window).on("load", function() {$("#cfmModal").modal("show");});</script>';
                                    echo'<div class = "modal fade" id = "cfmModal" role = "dialog">';
                                    echo'<div class = "modal-dialog">';
                                    echo'<div class = "modal-content">';
                                    echo'<div class = "modal-body" id = "message_content" style = "min-height: 100px;">';

                                    echo'<article role = "login">';
                                    echo'<h3 class = "text-center"><i class = "glyphicon glyphicon-remove-circle" style = "color:red;"></i> Delete Account</h3>';
                                    echo'<hr>';
                                    echo'<div style = "text-align: center;">';
                                    echo'<p>Are you sure you want to delete this loan?</p>';
                                    echo'<form action = "deleteFromDB/deleteLoanProvider.php" method = "POST"';
                                    echo'<div class="form-group" style="min-height: 100px;">';
                                    echo'<button type = "submit" id = "btn-submit" class = "btn btn-danger" style="margin-right:10px;" name = "cfmDelProvider" value = "' . $_POST['delProvider'] . '">Confirm</button>';
                                    echo'<button type = "button" class = "btn btn-default" data-dismiss = "modal">Cancel</button>';
                                    echo'</form>';
                                    echo'</div>';
                                    echo'</div>';
                                    echo'<br>';
                                    echo'</article>';

                                    echo'</div>';
                                    echo'</div>';
                                    echo'</div>';
                                    echo'</div>';
                                }
                                ?>
                               
                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <script src="bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>
            <script src="js/dataTables.bootstrap.min.js"></script>
            <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

            <script src="js/jquery.slimscroll.js"></script>

            <script src="js/waves.js"></script>

            <script src="js/custom.min.js"></script>
       
            <script src="js/moment.min.js"></script>

            <script src="js/logincheck.js"></script>
    </body>

</html>
