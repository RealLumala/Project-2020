<?php
//get number of students                  
$sqlSelect = "SELECT count(id) as no_of_students FROM student";                   
$result = mysqli_query($conn, $sqlSelect);
if (mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_array($result);
    $number_of_students = $row['no_of_students'];    
}
//get number of graduates                
$sqlSelect_g = "SELECT count(id) as no_of_graduates FROM graduate";                   
$result_g = mysqli_query($conn, $sqlSelect_g);
if (mysqli_num_rows($result_g) > 0)
{
    $row = mysqli_fetch_array($result_g);
    $number_of_graduates = $row['no_of_graduates'];    
}
//get number of isntitutions               
$sqlSelect_I = "SELECT count(id) as no_of_isntitutions FROM institution_admin";                   
$result_I = mysqli_query($conn, $sqlSelect_I);
if (mysqli_num_rows($result_I) > 0)
{
    $row = mysqli_fetch_array($result_I);
    $number_of_isntitutions = $row['no_of_isntitutions'];    
}
//get number of employers              
$sqlSelect_e = "SELECT count(id) as no_of_employers FROM employer";                   
$result_e = mysqli_query($conn, $sqlSelect_e);
if (mysqli_num_rows($result_e) > 0)
{
    $row = mysqli_fetch_array($result_e);
    $number_of_employers = $row['no_of_employers'];    
}
//get number of skills              
$sqlSelect_s = "SELECT count(skill_id) as no_of_skills FROM skill where user_id='$user_id'";                   
$result_s = mysqli_query($conn, $sqlSelect_s);
if (mysqli_num_rows($result_s) > 0)
{
    $row = mysqli_fetch_array($result_s);
    $number_of_skills = $row['no_of_skills'];    
} 
$sqlSelect_se = "SELECT count(skill_id) as no_of_skills FROM skill where employer_id ='$user_id'";                   
$result_se = mysqli_query($conn, $sqlSelect_se);
if (mysqli_num_rows($result_se) > 0)
{
    $row = mysqli_fetch_array($result_se);
    $number_of_eskills = $row['no_of_skills'];    
}
//perfected skills
$sqlSelect_ps = "SELECT count(skill_id) as no_of_ps FROM skill where rating = 2 and user_id='$user_id'";                   
$result_ps = mysqli_query($conn, $sqlSelect_ps);
if (mysqli_num_rows($result_ps) > 0)
{
    $row = mysqli_fetch_array($result_ps);
    $number_of_ps = $row['no_of_ps'];    
}
$sqlSelect_pse = "SELECT count(skill_id) as no_of_ps FROM skill where rating = 2 and employer_id ='$user_id'";                   
$result_pse = mysqli_query($conn, $sqlSelect_pse);
if (mysqli_num_rows($result_pse) > 0)
{
    $row = mysqli_fetch_array($result_pse);
    $number_of_pes = $row['no_of_ps'];    
}
