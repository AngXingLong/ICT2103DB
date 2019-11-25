<!DOCTYPE html>
<?php
include('retrieveFromDB/data.php');

if (isset($_GET['intent'])) {
    $a = $_GET['intent'];
}
?>
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
                function save(a){

                var fname = document.getElementById("fname").value;
                var lname = document.getElementById("lname").value;
                var accname = document.getElementById("accname").value;
                var accpwd = document.getElementById("accpwd").value;
                window.location.replace("accounts.php?intent=" + a +"&fname=" + fname + "&lname=" + lname + "&accname=" + accname + "&accpwd=" + accpwd);
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
                            <a href="index.php"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i><b class="hidden-xs">Sign out</b> </a>

                        </li>
                    </ul>
                </div>
           
            </nav>

            <?php include("navigation.php") ?>

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

                                <div class="table-responsive" id="userTable">

                                    <table id="example"  cellspacing="0" width="100%" class="table " >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Account Type</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            $alluser = getAllusers();
                                            foreach ($alluser as $seq => $val) {
                                                if ($val['account_id'] == $a){
                                                     echo "<script>
                                          var user{$seq}='{$val['account_id']}'; 
                                      </script>
                                        <tr>
                                            <td>$seq</td>
                                                
                                            <td><input type='text' name='intent' id='fname' value={$val['first_name']}  class='form-control' required/></td>
                                            <td><input type='text' name='intent' id='lname' value={$val['last_name']}  class='form-control' required/></td>
                                            <td><input type='text' name='intent'  value='{$val['first_name']} {$val['last_name']}'  class='form-control' readonly/></td>
                                            <td><input type='text' name='intent' id='accname' value={$val['account_name']} class='form-control' required/></td>
                                            <td><input type='text' name='intent'id='accpwd'  value={$val['account_password']}  class='form-control' required/></td>    
                                            <td><input type='text' name='intent'  value={$val['account_type_id']}  class='form-control' readonly/></td>  
                                            <td><button class='btn btn-primary glyphicon glyphicon-book' id='{$val['account_id']}' onclick='save(id)'></button></td>
                                            <td><button class='btn btn-danger fa fa-trash-o' name='delete' value='{$val['account_id']}'></button></td>
                                                </tr>";
                                                }else{
                                                echo "<script>
                                          var user{$seq}='{$val['account_id']}'; 
                                      </script>
                                        <tr>
                                            <td>$seq</td>
                                                
                                            <td>{$val['first_name']}</td>
                                            <td>{$val['last_name']}</td>
                                            <td>{$val['first_name']} {$val['last_name']}</td>
                                            <td>{$val['account_name']}</td>
                                            <td>{$val['account_password']}</td>
                                            <td>{$val['account_type_id']}</td>
                                            <td><button class='btn btn-primary fa fa-pencil-square-o' id='{$val['account_id']}' onclick='edit(id)'></button></td>
                                            <td><button class='btn btn-danger fa fa-trash-o' name='delete' value='{$val['account_id']}'></button></td>
                                            <form action='accounts.php' method='POST></form>
                                                </tr>";
                                            }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>

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
