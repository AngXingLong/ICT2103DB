<?php
// Start the session
session_start();
?>
<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/indexStyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="cont">
            <div class="demo">
                <div class="login" id="sign_in">
                    <img class="login__check" src="img/logo1.png" />
                    <form action="loginValidation.php" method="post" class="login__form">
                        <div class="login__row">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" name="userId" class="login__input name" placeholder="Username"/>
                        </div>
                        <div class="login__row">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            <input type="password" name="pwd" class="login__input pass" placeholder="Password"/>
                        </div>
                        <p class="error" style="font-size: 12px; color:red; text-align: left;">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </p>
                        <button  class="login__submit" type="submit" name="submit1" class="">Sign in</button>
                        <p style="font-size: 12px; color: white;">Don't have an account? <a href="register.php">Register Here.</a></p>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_SESSION['insertSuccess'])) {
                if ($_SESSION['insertSuccess'] === true) {
                    echo '<script>$(window).on("load", function() {$("#successModal").modal("show");});</script>';
                }
                unset($_SESSION['insertSuccess']);
            }
            ?>
            
            <!-- Registered Success Modal -->
            <div class="modal fade" id="successModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Account Registered</h4>
                        </div>
                        <div class="modal-body">
                            <p>Thank you for registering with us!</p>
                            <p>You may login now.</p>
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
    </body>
</html>
