<?php 
include_once('./db_connection.php');
include_once('session_manager.php');

if (isset($_POST['employ'])){
    
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $student_id = filter_input(INPUT_POST, 'user_id');
    $scout_ins_user = filter_input(INPUT_POST, 'scout_ins_user');
    $scout_ins_user_id = filter_input(INPUT_POST, 'scout_ins_user_id');
    $scout_logo_grad_id = filter_input(INPUT_POST, 'scout_logo_grad_id');
    $scouted = 2; 
    $status = 1;
    $account_con = 1; 
        
    //check if student already employied by this employer and refera acordingly  
    $check_student = mysqli_query($conn, ("select * from employment_list WHERE "
            . "student_number='$scout_logo_grad_id' and employer_id = '$user_id' "));
    $checkExist = mysqli_num_rows($check_student);    
    if($checkExist > 0){ 
        $row_x = mysqli_fetch_array($check_student);
        $employement_id = $row_x['employment_id'];
        //check if student already employied by this employer and refera acordingly  
        $check_students = mysqli_query($conn, ("select * from employement WHERE employement_id='$employement_id' and employer_id = '$user_id'"));
        $checkExists = mysqli_num_rows($check_students);    
        if($checkExists > 0){ 
            $row = mysqli_fetch_array($check_students);
            $account_con = $row['account_con'];
            if($account_con  == 1){
                
                $user_details = array();
                array_push($user_details,array(
                'message'=>'Skill was already employed by you. Employment ID: '.$employement_id
                )); 
                echo json_encode(array('result'=>$user_details)); 
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=Skill "
                . "was already employed by you. Employment ID: $employement_id' />";
                
            } else {
                
                $messageinsertSQL = "UPDATE skill SET scouted = '$scouted', employer_id= '$user_id' "
                . "WHERE skill_id='$skill_id'";
                $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);

                if($messageinsertQuery){

                    $sql="UPDATE employement set stetus = 1, account_con = 1 where employement_id='$employement_id'";
                    $result = mysqli_query($conn, $sql);

                    if (! empty($result)) {
                       echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=' />";
                       //echo 'success';
                    } else {
                      echo("Error description: " . $conn -> error);  
                    } 

                }else {

                   $user_details = array();
                   array_push($user_details,array(
                        'message'=>'Skill Not Employed successfully'
                    )); 
                    echo json_encode(array('result'=>$user_details));
                }
            
            } 
            
        }
    
    }
    
    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from employment_list WHERE employer_id='$user_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 
        
        $emp_id = $checkExistance+1;
        //Asign Employment id 
        if($employement_id == ""){
            $employement_id = "E0".$emp_id;   
        } 
        
        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted', employer_id= '$user_id' "
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            
            $sql="INSERT INTO employement(employement_id, stetus, graduate_id, employer_id,"
                    . "institution_id, account_con)"
                    . "VALUES('$employement_id', '$status', '$student_id', '$user_id', '$scout_ins_user', '$account_con')";
            $result = mysqli_query($conn, $sql);
            
            if (! empty($result)) {
                //check if student already employied by this employer and refera acordingly  
                $check_student = mysqli_query($conn, ("select * from employment_list WHERE employment_id='$employement_id' and employer_id = '$user_id'"));
                $checkExist = mysqli_num_rows($check_student);    
                if($checkExist > 0){
                   echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=' />";
                   //echo 'success';
                } else {
                    $sql="INSERT INTO employment_list(employement_id, student_number, institution_id, employer_id)"
                        . "VALUES('$employement_id', '$scout_logo_grad_id', '$scout_ins_user_id', '$user_id')";
                    $result = mysqli_query($conn, $sql);
                   echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=' />";
                   //echo 'success';                    
                }
            } else {
              echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=Skill "
                . "was already employed by you. Employment ID: $employement_id' />";
            } 
            
        }else {

           $user_details = array();
           array_push($user_details,array(
                'message'=>'Skill Not Employed successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
        }        
                                                               
    } else {
        
        //Asign Employment id 
        $employement_id = "E001";
        $sql="INSERT INTO employment_list(employement_id, student_number, institution_id, employer_id)"
        . "VALUES('$employement_id', '$scout_logo_grad_id', '$scout_ins_user_id', '$user_id')";
        $result = mysqli_query($conn, $sql);
        if (! empty($result)) {
            
            //Update data
            $messageinsertSQL = "UPDATE skill SET scouted = '$scouted', employer_id= '$user_id' "
                    . "WHERE skill_id='$skill_id'";
            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);

            if($messageinsertQuery){

                $sql="INSERT INTO employement(employement_id, stetus, graduate_id, employer_id,"
                        . "institution_id, account_con)"
                        . "VALUES('$employement_id', '$status', '$student_id', '$user_id', '$scout_ins_user', '$account_con')";
                $result = mysqli_query($conn, $sql);

                if (! empty($result)) {
                    echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=' />";
                    //echo 'success';
                 } else {
                   echo("Error description: " . $conn -> error);  
                 } 

            }else {

                $user_details = array();
                array_push($user_details,array(
                     'message'=>'Skill Not Employed successfully'
                 )); 
                 echo json_encode(array('result'=>$user_details));
            } 
            
        } else {
              echo("Error description: " . $conn -> error);  
        } 
    }
    $conn -> close(); 
}
 else if (isset($_POST['apply'])){
     
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $apply_id = filter_input(INPUT_POST, 'user_id');
    $scouted = 1;

    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from skill WHERE skill_id='$skill_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 

        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted', employer_id= '$apply_id' "
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/job-scouting.php' />";
            //echo 'success';
        } else {
            $user_details = array();
            array_push($user_details,array(
                'message'=>'Skill Not Updated successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
            $conn -> close();                   
        }        
                                                               
    } else {
        
        $user_details = array();
        array_push($user_details,array(
            'message'=>'Skill Not Updated successfully'
        )); 
        echo json_encode(array('result'=>$user_details));
        $conn -> close();  
    }
 }else if (isset($_POST['Dismiss'])){
     
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $apply_id = filter_input(INPUT_POST, 'user_id');
    $scouted = 0;

    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from skill WHERE skill_id='$skill_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 

        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted', employer_id= '$apply_id' "
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            if($account_type == 'graduate'){
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/job-scouted.php' />";
            //echo 'success';
            } else {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/student-approvals.php' />"; 
            }
        } else {
            $user_details = array();
            array_push($user_details,array(
                'message'=>'Skill Not Updated successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
            $conn -> close();                   
        }        
                                                               
    } else {
        
        $user_details = array();
        array_push($user_details,array(
            'message'=>'Skill Not Updated successfully'
        )); 
        echo json_encode(array('result'=>$user_details));
        $conn -> close();  
    }
 }else if (isset($_POST['employ-student'])){
    
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $student_id = filter_input(INPUT_POST, 'user_id');
    $scout_ins_user = filter_input(INPUT_POST, 'scout_ins_user');
    $scout_ins_user_id = filter_input(INPUT_POST, 'scout_ins_user_id');
    $scout_logo_grad_id = filter_input(INPUT_POST, 'scout_logo_grad_id');
    $scouted = 1; 
    $status = 1;
    $account_con = 1;
    
    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from skill WHERE skill_id='$skill_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 

        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted', employer_id= '$user_id' "
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            if($account_type == 'graduate'){
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/job-scouted.php' />";
            //echo 'success';
            } else {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/scout-skill-student.php' />"; 
            }
        } else {
            $user_details = array();
            array_push($user_details,array(
                'message'=>'Skill Not Updated successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
            $conn -> close();                   
        }        
                                                               
    } else {
        
        $user_details = array();
        array_push($user_details,array(
            'message'=>'Skill Not Updated successfully'
        )); 
        echo json_encode(array('result'=>$user_details));
        $conn -> close();  
    }
 }else if (isset($_POST['approve-student'])){
    
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $student_id = filter_input(INPUT_POST, 'user_id');
    $scout_ins_user = filter_input(INPUT_POST, 'scout_ins_user');
    $scout_ins_user_id = filter_input(INPUT_POST, 'scout_ins_user_id');
    $scout_logo_grad_id = filter_input(INPUT_POST, 'scout_logo_grad_id');
    $scouted = 2; 
    $status = 1;
    $account_con = 1;
    
    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from skill WHERE skill_id='$skill_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 

        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted'"
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            if($account_type == 'graduate'){
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/job-scouted.php' />";
            //echo 'success';
            } else {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/student-approvals.php' />"; 
            }
        } else {
            $user_details = array();
            array_push($user_details,array(
                'message'=>'Skill Not Updated successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
            $conn -> close();                   
        }        
                                                               
    } else {
        
        $user_details = array();
        array_push($user_details,array(
            'message'=>'Skill Not Updated successfully'
        )); 
        echo json_encode(array('result'=>$user_details));
        $conn -> close();  
    }
 }else if (isset($_POST['Dismiss-student'])){
    
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $student_id = filter_input(INPUT_POST, 'user_id');
    $scout_ins_user = filter_input(INPUT_POST, 'scout_ins_user');
    $scout_ins_user_id = filter_input(INPUT_POST, 'scout_ins_user_id');
    $scout_logo_grad_id = filter_input(INPUT_POST, 'scout_logo_grad_id');
    $scouted = 0; 
    $status = 1;
    $account_con = 1;
    
    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from skill WHERE skill_id='$skill_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 

        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted'"
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            if($account_type == 'graduate'){
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/job-scouted.php' />";
            //echo 'success';
            } else {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/student-approvals.php' />"; 
            }
        } else {
            $user_details = array();
            array_push($user_details,array(
                'message'=>'Skill Not Updated successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
            $conn -> close();                   
        }        
                                                               
    } else {
        
        $user_details = array();
        array_push($user_details,array(
            'message'=>'Skill Not Updated successfully'
        )); 
        echo json_encode(array('result'=>$user_details));
        $conn -> close();  
    }
 }else if (isset($_POST['end-contract'])){
    
    $skill_id = filter_input(INPUT_POST, 'scout_id');
    $student_id = filter_input(INPUT_POST, 'user_id');
    $scout_ins_user = filter_input(INPUT_POST, 'scout_ins_user');
    $scout_ins_user_id = filter_input(INPUT_POST, 'scout_ins_user_id');
    $scout_logo_grad_id = filter_input(INPUT_POST, 'scout_logo_grad_id');
    $scouted = 0; 
    $status = 1;
    $account_con = 1;
    
    //check if employer has employees and asign a temporaly employment id to new employees  
    $checkAccount = mysqli_query($conn, ("select * from skill WHERE skill_id='$skill_id'"));
    $checkExistance = mysqli_num_rows($checkAccount);    
    if($checkExistance > 0){ 

        //Update data
        $messageinsertSQL = "UPDATE skill SET scouted = '$scouted'"
                . "WHERE skill_id='$skill_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        
        if($messageinsertQuery){
            if($account_type == 'student'){
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/approved-student-skills.php' />";
            //echo 'success';
            } else {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/student-approved.php' />"; 
            }
        } else {
            $user_details = array();
            array_push($user_details,array(
                'message'=>'Skill Not Updated successfully'
            )); 
            echo json_encode(array('result'=>$user_details));
            $conn -> close();                   
        }        
                                                               
    } else {
        
        $user_details = array();
        array_push($user_details,array(
            'message'=>'Skill Not Updated successfully'
        )); 
        echo json_encode(array('result'=>$user_details));
        $conn -> close();  
    }
 }