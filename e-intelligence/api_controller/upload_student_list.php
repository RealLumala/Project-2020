<?php
include_once('./db_connection.php'); 
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
include_once('session_manager.php');

if (isset($_POST["import"]))
{    
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  $year = filter_input(INPUT_POST, 'year');
  $course = filter_input(INPUT_POST, 'course');
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/student_lists/'.$_FILES['file']['name'];
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
                    $sql = "SELECT * FROM student_list WHERE student_number='$reg_number' and institution_admin_id='$institution_id'";
                    $query = mysqli_query($conn, $sql);
                    $u_check = mysqli_num_rows($query);

                    if($u_check > 0){
                       $user_details = array();
                            array_push($user_details,array(
                            'message'=>'This record of '.$name.' is already available in the Database'
                        )); 
                        //echo json_encode(array('result'=>$user_details));
                        //echo '<br/><a href="../views/Tes_upload.php"> Click Here to Try Again </a>';
                        //echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload_graduate_list.php' />";
                        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload_student_list.php?result=Some of the records are aready avilable in the system' />";
                        
                    } else {
                        
                        $query = "insert into student_list(student_name, student_number, course, year, updated, institution_admin_id) "
                                . "values('".$name."', '".$reg_number."', '".$course."', '".$year."', now(), '".$institution_id."')";
                        $result = mysqli_query($conn, $query);
                
                        if (! empty($result)) {
                            $type = "success";
                            $message = "Excel Data Imported into the Database";
                            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload_student_list.php?result=Excel Data Imported into the System, year=$year' />";
                        } else {
                            $type = "error";
                            $message = "Problem in Importing Excel Data";
                            echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload_student_list.php?result=Problem in Importing Excel Data' />";
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
        echo '<br/><a href="../views/upload_student_list.php?result=try again"> Click Here to Try Again </a>';
  }
}

