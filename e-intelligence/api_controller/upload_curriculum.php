<?php
include_once('./db_connection.php');
include_once('session_manager.php');
if(isset($_POST['btn-upload']))
{
    $curriculum = filter_input(INPUT_POST, 'title');
    $target_dir = "uploads/docs/";
    $cul_name = $curriculum.rand(1000,100000)."-".$_FILES['file']['name'];
    $uploadOk = 1;
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $target_file = $target_dir .$curriculum.rand(1000,100000)."-".$_FILES['file']['name'];

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br/>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./upload_curriculum.php' />";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br/>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file_loc, $target_file)) {

            $sql="INSERT INTO curriculum(curriculum, file_path, file_type, file_size, created, updated, "
                    . "institution_admin_id)VALUES('$cul_name', '$target_file', '$file_type', "
                    . "'$file_size', now(), now(), '$user_id')";
            $result = mysqli_query($conn, $sql);
            if (! empty($result)) {
               echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload-curriculum.php' />";
            } else {
              echo("Error description: " . $conn -> error);  
            }

        } else {
            echo "Sorry, there was an error uploading your file.<br/>";
        }
    }
}else if(isset($_POST['endorsed']))
{
    $curriculum = filter_input(INPUT_POST, 'id');
    $status = 1;
     //Update data
    $messageinsertSQL = "UPDATE curriculum SET status = '$status' WHERE curriculum_id='$curriculum'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
    if($messageinsertQuery){
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload-curriculum.php' />";
    } else {
        echo("Error description: " . $conn -> error);
    }
    
}else if(isset($_POST['delete']))
{
    $curriculum = filter_input(INPUT_POST, 'id');
     //delete data
    $messageinsertSQL = "DELETE FROM curriculum WHERE curriculum_id='$curriculum'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL); 
    if($messageinsertQuery){
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=../views/upload-curriculum.php' />";
    } else {
        echo("Error description: " . $conn -> error);
    }
}
$conn -> close();
//move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
