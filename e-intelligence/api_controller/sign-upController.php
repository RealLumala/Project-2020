<?php 
include_once('./db_connection.php'); 
if (isset($_POST['sign-up'])){

    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $username = filter_input(INPUT_POST, 'username');
    $account_type = filter_input(INPUT_POST, 'account-type');
    $email = filter_input(INPUT_POST, 'email'); 
    $student_number = filter_input(INPUT_POST, 'student_number');  
    
    //registrar
    if($account_type == 'registrar'){
        $insname = filter_input(INPUT_POST, 'insname');
        include_once('./upload_images.php'); 
    //student
    }elseif ($account_type == 'student') {
        $insname = filter_input(INPUT_POST, 'selinsname'); 
    //graduate
    }elseif ($account_type == 'graduate') {
        $insname = filter_input(INPUT_POST, 'selinsname'); 
    //Employer
    }elseif ($account_type == 'employer') {
        $insname = filter_input(INPUT_POST, 'comp');
        include_once('./upload_images.php'); 
    //Defualt
    } else {     
        $insname = "No Institution Yet";   
    }
    $password = filter_input(INPUT_POST, 'password');

    // DUPLICATE DATA CHECKS AGENTS
    $sql = "SELECT * FROM user WHERE username='$username'";
    $query = mysqli_query($conn, $sql);
    $u_check = mysqli_num_rows($query);

    if($u_check > 0){
       $user_details = array();
            array_push($user_details,array(
            'message'=>'This username is already taken please user a different one'
        )); 
        echo json_encode(array('result'=>$user_details));
        echo '<br/><a href="../sign_up.php"> Click Here to Try Again </a>';
    }else {
           $messageinsertSQL = "INSERT INTO user (first_name, last_name, username, email, account_type, password)
           VALUES ('$fname', '$lname', '$username', '$email', '$account_type', '$password')";
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
                        $messageinsertSQL = "INSERT INTO institution_admin (institution_name, logo, created, updated, user_id)
                        VALUES ('$insname', '$target_file', now(), now(), '$user_id')";
                        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                        if($messageinsertQuery){
                            $user_details = array();
                            array_push($user_details,array(                    
                                'message'=>'user account successfull created',
                                'fname'=>$fname,
                                'lname'=>$lname,
                                'username'=>$username,
                                'account-type'=>$account_type,
                                'instname'=>$insname,
                                'password'=>$password
                            ));                                    
                            echo json_encode(array('result'=>$user_details));
                            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../index.php' />";
                        }else {                
                            $user_details = array();
                            array_push($user_details,array(
                                'message'=>'user account not successfull created'
                            )); 
                            echo json_encode(array('result'=>$user_details));
                            echo "<br/>user account not successfull created";
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
                        $messageinsertSQL = "INSERT INTO student (institution_id, created, updated, user_id, student_number)
                        VALUES ('$insname', now(), now(), '$user_id', '$student_number')";
                        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                        if($messageinsertQuery){
                            $user_details = array();
                            array_push($user_details,array(                    
                                'message'=>'user account successfull created',
                                'fname'=>$fname,
                                'lname'=>$lname,
                                'username'=>$username,
                                'account-type'=>$account_type,
                                'instname'=>$insname,
                                'password'=>$password
                            ));                                    
                            echo json_encode(array('result'=>$user_details));
                            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../index.php' />";
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
                        $messageinsertSQL = "INSERT INTO graduate (institution_id, created, updated, user_id, student_number)
                        VALUES ('$insname', now(), now(), '$user_id', '$student_number')";
                        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                        if($messageinsertQuery){
                            $user_details = array();
                            array_push($user_details,array(                    
                                'message'=>'user account successfull created',
                                'fname'=>$fname,
                                'lname'=>$lname,
                                'username'=>$username,
                                'account-type'=>$account_type,
                                'instname'=>$insname,
                                'password'=>$password
                            ));                                    
                            echo json_encode(array('result'=>$user_details));
                            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../index.php' />";
                        }else {                
                            $user_details = array();
                            array_push($user_details,array(
                                'message'=>'user account not successfull created'
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
                        $messageinsertSQL = "INSERT INTO employer (company_name, logo, created, updated, user_id)
                        VALUES ('$insname', '$target_file', now(), now(), '$user_id')";
                        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                        if($messageinsertQuery){
                            $user_details = array();
                            array_push($user_details,array(                    
                                'message'=>'user account successfull created',
                                'fname'=>$fname,
                                'lname'=>$lname,
                                'username'=>$username,
                                'account-type'=>$account_type,
                                'instname'=>$insname,
                                'password'=>$password
                            ));                                    
                            echo json_encode(array('result'=>$user_details));
                            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../index.php' />";
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
                    'account-type'=>$account_type,
                    'instname'=>$insname,
                    'password'=>$password
                )); 
                echo json_encode(array('result'=>$user_details));
                echo "<br/>user account not successfull created";
                echo '<br/><a href="../sign_up.php"> Click Here to Try Again </a>';
            }
    }
}