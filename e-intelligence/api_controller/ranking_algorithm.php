<?Php
//award points 
$points = 0;
if($x == 'postive'){
    $points = 3;   
}elseif ($x == 'negative') {
    $points = -3;    
}else {
    $points = 2;     
}

// DUPLICATE DATA CHECKS 
$sql = "SELECT * FROM institution_ranking WHERE institution_id = '$institution_id'";
$query = mysqli_query($conn, $sql);
$u_check = mysqli_num_rows($query);
if($u_check > 0){
    
    $fetchDetail_s = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $current_points = $fetchDetail_s['rank_points'];
    $new_points = $current_points+$points;
    //Update data
    $messageinsertSQL = "UPDATE institution_ranking SET rank_points = '$new_points' WHERE "
            . "institution_id='$institution_id'";
    $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
    if($messageinsertQuery){
      //echo $x.' Language '.$l;  
    } else {
      echo 'AI ERROR 404';
    }
    
} else {
    
    $query = "insert into institution_ranking(institution_id, rank_points) "
            . "values('$institution_id', '".$points."')";
    $result = mysqli_query($conn, $query);

    if (! empty($result)) {

        $user_details = array();
        array_push($user_details,array(
            'message'=>'This record of is added to the Database'
        )); 
        echo json_encode(array('result'=>$user_details));

    } else {
        $user_details = array();
        array_push($user_details,array(
            'message'=>'This record of is not added to the Database'
        )); 
         echo json_encode(array('result'=>$user_details));
    }
    
}
