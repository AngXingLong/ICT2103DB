<!DOCTYPE html>
<?php
include('retrieveFromDB/data.php');

if (isset($_GET['courseid']) && isset($_GET['cname']) && isset($_GET['sname']) && isset($_GET['fname']) && isset($_GET['msal'])&& isset($_GET['fee'])&& isset($_GET['years']) ) {
    $a = $_GET['courseid'];
    $cname = $_GET['cname'];
    $sname = $_GET['sname'];
    $fname = $_GET['fname'];
    $msal = $_GET['msal'];
    $fee = $_GET['fee'];
    $years = $_GET['years'];
    doUpdatecourse($cname, $sname, $fname, $msal, $fee, $years, $a);
    
}

if (isset($_GET['courseType']) && isset($_GET['YofStudy']) && isset($_GET['CName']) && isset($_GET['FName']) && isset($_GET['FCat'])&& isset($_GET['SName'])&& isset($_GET['MSal']) && isset($_GET['CFee'])) {
    $courseType = $_GET['courseType'];
    $YofStudy = $_GET['YofStudy'];
    $CName= $_GET['CName'];
    $FName= $_GET['FName'];
    $FCat = $_GET['FCat'];
    $SName = $_GET['SName'];
    $MSal = $_GET['MSal'];
    $CFee = $_GET['CFee'];
    doCreatecourse($courseType, $YofStudy, $CName, $FName, $FCat,$SName, $MSal,$CFee);
    
}
if (isset($_GET['remove'])) {
    $a = $_GET['remove'];
    doRemovecourse($a);
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
                         window.location.replace("editCourse.php?courseid=" + a);
                }
                function deletefunc(a) {
                     var del=confirm("Are you sure you want to delete this record?\n"+a);
                        //$("#cfmModal").modal();
                     if (del==true){
                        window.location.replace("courses.php?remove="+a);
                     }                         
                }
                function createNewcourse() {
                    var courseType = "";
                    if (document.getElementById('r1').checked) {
                       
                        courseType = document.getElementById('r1').value;
                        }
                    if (document.getElementById('r2').checked) {
                       
                        courseType = document.getElementById('r2').value;
                        }
                        
                    var CName = document.getElementById("CName").value;
                    var FName = document.getElementById("FName").value;
                    var FCat = document.getElementById("FCat").value;
                    var SName = document.getElementById("SName").value;
                    var MSal = document.getElementById("MSal").value;
                    var CFee = document.getElementById("CFee").value;
                    var YofStudy = "";
                    if (document.getElementById('y1').checked) {
                       
                        YofStudy = document.getElementById('y1').value;
                        }
                    if (document.getElementById('y2').checked) {
                       
                        YofStudy = document.getElementById('y2').value;
                        }
                    if (document.getElementById('y3').checked) {
                       
                        YofStudy = document.getElementById('y3').value;
                        }
                     window.location.replace("courses.php?courseType=" + courseType +"&YofStudy=" + YofStudy + "&CName=" + CName + "&FName=" + FName + "&FCat=" + FCat + "&SName=" + SName + "&MSal=" + MSal + "&CFee=" + CFee);
                    //window.location.replace("courses.php?courseType=" + courseType);
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
                    <div class="top-left-part"><a class="logo" href="administrator.php"><b>EDUADVICE</b></a></div>
                    <ul class="nav navbar-top-links navbar-right pull-left" style="margin-left:10px; margin-top:10px;">
                        <li>
                            <h4 style="color:white;">COURSES</h4>
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
                                    <div class="col-md-8 box-title">Course</div>
                                </div>
                           <p><button class="fa fa-plus-circle btn btn-primary" id="myBtn" data-toggle="modal" data-target="#createModal">Add Course</button></p>
     
                                <div class="modal fade" id="createModal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body" id="message_content" style="min-height: 580px;">

                                                <article role="login">
                                                    <h3 class="text-center"><i class="fa fa-user"></i> New Course</h3>
                                                    <hr>
                                                    <div id="error">
                                                        <!-- error will be shown here ! -->
                                                    </div>

                                                    <form class="form-signin" action="//" method="post" id="register_form">
                                                        <!-- Text input-->
                                                        <div class="form-group">

                                                            <label class="col-md-5 control-label">Choose course type</label>
                                                            <label class="radio-inline"><input type="radio" id = "r1" value="University" name="usertype"/>University</label>
                                                            <label class="radio-inline"><input type="radio" id = "r2" value="Polytechnic" name="usertype2"/>Polytechnic</label>
                                                            <label for="usertype" class="error" ></label>
                                                        </div>
                                                         <div class="form-group">
                                                           
                                                            <label class="col-md-5 control-label">Course name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="CName" id="CName" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div> 
                                                        <br>
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Faculty</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="FName" id="FName" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Faculty Category</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="FCat" id="FCat" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>  

                                                        <br>  
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">School Name</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="SName" id="SName" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>    
                                                        <br>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">main salary</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="MSal" id="MSal" placeholder=""  class="form-control" />
                                                                <span class="help-block" id="error"></span> 
                                                            </div>
                                                        </div>         

                                                        <br>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Course Fee</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="CFee" id="CFee" placeholder=""  class="form-control"/>
                                                                <span class="help-block" id="error"></span>
                                                            </div>
                                                        </div>   
                                                        <br>
                                                         <div class="form-group">

                                                            <label class="col-md-5 control-label">Choose account type</label>
                                                            <label class="radio-inline"><input type="radio" id = "y1" value="2" name="usertype"/>2</label>
                                                            <label class="radio-inline"><input type="radio" id = "y2" value="3" name="usertype2"/>3</label>
                                                            <label class="radio-inline"><input type="radio" id = "y3" value="4" name="usertype2"/>4</label>
                                                            <label for="usertype" class="error" ></label>
                                                        </div>
                                                        <br>
                                                        <div class="form-group" style="min-height: 100px;">

                                                            <div class="col-md-7">
                                                                <button class="btn btn-primary" id='formsub' name="create" value="Create" onclick='createNewcourse()'>Add</button>
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
                                                <th>Course Name</th>
                                                <th>School</th>
                                                <th>Faculty Name</th>
                                                <th>Course Fee</th>
                                                <th>Average Salary</th>
                                                <th>Year Of Study</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $allcourses = getAllcourses();
                                            foreach ($allcourses as $seq => $val) {
                                                $ind = $seq +1;
                                                echo "<script>
                                          var user{$seq}='{$val['_id']}'; 
                                      </script>
                                        <tr>
                                            <td>$ind</td>
                                            <td>{$val['course_name']}</td>
                                            <td>{$val['school_name']}</td>
                                            <td>{$val['faculty_name']}</td>
                                            <td>{$val['mean_salary']}</td>
                                            <td>{$val['course_fee']}</td>
                                            <td>{$val['year_of_study']}</td>
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
