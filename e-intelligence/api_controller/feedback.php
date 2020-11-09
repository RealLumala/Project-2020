<?php
include_once('./db_connection.php'); 
include_once('session_manager.php');
require_once('AI_Library/DatumboxAPI.php');
$api_key='d9558c5918dd3b5dfe19cdd285cb0037'; 
$DatumboxAPI = new DatumboxAPI($api_key);
    
if (isset($_POST["btn-upload"]))
{    
    $employement_id = filter_input(INPUT_POST, 'employment_id');
    $comment = filter_input(INPUT_POST, 'comment');
    $institution_id = filter_input(INPUT_POST, 'institution_id');
    $field_employment = filter_input(INPUT_POST, 'field-employment');
    $programming_language = 'code';
    echo $field_employment.'</br>';
    
    //available entry
    $programming_language_p = filter_input(INPUT_POST, 'programming-language');
    
    if($programming_language_p == 'programming'){ 
        
        $programming_language_d = filter_input(INPUT_POST, 'programming-language-d'); 
        
        if($programming_language_d == 'application-design'){ 
            
            $programming_language_a = filter_input(INPUT_POST, 'programming-language-a');
            
            if($programming_language_a == 'application-development'){
                
                $programming_language = "code";
                
            } else {
                
                $programming_language = $programming_language_a;  
            }
            
        } else {
            
            $programming_language = $programming_language_d; 
            
        }            
    } else {        
        $programming_language = $programming_language_p;  
    }
    
    //new entry
    if($programming_language == 'other'){        
        $programming_language = filter_input(INPUT_POST, 'programming-language-other');
    }
    
    echo $programming_language.'</br>';
    
    //employer id
    $user_id = filter_input(INPUT_POST, 'user_id');        
    $text= $comment;    
    //using Classification API
    $DocumentClassification=array();
    $DocumentClassification['SentimentAnalysis']=$DatumboxAPI->SentimentAnalysis($text);
    $DocumentClassification['LanguageDetection']=$DatumboxAPI->LanguageDetection($text);
    unset($DatumboxAPI);
        
    $x = $DocumentClassification['SentimentAnalysis'];
    $l = $DocumentClassification['LanguageDetection']; 
        
    if($x != null){
        
        // DUPLICATE DATA CHECKS AGENTS
        $sql = "SELECT * FROM employment_list WHERE employment_id='$employement_id' and employer_id='$user_id'";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
            
        if($u_check > 0){
            
            $query = "insert into feedback(feedback_content, field_employment, programming_language, comment_status, employment_id, employer_id, institution_admin_id) "
            . "values('$comment', '".$field_employment."', '".$programming_language."', '".$x."', '".$employement_id."', '".$user_id."', '".$institution_id."')";
            $result = mysqli_query($conn, $query);
                
            if (! empty($result)) {
                
                $user_details = array();
                array_push($user_details,array(
                    'message'=>'This record of is added to the Database'
                )); 
                echo json_encode(array('result'=>$user_details)).'<br/>';
                include_once('ranking_algorithm.php');
                echo '<br/>';
                // DUPLICATE DATA CHECKS
                $sql_p = "SELECT * FROM programming_languages WHERE name='$programming_language'";
                $query_p = mysqli_query($conn, $sql_p);
                $u_check_p = mysqli_num_rows($query_p);
                if($u_check_p > 0){

                    $programming_language = $programming_language;

                } else {        
                    $sql_p = "insert into programming_languages (name) values('$programming_language')";
                    $result = mysqli_query($conn, $sql_p);
                    if (! empty($result)) {
                        $user_details = array();
                        array_push($user_details,array(
                            'message'=>'This record of is added to the Database'
                        )); 
                        echo json_encode(array('result'=>$user_details));

                    }else {
                        $user_details = array();
                        array_push($user_details,array(
                        'message'=>'This record of is not added to the Database after insert pl'
                        )); 
                        echo json_encode(array('result'=>$user_details));
                    }            
                }
                echo"<META HTTP-EQUIV='Refresh' "
                        . "CONTENT='0; URL=../views/give_feedback.php?result= Feedback well recieved' />";
                    
            }else {
                
                $user_details = array();
                array_push($user_details,array(
                    'message'=>'This record of is not added to the Database'
                )); 
                echo json_encode(array('result'=>$user_details));
                echo"<META HTTP-EQUIV='Refresh' "
                        . "CONTENT='0; URL=../views/give_feedback.php?result= Feedback Not recieved' />";
            } 
                
        } else {
            
            $query = "insert into feedback(feedback_content, field_employment, programming_language, comment_status, employment_id, employer_id, institution_admin_id) "
            . "values('$comment', '".$field_employment."', '".$programming_language."', '".$x."', '".$employement_id."', '".$user_id."', '".$institution_id."')";
            $result = mysqli_query($conn, $query);
                
            if (! empty($result)) {
                
                $user_details = array();
                array_push($user_details,array(
                    'message'=>'This record of is added to the Database'
                )); 
                echo json_encode(array('result'=>$user_details)).'<br/>';
                include_once('ranking_algorithm.php');
                echo '<br/>';
                // DUPLICATE DATA CHECKS
                $sql_p = "SELECT * FROM programming_languages WHERE name='$programming_language'";
                $query_p = mysqli_query($conn, $sql_p);
                $u_check_p = mysqli_num_rows($query_p);
                if($u_check_p > 0){

                    $programming_language = $programming_language;

                } else {        
                    $sql_p = "insert into programming_languages (name) values('$programming_language')";
                    $result = mysqli_query($conn, $sql_p);
                    if (! empty($result)) {
                        $user_details = array();
                        array_push($user_details,array(
                            'message'=>'This record of is added to the Database'
                        )); 
                        echo json_encode(array('result'=>$user_details));

                    }else {
                        $user_details = array();
                        array_push($user_details,array(
                        'message'=>'This record of is not added to the Database after insert pl'
                        )); 
                        echo json_encode(array('result'=>$user_details));
                    }            
                }
                echo"<META HTTP-EQUIV='Refresh' "
                        . "CONTENT='0; URL=../views/give_feedback.php?result= Feedback well recieved' />";
                    
            }else {
                
                $user_details = array();
                array_push($user_details,array(
                    'message'=>'This record of is not added to the Database'
                )); 
                echo json_encode(array('result'=>$user_details));
                echo"<META HTTP-EQUIV='Refresh' "
                        . "CONTENT='0; URL=../views/give_feedback.php?result= Feedback Not recieved' />";
            }                        
        }
            
    }else{
        echo 'AI not functioning';
    }  
}