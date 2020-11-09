<?php
include_once('./db_connection.php');
include_once('session_manager.php');
if(isset($_POST['btn-upload']))
{
    $company = filter_input(INPUT_POST, 'name');
    $employement_id = filter_input(INPUT_POST, 'employment-id');
    $year = filter_input(INPUT_POST, 'year');
    
    // DUPLICATE DATA CHECKS AGENTS
    $sql = "SELECT * FROM employement WHERE employement_id='$employement_id'";
    $query = mysqli_query($conn, $sql);
    $u_check = mysqli_num_rows($query);

    if($u_check > 0){
       $user_details = array();
            array_push($user_details,array(
            'message'=>'This employement_id is already Avilable'
        )); 
        echo json_encode(array('result'=>$user_details));
        echo '<br/><a href="../views/employment.php"> Click Here to Try Again </a>';
    } else { 
        
        $sql="INSERT INTO employement(employement_id, graduate_id, grad_year, employer_id, institution_id)"
                . "VALUES('$employement_id', '$user_id', '$year', '$company', '$reg_id')";
        $result = mysqli_query($conn, $sql);
        if (! empty($result)) {
            echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/employment.php' />";
            echo 'success';
        } else {
            echo("Error description: " . $conn -> error); 
        }        
    }
 
}else if(isset($_POST['delete']))
{
    $curriculum = filter_input(INPUT_POST, 'id');
     //delete data
    $messageinsertSQL = "DELETE FROM employement WHERE employement_id='$curriculum'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
    if($messageinsertQuery){
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/employment.php' />";
    } else {
        echo("Error description: " . $conn -> error);
    }
}
$conn -> close();
//move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
