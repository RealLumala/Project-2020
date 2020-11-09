<?php 
include_once('./db_connection.php');
include_once('session_manager.php');
if (isset($_POST['username'])){

    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $username = filter_input(INPUT_POST, 'username');
    $contact = filter_input(INPUT_POST, 'number');
    $email = filter_input(INPUT_POST, 'email'); 
    $student_number = filter_input(INPUT_POST, 'student_number');
    $insname = $institution_name;
    
    //registrar
    if($account_type == 'registrar'){
        $insname = filter_input(INPUT_POST, 'insname');        
    //student
    }elseif ($account_type == 'student') {
        $insname = $username; 
    //graduate
    }elseif ($account_type == 'graduate') {
        $insname = $username; 
    //Employer
    }elseif ($account_type == 'employer') {
        $insname = filter_input(INPUT_POST, 'comp');
    //Defualt
    } else {     
        $insname = "No Institution Yet";   
    }
    include_once('./upload_images.php');
    
    if($uploadOk == 1){
        $password = filter_input(INPUT_POST, 'password');
        $cpassword = filter_input(INPUT_POST, 'cpassword');
        //check if passwords much
        if($password == $cpassword){
            //Update data
               $messageinsertSQL = "UPDATE user SET first_name = '$fname', last_name= '$lname', username= '$username', email= '$email', "
                       . "contact= '$contact', password= '$password' WHERE user_id='$user_id'";
                $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){

                    //registrar
                    if($account_type == 'registrar'){
                        //CHECKS FOR USER FIRST
                        $sql = "SELECT * FROM user WHERE username='$username'";	
                        $query = mysqli_query($conn, $sql); 
                        $u_check = mysqli_num_rows($query);
                        if($u_check>0){

                            $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);	
                            $user_id = $rs['user_id'];
                            //ADD INSTITUTION
                            $messageinsertSQL = "UPDATE institution_admin set logo='$target_file', updated='now()'  WHERE user_id='$user_id'";
                            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                            if($messageinsertQuery){
                                $user_details = array();
                                array_push($user_details,array(                    
                                    'message'=>'user account successfull created',
                                    'fname'=>$fname,
                                    'lname'=>$lname,
                                    'username'=>$username,
                                    'password'=>$password
                                ));                                    
                                echo json_encode(array('result'=>$user_details));
                                echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./check_login.php?username=$username' />";
                            }else {                
                                $user_details = array();
                                array_push($user_details,array(
                                    'message'=>'user account not successfull Updated'
                                )); 
                                echo json_encode(array('result'=>$user_details));
                                echo "<br/>user account not successfull Updatedcreated";
                            }

                        }    
                    //student------------student------------student//
                    }elseif ($account_type == 'student') {
                        //CHECKS FOR USER FIRST
                        $sql = "SELECT * FROM user WHERE username='$username'";	
                        $query = mysqli_query($conn, $sql); 
                        $u_check = mysqli_num_rows($query);
                        if($u_check>0){

                            $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);	
                            $user_id = $rs['user_id'];
                            //ADD INSTITUTION
                            $messageinsertSQL = "UPDATE student set profile_pic='$target_file', updated='now()'  WHERE user_id='$user_id'";
                            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                            if($messageinsertQuery){
                                $user_details = array();
                                array_push($user_details,array(                    
                                    'message'=>'user account successfull created',
                                    'fname'=>$fname,
                                    'lname'=>$lname,
                                    'username'=>$username,
                                    'password'=>$password
                                ));                                    
                                echo json_encode(array('result'=>$user_details));
                                echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./check_login.php?username=$username' />";
                            }else {                
                                $user_details = array();
                                array_push($user_details,array(
                                    'message'=>'user account not successfull created'
                                )); 
                                echo json_encode(array('result'=>$user_details));
                                echo "<br/>user account not successfull created";
                            }

                        }

                    //graduate------------graduate------------graduate//
                    }elseif ($account_type == 'graduate') {

                        //CHECKS FOR USER FIRST
                        $sql = "SELECT * FROM user WHERE username='$username'";	
                        $query = mysqli_query($conn, $sql); 
                        $u_check = mysqli_num_rows($query);
                        if($u_check>0){

                            $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);	
                            $user_id = $rs['user_id'];
                            //ADD INSTITUTION
                            $messageinsertSQL = "UPDATE graduate set profile_pic='$target_file', updated='now()'  WHERE user_id='$user_id'";
                            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                            if($messageinsertQuery){
                                $user_details = array();
                                array_push($user_details,array(                    
                                    'message'=>'user account successfull created',
                                    'fname'=>$fname,
                                    'lname'=>$lname,
                                    'username'=>$username,
                                    'password'=>$password
                                ));                                    
                                echo json_encode(array('result'=>$user_details));
                                echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./check_login.php?username=$username' />";
                            }else {                
                                $user_details = array();
                                array_push($user_details,array(
                                    'message'=>'user account not successfull Updated'
                                )); 
                                echo json_encode(array('result'=>$user_details));
                                echo "<br/>user account not successfull created";
                            }

                        }

                    //Employer------------employer------------employer//
                    }elseif ($account_type == 'employer') {

                        //CHECKS FOR USER FIRST
                        $sql = "SELECT * FROM user WHERE username='$username'";	
                        $query = mysqli_query($conn, $sql); 
                        $u_check = mysqli_num_rows($query);
                        if($u_check>0){

                            $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);	
                            $user_id = $rs['user_id'];
                            //ADD INSTITUTION
                            $messageinsertSQL = "UPDATE employer set logo='$target_file', updated='now()'  WHERE user_id='$user_id'";
                            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                            if($messageinsertQuery){
                                $user_details = array();
                                array_push($user_details,array(                    
                                    'message'=>'user account successfull created',
                                    'fname'=>$fname,
                                    'lname'=>$lname,
                                    'username'=>$username,
                                    'password'=>$password
                                ));                                    
                                echo json_encode(array('result'=>$user_details));
                                echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./check_login.php?username=$username' />";
                            }else {                
                                $user_details = array();
                                array_push($user_details,array(
                                    'message'=>'user account not successfull created'
                                )); 
                                echo json_encode(array('result'=>$user_details));
                                echo "<br/>user account not successfull created";
                            }

                        }

                    //Defualt
                    } else {     
                        $insname = "No Institution Yet";   
                    }

                }else {

                    $user_details = array();
                    array_push($user_details,array(
                        'message'=>'user account not successfull created',
                        'fname'=>$fname,
                        'lname'=>$lname,
                        'username'=>$username,
                        'email'=>$email,
                        'password'=>$password
                    )); 
                    echo json_encode(array('result'=>$user_details));
                    echo "<br/>user account not successfull Updated";
                    echo '<br/><a href="../sign_up.php"> Click Here to Try Again </a><br/>';
                    echo("Error description: " . $conn -> error);
                }        
        } else {
            echo 'Passwords do  not much please make sure your passwords much';
        }
    } else {
        echo "File is not an image.<br/>";
        echo "<br/>user account not successfull Updated";
        echo '<br/><a href="../views/profile.php"> Click Here to Try Again </a><br/>';
        echo("Error description: " . $conn -> error);
    }
    $conn -> close();

}