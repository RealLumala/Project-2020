<?php
$target_dir = "uploads/logos/";
$target_file = $target_dir . $insname.".png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$check = getimagesize($_FILES["file"]["tmp_name"]);

// Check if image file is a actual image or fake image
if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br/>";
    $uploadOk = 1;
} else {
    echo "File is not an image.<br/>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br/>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br/>";
    $uploadOk = 0;
}

/* Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br/>";
    $uploadOk = 0;
}*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br/>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.<br/>";
    } else {
        echo "Sorry, there was an error uploading your file.<br/>";
    }
}
//move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
