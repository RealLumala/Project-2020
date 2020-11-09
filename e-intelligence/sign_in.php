<?php 
    if(isset($_SESSION['username'])){        
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=views/dashboard.php' />"; 
    } else {
       $login = '';        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>e-intelligence</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
        <img class="wave" src="css/img/wave.png">
        <div class="container">
            <div class="img">
                <img src="css/img/bg.svg">
            </div>
            <div class="login-content">
                <form action="api_controller/loginController.php" method="post">
                    <img src="css/img/avatar.svg">
                    <h2 class="title">Welcome</h2>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Username</h5>
                            <input type="text" class="input" name="username" id="username" required>
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i"> 
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input type="password" class="input" name="password" id="password" required="">
                        </div>
                    </div>
                    <div style="text-align: left; padding-top: 5px;">
                        <div class="i2">
                            <i class="fas fa-university"></i>&nbsp;<a href="index.php">Rankings</a>
                        </div>
                        <div class="i2">
                            <i class="fas fa-user"></i>&nbsp;<a href="sign_up.php">Sign-Up</a>
                        </div>
                        <div class="i2">
                            <i class="fas fa-lock"></i>&nbsp;<a href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <div style="text-align: left; padding-top: 5px;">
                        <div class="i2">
                            <?php 
                                if($_GET["login"] != null){
                                $login = $_GET["login"];
                                echo $login; 
                                }
                            ?>
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Login">                    
                </form>
            </div>
        </div>
        <script type="text/javascript" src="css/js/main.js"></script>
    </body>
</html>