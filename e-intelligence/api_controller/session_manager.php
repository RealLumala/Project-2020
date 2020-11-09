<?php
    ob_start();
    session_start();
    
    if(!isset($_SESSION['username'])){        
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../sign_in.php?login=please login to continue' />"; 
    }else {
        //set user sessions
        $account_type = $_SESSION['account_type'];
        $username = $_SESSION['username'];
        
        //connect to the database
        include_once('db_connection.php');
        //get all user details and bio 
        $checkAccount = mysqli_query($conn, ("select * from user WHERE username='$username'"));
        $checkExistance = mysqli_num_rows($checkAccount);                    
        if($checkExistance > 0){ 
            //user details
            $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
            
            $user_id = $fetchDetails['user_id'];
            $first_name = $fetchDetails['first_name'];
            $last_name = $fetchDetails['last_name'];
            $username = $fetchDetails['username'];
            $email = $fetchDetails['email'];
            $number = $fetchDetails['contact'];                    
            $account_type = $fetchDetails['account_type'];
            $password = $fetchDetails['password'];
            
            //get extra account details
            if($account_type == 'registrar'){
                //get registrar detials
                $checkAccount = mysqli_query($conn, ("select * from institution_admin WHERE "
                        . "user_id='$user_id'"));
                $checkExistance = mysqli_num_rows($checkAccount);                    
                if($checkExistance > 0){ 
                    //user details
                   $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
                   $institution_id = $fetchDetails['id'];
                   $institution_name = $fetchDetails['institution_name'];
                   $logo = $fetchDetails['logo'];
                   $Updated = $fetchDetails['updated'];
                }
                
            } elseif ($account_type == 'employer') {
                //get employer detials
                $checkAccount = mysqli_query($conn, ("select * from employer WHERE "
                        . "user_id='$user_id'"));
                $checkExistance = mysqli_num_rows($checkAccount);                    
                if($checkExistance > 0){ 
                   //user details
                   $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
                   $employer_id = $fetchDetails['id'];
                   $institution_name = $fetchDetails['company_name'];
                   $logo = $fetchDetails['logo'];
                   $Updated = $fetchDetails['updated'];
                }
                
            } elseif ($account_type == 'student') {
                
                //get student detials
                $checkAccount = mysqli_query($conn, ("select * from student WHERE "
                        . "user_id='$user_id'"));
                $checkExistance = mysqli_num_rows($checkAccount);                    
                if($checkExistance > 0){ 
                   //user details
                   $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);                    
                   $institution_id = $fetchDetails['institution_id'];
                   $student_number = $fetchDetails['student_number'];
                   $account_con = $fetchDetails['account_con'];
                   $created_g = $fetchDetails['created']; 
                   $logo = $fetchDetails['profile_pic'];
                   $Updated = $fetchDetails['updated'];
                   
                   //get institution 
                   $checkAccount = mysqli_query($conn, ("select * from institution_admin WHERE "
                        . "user_id='$institution_id'"));
                    $checkExistance = mysqli_num_rows($checkAccount);                    
                    if($checkExistance > 0){ 
                       //user details
                       $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);                       
                       $institution_name = $fetchDetails['institution_name'];
                       $Updated = $fetchDetails['updated'];
                       $reg_id = $fetchDetails['user_id'];
                       
                       //get registrar name
                       $checkAccount = mysqli_query($conn, ("select * from user WHERE "
                               . "user_id='$reg_id'"));
                       $checkExistance = mysqli_num_rows($checkAccount); 
                       
                       if($checkExistance > 0){ 
                            //registrar details
                            $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
                            $reg_first_name = $fetchDetails['first_name'];
                            $reg_last_name = $fetchDetails['last_name'];
                       }
                       
                    }
                }
                
            } elseif ($account_type == 'graduate') {
                
                //get graduate detials 
                $checkAccount = mysqli_query($conn, ("select * from graduate WHERE "
                        . "user_id='$user_id'"));
                $checkExistance = mysqli_num_rows($checkAccount);                    
                if($checkExistance > 0){ 
                   //registrar details
                   $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC); 
                   $institution_id = $fetchDetails['institution_id'];
                   $student_number = $fetchDetails['student_number'];
                   $account_con = $fetchDetails['account_con'];
                   $Updated = $fetchDetails['updated'];
                   $created_g = $fetchDetails['created'];                   
                   $logo = $fetchDetails['profile_pic'];
                   
                   //get institution 
                   $checkAccount = mysqli_query($conn, ("select * from institution_admin WHERE "
                        . "user_id='$institution_id'"));
                    $checkExistance = mysqli_num_rows($checkAccount);                    
                    if($checkExistance > 0){
                       $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC); 
                       $institution_name = $fetchDetails['institution_name'];
                       $Updated = $fetchDetails['updated'];
                       $reg_id = $fetchDetails['user_id']; 
                       
                       //get registrar name
                       $checkAccount = mysqli_query($conn, ("select * from user WHERE "
                               . "user_id='$reg_id'"));
                       $checkExistance = mysqli_num_rows($checkAccount); 
                       
                       if($checkExistance > 0){ 
                            //registrar details
                            $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
                            $reg_first_name = $fetchDetails['first_name'];
                            $reg_last_name = $fetchDetails['last_name'];
                       }
                       
                    }
                }
            }            
        }
    }

