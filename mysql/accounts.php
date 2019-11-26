<!DOCTYPE html>
<?php
include('retrieveFromDB/data.php');

if (isset($_GET['intent']) && isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['accname']) && isset($_GET['accpwd']) ) {
    $a = $_GET['intent'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $accname = $_GET['accname'];
    $accpwd = $_GET['accpwd'];
    doUpdateusers($fname, $lname, $accname, $accpwd, $a);
    
}

?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
      
        <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
      
        <link href="css/animate.css" rel="stylesheet">
   
        <link href="css/search.css" rel="stylesheet">
        <link href="css/style_1.css" rel="stylesheet">

        <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">

    </head>
     <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script>

                function edit(a) {
                         window.location.replace("editUser.php?intent=" + a);
                }
    </script>
    <body>

        <div id="wrapper">
         
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                    <div class="top-left-part"><a class="logo" href="administrator.php"><b>EduAdvice</b></a></div>
                    <ul class="nav navbar-top-links navbar-right pull-left" style="margin-left:10px; margin-top:10px;">
                        <li>

                            <h4 style="color:white;">ACCOUNTS</h4>


                        </li>
                    </ul>

                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li>
                            <a href="login.php"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i><b class="hidden-xs">Sign out</b> </a>

                        </li>
                    </ul>
                </div>
           
            </nav>
       
            <?php include("navigation.php") ?>
           
            <div id="page-wrapper">
                <div class="container-fluid">

                    <!-- /row -->
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-md-8 box-title">Accounts</div>
                                </div>
                                <p><button class="fa fa-plus-circle btn btn-primary" id="myBtn" data-toggle="modal" data-target="#createModal"> New Accounts</button></p>
     
                                <div class="modal fade" id="createModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body" id="message_content" style="min-height: 580px;">

                                                <article role="login">
                                                    <h3 class="text-center"><i class="fa fa-user"></i> New Account</h3>
                                                    <hr>
                                                    <div id="error">
                                                        <!-- error will be shown here ! -->
                                                    </div>

                                                    <form class="form-signin" action="//" method="post" id="register_form">
                                                        <!-- Text input-->
                                                        <div class="form-group">

                                                            <label class="col-md-5 control-label">Choose account type</label>
                                                            <label class="radio-inline"><input type="radio" value="editor" name="usertype"/>Admin</label>
                                                            <label class="radio-inline"><input type="radio" value="user" name="usertype"/>User</label>
                                                            <label for="usertype" class="error" ></label>
                                                        </div>

                                                        <div class="form-group">
                                                           
                                                            <label class="col-md-5 control-label">First name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="firstName" id="account" placeholder="First name"  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Last name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="lastName" id="account" placeholder="Last name"  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>  

                                                        <br>  
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Username</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="userId" id="account" placeholder="Username"  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Password</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="pwd" id="password" placeholder="Password"  class="form-control" />
                                                                <span class="help-block" id="error"></span> 
                                                            </div>
                                                        </div>         

                                                        <br><p>   <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Confirm Password</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="cfmPwd" id="cpassword" placeholder="Confirm Password"  class="form-control"/>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                        <div class="form-group" style="min-height: 100px;">

                                                            <div class="col-md-7">
                                                                <input type="submit" name="create" value="Create" id="btn-submit" class="btn btn-primary" />
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

                                <?php include 'retrieveFromDB/retrieveAccounts.php';?>

                                <!-- Delete account -->
                                <?php
                                if(isset($_POST['delete'])){
                                    echo'<script>$(window).on("load", function() {$("#cfmModal").modal("show");});</script>';
                                    echo'<div class = "modal fade" id = "cfmModal" role = "dialog">';
                                    echo'<div class = "modal-dialog">';
                                    echo'<div class = "modal-content">';
                                    echo'<div class = "modal-body" id = "message_content" style = "min-height: 100px;">';
                                    
                                    echo'<article role = "login">';
                                    echo'<h3 class = "text-center"><i class = "glyphicon glyphicon-remove-circle" style = "color:red;"></i> Delete Account</h3>';
                                    echo'<hr>';
                                    echo'<div style = "text-align: center;">';
                                    echo'<p>Are you sure you want to delete this account?</p>';
                                    echo'<form action = "deleteFromDB/deleteAccounts.php" method = "POST"';   
                                    echo'<div class="form-group" style="min-height: 100px;">';
                                    echo'<button type = "submit" id = "btn-submit" class = "btn btn-danger" style="margin-right:10px;" name = "cfmDelete" value = "'.$_POST['delete'].'">Confirm</button>';
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
         
            <script src="bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>

            <script src="js/validation.min.js"></script>
         
            <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
         
            <script src="js/jquery.slimscroll.js"></script>
           
            <script src="js/waves.js"></script>
        
            <script src="js/custom.min.js"></script>
            <script src="js/sort.js"></script>
            <script src="js/moment.min.js"></script>
            <script>

                $("#register_form").validate({
                    rules:
                            {
                                usertype: {
                                    required: true,
                                    
                                },
                                FName: {
                                    required: true,

                                },
                                LName: {
                                    required: true,

                                },
                                account: {
                                    required: true,

                                },
                                password: {
                                    required: true,
                                    minlength: 8,
                                    maxlength: 15
                                },
                                cpassword: {
                                    required: true,
                                    equalTo: '#password'
                                },
                                user_email: {
                                    required: true,
                                    email: true
                                }
                            },
                    messages:
                            {
                                usertype: {
                                    required: "please select the account type",
                                    
                                },
                                FName: {
                                    required: "please provide a name",
                                    
                                },
                                LName: {
                                    required: "please provide a name",

                                },
                                password: {
                                    required: "please provide a password",
                                    minlength: "password at least have 8 characters"
                                },
                                user_email: "please enter a valid email address",
                                cpassword: {
                                    required: "please retype your password",
                                    equalTo: "password doesn't match !"
                                }
                            },
                    submitHandler: submitForm
                });

               
            </script>

    </body>

</html>
