<?php 
    if(isset($_SESSION['username'])){        
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=views/dashboard.php' />"; 
    }
    include_once('./api_controller/db_connection.php'); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>e-intelligence</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap-grid.css">
    </head>
    <body>
        <div class="container sin-up">
            <div class="img">
                <img src="css/img/bg.svg">
            </div>
            <div class="login-content">
                <form action="api_controller/sign-upController.php" method="post" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-6">
                            <div class="input-div one">
                                <div class="i">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="div">
                                    <h5>First Name</h5>
                                    <input type="text" class="input" name="fname" id="fname">
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="i">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="div">
                                    <h5>Last Name</h5>
                                    <input type="text" class="input" name="lname" id="lname">
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="i">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="div">
                                    <h5>Username</h5>
                                    <input type="text" class="input" name="username" id="username">
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="i">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="div">
                                    <h5>Email</h5>
                                    <input type="email" class="input" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-select">
                                <div class="div">
                                    <select name="account-type" id="account">
                                        <option value="select" >Select Account Type</option>
                                        <option value="registrar">College Registrar</option>
                                        <option value="student">Student</option>
                                        <option value="graduate">Graduate</option>
                                        <option value="employer">Employer</option>
                                    </select>
                                </div>
                            </div>
                            <!-- institution -->
                            <div class="input-div one" id="inst">
                                <div class="i">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="div">
                                    <h5>Institution Name</h5>
                                    <input type="text" class="input" name="insname" id="insname">
                                </div>                                    
                            </div>
                            <div class="custom-select" id="instlogo" >
                                <div class="div">
                                    <h5>Institution Logo</h5>
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                            <!-- employer -->
                            <div class="input-div one" id="comp">
                                <div class="i">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="div">
                                    <h5>Company Name</h5>
                                    <input type="text" class="input" name="comp" id="compname">
                                </div>
                            </div>
                            <!-- student & graduate -->
                            <div class="custom-select" id="selinst">
                                <div class="div">
                                    <select name="selinsname" id="insname-id">
                                        <option>Select Institution</option>
                                        <?php 
                                            //student login of account aready exists
                                            $checkAccounts = mysqli_query($conn, ("select * from institution_admin"));
                                            $checkExistances = mysqli_num_rows($checkAccounts);
                                            if($checkExistances > 0){ 
                                                while($fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC)){ 
                                                    $inst_id = $fetchDetail_s['id'];
                                                    $inst_name = $fetchDetail_s['institution_name'];
                                                    echo '<option value="'.$inst_id.'">'.$inst_name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-div one" id="student_no">
                                <div class="i">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="div">
                                    <h5>Registration Number</h5>
                                    <input type="text" class="input" name="student_number" id="student_number">
                                </div>
                            </div>
                            <!-- end select -->
                            <div class="input-div pass">
                                <div class="i"> 
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="div">
                                    <h5>Password</h5>
                                    <input type="password" class="input" name="password" id="password">
                                </div>
                            </div>
                            <div style="text-align: left; padding-top: 5px;">
                                <div class="i2">
                                    <i class="fas fa-university"></i>&nbsp;<a href="index.php">Rankings</a>
                                </div>
                                <div class="i2">
                                    <i class="fas fa-user"></i>&nbsp;<a href="sign_in.php?login=">Sign-In</a>
                                </div>
                                <div class="i2">
                                    <i class="fas fa-lock"></i>&nbsp;<a href="#">Forgot Password?</a>
                                </div>
                            </div>
                            <input type="submit" class="btn" value="Sign-Up" name="sign-up">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="css/js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="css/js/main.js"></script>
        <script src="css/js/hide-show-fields-form.js"></script>
        <script type="text/javascript" src="css/js/loginScript.js"></script>
    </body>
</html>