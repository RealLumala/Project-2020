<?php
include_once('./db_connection.php'); 
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
include_once('session_manager.php');

if (isset($_POST["import"]))
{    
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  $in_name = filter_input(INPUT_POST, 'name');
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/employee_lists/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $name = "";
                if(isset($Row[0])) {
                    $name = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $reg_number = "";
                if(isset($Row[1])) {
                    $reg_number = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if (!empty($name) || !empty($reg_number)) {
                    
                    // DUPLICATE DATA CHECKS AGENTS
                    $sql = "SELECT * FROM employment_list WHERE employment_id='$name' and employer_id='$user_id'";
                    $query = mysqli_query($conn, $sql);
                    $u_check = mysqli_num_rows($query);

                    if($u_check > 0){
                       $user_details = array();
                            array_push($user_details,array(
                            'message'=>'This record of '.$name.' is already available in the Database'
                        )); 
                        //echo json_encode(array('result'=>$user_details));
                        
                        echo"<META HTTP-EQUIV='Refresh' "
                        . "CONTENT='0; URL=../views/confirm-employee.php?result=Some of the records "
                                . "are aready avilable in the system' />";
                        
                    } else {
                        
                        $query = "insert into employment_list(employment_id, student_number, institution_id, employer_id) "
                                . "values('$name', '".$reg_number."', '".$in_name."', '".$user_id."')";
                        $result = mysqli_query($conn, $query);
                
                        if (! empty($result)) {
                            $type = "success";
                            $message = "Excel Data Imported into the Database";
                            echo"<META HTTP-EQUIV='Refresh' "
                            . "CONTENT='0; URL=../views/confirm-employee.php?result=Excel Data Imported into "
                                    . "the System, year=$year' />";
                        } else {
                            $type = "error";
                            $message = "Problem in Importing Excel Data";
                            echo"<META HTTP-EQUIV='Refresh' "
                            . "CONTENT='0; URL=../views/confirm-employee.php?result=Problem "
                                    . "in Importing Excel Data' />";
                        }                        
                    }                    
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
        echo $type;
        echo '<br/><a href="../views/confirm-employee.php?result=try again"> Click Here to Try Again </a>';
  }
}
else if(isset($_POST['employ']))
{
        $employement_id = filter_input(INPUT_POST, 'employment_id');
        $messageinsertSQL = "UPDATE employement set stetus = 1, account_con=1  WHERE "
                . "employement_id = '$employement_id' and employer_id = '$user_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
        if($messageinsertQuery){
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=Record Updated successfuly' />";
        } else {
                echo("Error description: " . $conn -> error);
        }  
    
}else if(isset($_POST['dismiss']))
{
        $employement_id = filter_input(INPUT_POST, 'employment_id');
        $messageinsertSQL = "UPDATE employement set stetus = 0, account_con=0  WHERE "
                . "employement_id = '$employement_id' and employer_id = '$user_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
        if($messageinsertQuery){
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=Record Updated successfuly' />";
        } else {
                echo("Error description: " . $conn -> error);
        }   
}
else if(isset($_POST['delete'])){
    $curriculum = filter_input(INPUT_POST, 'id');
    $employement_id = filter_input(INPUT_POST, 'employment_id');
    //get number of confirmed students accounts                  
    $sqlSelect_un = "SELECT * FROM employement where employement_id = '$employement_id' and employer_id = '$user_id'";                   
    $result_un = mysqli_query($conn, $sqlSelect_un);
    $un = mysqli_num_rows($result_un);
    if (mysqli_num_rows($result_un) > 0)
    {
        //ADD INSTITUTION
        $messageinsertSQL = "UPDATE employement set account_con=0  WHERE "
                . "employement_id = '$employement_id' and employer_id = '$user_id'";
        $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        if($messageinsertQuery){
            //delete data
            $messageinsertSQL = "DELETE FROM employment_list WHERE id='$curriculum'";
            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
            if($messageinsertQuery){
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=Record Deleted successfuly' />";
            } else {
                echo("Error description: " . $conn -> error);
            }
        }
    } else {
            
            //delete data
            $messageinsertSQL = "DELETE FROM employment_list WHERE id='$curriculum'";
            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
            if($messageinsertQuery){
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/confirm-employee.php?result=Record Deleted successfuly' />";
            } else {
                echo("Error description: " . $conn -> error);
            }
    }
}
else if (isset($_POST["Confirm"]))
{    
    $employement_id = filter_input(INPUT_POST, 'employment-id');
    $reg_number = filter_input(INPUT_POST, 'reg_number');
    $in_name = filter_input(INPUT_POST, 'name');
    $user_id = filter_input(INPUT_POST, 'user_id');
    
    // DUPLICATE DATA CHECKS AGENTS
    $sql = "SELECT * FROM employment_list WHERE employment_id='$employement_id' and employer_id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $u_check = mysqli_num_rows($query);

    if($u_check > 0){
        // DUPLICATE DATA CHECKS AGENTS
        $sql = "SELECT * FROM graduate_list WHERE student_number='$reg_number' and institution_admin_id='$in_name'";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        
        if($u_check > 0){
            $fetchDetail_year = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $grad_year = $fetchDetail_year['year'];
            //update
            $messageinsertSQL = "UPDATE employement set grad_year='$grad_year'  WHERE "
                    . "employement_id = '$employement_id' and employer_id = '$employer_id'";
            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
            if($messageinsertQuery){
                $sql = "SELECT * FROM institution_admin WHERE id='$in_name'";
                $query = mysqli_query($conn, $sql);
                $u_check = mysqli_num_rows($query);
                $fetchDetail_s = mysqli_fetch_array($query, MYSQLI_ASSOC);
                $inst_name = $fetchDetail_s['institution_name'];
                $user_details = array();
                array_push($user_details,array(                    
                    'message'=>'This Employee Officailly Graduated from '.$inst_name
                ));                                    
                echo json_encode(array('result'=>$user_details));
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/"
                . "dashboard.php?result=This Employee Officailly Graduated from ".$inst_name."' />";
            }
            
        } else {
            
            $sql = "SELECT * FROM institution_admin WHERE id='$in_name'";
            $query = mysqli_query($conn, $sql);
            $u_check = mysqli_num_rows($query);
            $fetchDetail_s = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $inst_name = $fetchDetail_s['institution_name'];            
            $user_details = array();
            array_push($user_details,array(                    
                'message'=>'There is no record for Employee Officailly Graduating from '.$inst_name
            ));                                    
            echo json_encode(array('result'=>$user_details)); 
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/"
            . "dashboard.php?result=There is no record for Employee Officailly Graduating from ".$inst_name."' />";
        }

    } else {
        $sql = "SELECT * FROM institution_admin WHERE id='$in_name'";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        if($u_check > 0){
            $fetchDetail_s = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $inst_name = $fetchDetail_s['user_id'];
            $query = "insert into employment_list(employment_id, student_number, institution_id, employer_id) "
            . "values('$employement_id', '".$reg_number."', '".$inst_name."', '".$user_id."')";
            $result = mysqli_query($conn, $query);

            if (! empty($result)) {

                // DUPLICATE DATA CHECKS AGENTS
                $sql = "SELECT * FROM graduate_list WHERE student_number='$reg_number' and institution_admin_id='$in_name'";
                $query = mysqli_query($conn, $sql);
                $u_check = mysqli_num_rows($query);

                if($u_check > 0){
                    $fetchDetail_year = mysqli_fetch_array($query, MYSQLI_ASSOC);
                    $grad_year = $fetchDetail_year['year'];
                    //update
                    $messageinsertSQL = "UPDATE employement set grad_year='$grad_year'  WHERE "
                            . "employement_id = '$employement_id' and employer_id = '$employer_id'";
                    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                    if($messageinsertQuery){

                        $sql = "SELECT * FROM institution_admin WHERE id='$in_name'";
                        $query = mysqli_query($conn, $sql);
                        $u_check = mysqli_num_rows($query);
                        $fetchDetail_s = mysqli_fetch_array($query, MYSQLI_ASSOC);
                        $inst_name = $fetchDetail_s['institution_name'];
                        $user_details = array();
                        array_push($user_details,array(                    
                            'message'=>'This Employee Officailly Graduated from '.$inst_name
                        ));                                    
                        echo json_encode(array('result'=>$user_details));
                        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/"
                        . "dashboard.php?result=This Employee Officailly Graduated from ".$inst_name."' />";
                    }

                } else {

                    $sql = "SELECT * FROM institution_admin WHERE id='$in_name'";
                    $query = mysqli_query($conn, $sql);
                    $u_check = mysqli_num_rows($query);
                    $fetchDetail_s = mysqli_fetch_array($query, MYSQLI_ASSOC);
                    $inst_name = $fetchDetail_s['institution_name'];
                    $user_details = array();
                    array_push($user_details,array(                    
                        'message'=>'There is no record for Employee Officailly Graduating from '.$inst_name
                    ));                                    
                    echo json_encode(array('result'=>$user_details));
                    echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/"
                . "dashboard.php?result=There is no record for Employee Officailly Graduating from ".$inst_name."' />";
                } 

            } else {

                $user_details = array();
                array_push($user_details,array(
                    'message'=>'This record of is not added to the Database'
                )); 
                echo json_encode(array('result'=>$user_details));
            }
        }else {

                $user_details = array();
                array_push($user_details,array(
                    'message'=>'This record of is not added to the Database'
                )); 
                echo json_encode(array('result'=>$user_details));
        }
    }  
}
$conn -> close();

