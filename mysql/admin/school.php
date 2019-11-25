<?php
// Start the session
session_start();
?>


<!DOCTYPE html>

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

    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                    <div class="top-left-part"><a class="logo" href="administrator.php"><b>EDUADVICE</b></a></div>
                    <ul class="nav navbar-top-links navbar-right pull-left" style="margin-left:10px; margin-top:10px;">
                        <li>
                            <h4 style="color:white;">SCHOOL</h4>
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
                                <h3 class="box-title">School</h3>
                                <p><button class="fa fa-plus-circle btn btn-primary" id="myBtn" data-toggle="modal" data-target="#myModal"> New School</button></p>
                                
                                
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body" id="message_content" style="min-height: 400px;">

                                                <article role="login">
                                                    <h3 class="text-center">Add School</h3>
                                                    <div id="error">
                                                        <!-- error will be shown here ! -->
                                                    </div>

                                                    <form class="form-signin" action="<?php include "schoolValidation.php"; ?>" method="post" id="register_form">
                                                        
                                                        <!-- Radio Button -->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">School Type</label>
                                                            <label class="radio-inline"><input type="radio" value="University" name="schoolType"/>University</label>
                                                            <label class="radio-inline"><input type="radio" value="Polytechnic" name="schoolType"/>Polytechnic</label>
                                                            <br>
                                                            <span for="schoolType" class="error" style="color: red;"><?php echo $radioBtnErr ?></span>

                                                        </div> 
                                                        
                                                        <!-- Text input-->
                                                        <div class="form-group">                                                         
                                                            <label class="col-md-5 control-label">School Name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="schoolName" id="account" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error" style="color: red;"><?php echo $schoolNameErr; ?></span>
                                                            </div>
                                                        </div>
                                                        
                                                        <br>
                                                      
                                                        <div class="form-group" style="min-height: 100px;">

                                                            <div class="col-md-7">
                                                                <input type="submit" name="create" value="Add" id="btn-submit" class="btn btn-primary" />
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
                                <!-- Create modal remain opens if there is error -->
                                <?php
                                if (isset($_SESSION['validation'])) {
                                    if ($_SESSION['validation'] === false) {
                                        echo'<script>$(window).on("load", function() {$("#myModal").modal("show");});</script>';
                                        
                                    }
                                    unset($_SESSION['validation']);
                                }
                                
                                ?>
                                
                                <!-- Populate the table -->
                                <?php include "retrieveFromDB/retrieveSchool.php"; ?>

                                <!-- Delete Confirmation Model -->
                                <?php
                                if (isset($_POST['delSchool'])) {
                                    echo'<script>$(window).on("load", function() {$("#cfmModal").modal("show");});</script>';
                                    echo'<div class = "modal fade" id = "cfmModal" role = "dialog">';
                                    echo'<div class = "modal-dialog">';
                                    echo'<div class = "modal-content">';
                                    echo'<div class = "modal-body" id = "message_content" style = "min-height: 100px;">';

                                    echo'<article role = "login">';
                                    echo'<h3 class = "text-center"><i class = "glyphicon glyphicon-remove-circle" style = "color:red;"></i> Delete Account</h3>';
                                    echo'<hr>';
                                    echo'<div style = "text-align: center;">';
                                    echo'<p>Are you sure you want to delete this school?</p>';
                                    echo'<form action = "deleteFromDB/deleteSchool.php" method = "POST"';
                                    echo'<div class="form-group" style="min-height: 100px;">';
                                    echo'<button type = "submit" id = "btn-submit" class = "btn btn-danger" style="margin-right:10px;" name = "cfmDelSchool" value = "' . $_POST['delSchool'] . '">Confirm</button>';
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
            <script>
                                                    $(document).ready(function () {
                                                    $('#example').DataTable(
                                                    {

                                                    }
                                                    );
                                                    });
                                                    var ip = '<?php
            $IP = $_SERVER['REMOTE_ADDR'];
            echo $IP;
            ?>';
                                                    var id = '<?php echo $_SESSION['login_user']; ?>';
                                                    var sessionid = '<?php echo $_SESSION['sid'] ?>';
                                                    var time = moment().format('YYYY-MM-DD hh:mm:ss');
            </script>
            <script src="js/logincheck.js"></script>
    </body>

</html>
