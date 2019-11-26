<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/registerStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="cont">
            <div class="demo">
                <div class="register" id="sign_in">
                    <img class="register__check" src="img/logo1.png" />
                  
                    <form action="<?php include 'registerValidation.php'; ?>" method="POST" class="register__form">
                        <p style="font-size: 12px; color: white;">Already have an account? <a href="index.php">Sign In Here.</a></p>
                        
                        <div class="register__row">
                            <svg class="register__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" name="firstName" class="register__input name" placeholder="First Name"/>
                        </div>
                        <div class="register__row">
                            <svg class="register__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" name="lastName" class="register__input name" placeholder="Last Name"/>
                        </div>
                        <div class="register__row">
                            <svg class="register__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" name="userId" class="register__input name" placeholder="Username"/>
                        </div>
                        <div class="register__row">
                            <svg class="register__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            <input type="password" name="pwd" class="register__input pass" placeholder="Password"/>
                        </div>
                        <div class="register__row">
                            <svg class="register__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            <input type="password" name="cfmPwd" class="register__input pass" placeholder="Confirm Password"/>
                        </div>
                        <button class="register__submit" type="submit" name="submit1">Register</button>
                    </form>
                </div>                                     
            </div>
            
            <?php
            if (isset($_SESSION['validate'])) {
                if ($_SESSION['validate'] === false) {
                    echo '<script>$(window).on("load", function() {$("#errorModal").modal("show");});</script>';
                }
                unset($_SESSION['validate']);
            }
            ?>
            
            <!-- Registered Success Modal -->
            <div class="modal fade" id="errorModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Incorrect Fields</h4>
                        </div>
                        <div class="modal-body">
                            <p class="error"><?php echo $firstNameErr; ?></p>
                            <p class="error"><?php echo $lastNameErr; ?></p>
                            <p class="error"><?php echo $userIdErr; ?></p>
                            <p class="error"><?php echo $pwdErr; ?></p>
                            <p class="error"><?php echo $cfmPwdErr; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
              
        </div>

        <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/validation.min.js"></script>
        <script src="js/index.js"></script>
        <script>
                            
        </script>
    </body>
</html>
