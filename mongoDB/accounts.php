<!DOCTYPE html>
include('retrieveFromDB/data.php');

if (isset($_GET['intent']) && isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['accname']) && isset($_GET['accpwd']) ) {
    $a = $_GET['intent'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $accname = $_GET['accname'];
    $accpwd = $_GET['accpwd'];
    doUpdateusers($fname, $lname, $accname, $accpwd, $a);
    
}

if (isset($_GET['l']) && isset($_GET['f']) && isset($_GET['u']) && isset($_GET['t']) && isset($_GET['p']) ) {
    $l = $_GET['l'];
    $f = $_GET['f'];
    $u = $_GET['u'];
    $t = $_GET['t'];
    $p = $_GET['p'];
    doCreateusers($l, $f, $u, $t, $p);
    
}
if (isset($_GET['remove'])) {
    $a = $_GET['remove'];
    doRemoveusers($a);
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

                function edit(a) {
                         window.location.replace("editUser.php?intent="+a);
                }
                function deletefunc(a) {
                     var del=confirm("Are you sure you want to delete this record?\n"+a);
                        //$("#cfmModal").modal();
                     if (del==true){
                        window.location.replace("accounts.php?remove="+a);
                     }
                         
                }
                function createNewacc() {
                    var t = "";
                    if (document.getElementById('r1').checked) {
                       
                        t = document.getElementById('r1').value;
                        }
                    if (document.getElementById('r2').checked) {
                       
                        t = document.getElementById('r2').value;
                        }
                     var l = document.getElementById("LName").value;
                    var f = document.getElementById("FName").value;
                    var u = document.getElementById("userId").value;
                    var p = document.getElementById("pwd").value;
       
                    window.location.replace("accounts.php?l=" + l +"&f=" + f + "&u=" + u + "&t=" + t + "&p=" + p);
                }
                 $(document).ready(function () {
                    $("#myBtn").click(function () {
                        $("#myModal").modal();
                    });
                });

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
                            <a href="logout.php"><i class="fa fa-power-off fa-fw" aria-hidden="true"></i><b class="hidden-xs">Sign out</b> </a>

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
                                                            <label class="radio-inline"><input type="radio" id = "r1" value="admin" name="usertype"/>Admin</label>
                                                            <label class="radio-inline"><input type="radio" id = "r2" value="user" name="usertype2"/>User</label>
                                                            <label for="usertype" class="error" ></label>
                                                        </div>

                                                        <div class="form-group">
                                                           
                                                            <label class="col-md-5 control-label">First name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="FName" id="FName" placeholder="First name"  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Last name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="LName" id="LName" placeholder="Last name"  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>  

                                                        <br>  
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Username</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="userId" id="userId" placeholder="Username"  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Password</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="pwd" id="pwd" placeholder="Password"  class="form-control" />
                                                                <span class="help-block" id="error"></span> 
                                                            </div>
                                                        </div>         

                                                        <br><p>   <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Confirm Password</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="cfmPwd" id="cfmPwd" placeholder="Confirm Password"  class="form-control"/>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                        <div class="form-group" style="min-height: 100px;">

                                                            <div class="col-md-7">
                                                                <button class="btn btn-primary" id='formsub' name="create" value="Create" onclick='createNewacc()'>Create</button>
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
                                                $ind = $seq +1;
                                                echo "<script>
                                          var user{$seq}='{$val['_id']}'; 
                                      </script>
                                        <tr>
                                            <td>$ind</td>
                                            <td>{$val['first_name']}</td>
                                            <td>{$val['last_name']}</td>
                                            <td>{$val['first_name']} {$val['last_name']}</td>
                                            <td>{$val['account_name']}</td>
                                            <td>{$val['account_password']}</td>
                                            <td>{$val['account_type']}</td>
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
        
    </body>

</html>
