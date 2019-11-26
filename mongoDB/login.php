<!DOCTYPE html>
<?php
    include('retrieveFromDB/userValidation.php'); // Includes Login Script
   
    ?>
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
                    <form action="" method="post" class="login__form">
                        <div class="login__row">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" name="userid" class="login__input name" placeholder="Username"/>
                        </div>
                        <div class="login__row">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            <input type="password" name="pwd" class="login__input pass" placeholder="Password"/>
                        </div>
                        <button  class="login__submit" type="submit" name="submit1" >Sign in</button>
                     
                    </form>
                </div>
            </div>


           
        </div>

        <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/validation.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
