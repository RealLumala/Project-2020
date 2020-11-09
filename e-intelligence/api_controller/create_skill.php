<?php
include_once('./db_connection.php');
include_once('session_manager.php');
if(isset($_POST['btn-upload']))
{
    $skill = filter_input(INPUT_POST, 'skill-name');
    if($account_type == 'employer'){
       $employer_id = $user_id;
       $skill_mapping = filter_input(INPUT_POST, 'selinsname');
       $skill_user_id = '';
    } else {
       $skill_user_id = $user_id; 
       $skill_mapping = $reg_id;
       $employer_id = filter_input(INPUT_POST, 'selinsname');
    }
    $target_dir = "uploads/skills/";
    $doc_id = rand(1000,100000);
    $cul_name = $skill.$doc_id."-".$_FILES['file']['name'];
    $uploadOk = 1;
    $file = $doc_id."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $target_file = $target_dir .$doc_id."-".$_FILES['file']['name'];

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br/>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./creating_skill.php' />";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br/>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file_loc, $target_file)) {

            $sql="INSERT INTO skill(Name, user_id, date_created, date_updated, employer_id,"
                    . "institution_admin_id, doc_path, file_type, file_size, doc_id)"
                    . "VALUES('$skill', '$skill_user_id', now(), "
                    . "now(), '$employer_id', '$skill_mapping', '$target_file', '$file_type', '$file_size', '$doc_id')";
            $result = mysqli_query($conn, $sql);
            if (! empty($result)) {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/creating-skill.php' />";
               //echo 'success';
            } else {
              echo("Error description: " . $conn -> error);  
            }

        } else {
            echo "Sorry, there was an error uploading your file.<br/>";
        }
    }
}else if(isset($_POST['avreage']))
{
    $curriculum = filter_input(INPUT_POST, 'id');
    $status = 1;
     //Update data
    $messageinsertSQL = "UPDATE skill SET rating = 1 WHERE skill_id='$curriculum'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
    if($messageinsertQuery){
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/creating-skill.php' />";
    } else {
        echo("Error description: " . $conn -> error);
    }
    
}else if(isset($_POST['perfected']))
{
    $curriculum = filter_input(INPUT_POST, 'id');
     //delete data
    $messageinsertSQL = "UPDATE skill SET rating = 2 WHERE skill_id='$curriculum'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
    if($messageinsertQuery){
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/creating-skill.php' />";
    } else {
        echo("Error description: " . $conn -> error);
    }
}else if(isset($_POST['delete']))
{
    $curriculum = filter_input(INPUT_POST, 'id');
     //delete data
    $messageinsertSQL = "DELETE FROM skill WHERE skill_id='$curriculum'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
    if($messageinsertQuery){
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/creating-skill.php' />";
    } else {
        echo("Error description: " . $conn -> error);
    }
}
$conn -> close();
//move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
