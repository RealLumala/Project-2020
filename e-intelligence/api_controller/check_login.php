<?php
    ob_start();
    session_start();
    
    include_once('db_connection.php');
    $username = $_GET['username'];
    echo $username.'<br/>';
                
    //login of account 
    $checkAccount = mysqli_query($conn, ("select * from user WHERE username='$username'"));
    $checkExistance = mysqli_num_rows($checkAccount);
                    
    if($checkExistance > 0){       
        $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
        $username = $fetchDetails['username'];                  
        $account_type = $fetchDetails['account_type'];
        $_SESSION['username']= $username;
        $_SESSION['account_type']= $account_type;             

        $user_details = array();
            array_push($user_details,array(
            'username'=>$username,
            'message'=>'Login successfull'
        ));
        echo json_encode(array('result'=>$user_details));
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/profile.php' />";
    }else {
        //echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../sign_in.php?login=Check your username or password to continue' />";
    }

