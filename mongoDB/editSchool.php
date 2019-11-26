<!DOCTYPE html>
<?php
include('retrieveFromDB/data.php');

if (isset($_GET['courseid'])) {
    $id = $_GET['courseid'];
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
    <script>

                function save(a){
                var sname = document.getElementById("sname").value;
                var stype = document.getElementById("stype").value;

                window.location.replace("school.php?courseid=" + a +"&sname=" + sname + "&stype=" + stype);
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
                            <h4 style="color:white;">COURSES</h4>
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

                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body" id="message_content" style="min-height: 580px;">

                                                <article role="login">
                                                    <h3 class="text-center">Add course</h3>
                                                    <div id="error">
                                                        <!-- error will be showen here ! -->
                                                    </div>

                                                    <form class="form-signin" method="post" id="register_form">
                                                       
                                                
                                                   <div class="form-group">
                                                    
                                                       <label class="col-md-5 control-label">Choose course type</label>
                                                            <label class="radio-inline"><input type="radio" value="editor" name="usertype"/>University</label>
                                                            <label class="radio-inline"><input type="radio" value="user" name="usertype"/>Polytechnic</label>
                                                            <label for="usertype" class="error" ></label>
                                                         
                                                   </div>
                                               
                                                        <div class="form-group">
                                                           
                                                            <label class="col-md-5 control-label">Course name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="FName" id="account" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Faculty</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="LName" id="account" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>  

                                                        <br>  
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">School</label>
                                                            <div class="col-md-7">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Choose a shool name
                                                                       </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                      <button class="dropdown-item" type="button">SP</button>
                          
                                                                    </div>
                                                                  </div>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>  <br>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">main salary</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="password" id="password" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span> 
                                                            </div>
                                                        </div>         

                                                        <br>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Course Fee</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="cpassword" id="cpassword" placeholder=""  class="form-control"/>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Years of study</label>
                                                            <div class="col-md-7">
                                                                <input type="password" name="cpassword" id="cpassword" placeholder=""  class="form-control"/>
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
                                 <!-- Populate the table -->

                                <div class="table-responsive" id="userTable">

                                    <table id="example"  cellspacing="0" width="100%" class="table " >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>School Name</th>
                                                <th>School Type</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                              <?php
                                            $allcourses = getAllcourses();
                                            $a=array();
                                            $ind = 0;
                                            foreach ($allcourses as $seq => $val) {
                                                if (in_array($val['school_name'], $a)){
                                                    
                                                }else{
                                                    array_push($a,$val['school_name']);
                                                    $ind +=1;
                                                    $name = str_replace('_', ' ', $id);
                                                    if ($val['school_name'] == $name){
                                                        echo "<script>
                                                        var user{$seq}='{$val['_id']}'; 
                                                        </script>
                                             <tr>
                                            <td>$ind</td>
                                                
                                            <td><input type='text' name='intent' id='sname' value='{$val['school_name']}'  class='form-control' required/></td>
                                            <td><input type='text' name='intent' id='stype' value='{$val['school_type']}'  class='form-control' required/></td>
                                           
                                            <td><button class='btn btn-primary glyphicon glyphicon-book' id = {$id} onclick='save(id)'></button></td>
                                            <td><button class='btn btn-danger fa fa-trash-o' name='delete' value='{$val['_id']}'></button></td>
                                                </tr>";
                                                }else{
                                                 echo "<script>
                                          var user{$seq}='{$val['_id']}'; 
                                      </script>
                                        <tr>
                                            <td>$ind</td>
                                            <td>{$val['school_name']}</td>
                                            <td>{$val['school_type']}</td>
                                            <td><button class='btn btn-primary fa fa-pencil-square-o' id='{$val['_id']}' onclick='edit(id)'></button></td>
                                            <td><button class='btn btn-danger fa fa-trash-o' name='delete' value='{$val['_id']}'></button></td>
                             
                                                </tr>";
                                            }
                                            }
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
    </body>

</html>
