<?php
//dashboad for registrars
if($account_type == 'registrar'){
    //get number of unconfirmed students accounts  
    $sqlSelect_uncofirmed = "SELECT * FROM student where institution_id='$user_id' and account_con = 0 order by id desc";                   
    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
        
?> 
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_uncofirmed) > 0)
    {
        $unconfirmed = mysqli_num_rows($result_uncofirmed);
    ?>      
            <div class="card-header">Active Tasks for unverified students to clear <?php echo $unconfirmed; ?>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Task Id</th>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
       while ($row = mysqli_fetch_array($result_uncofirmed)) {
           $student_id = $row['user_id'];
           $student_number = $row['student_number'];
           $student_add = $row['created'];
               
           $sqlSelect_uncofirmed_1 = "SELECT * FROM user where user_id='$student_id'";                   
           $result_uncofirmed_1 = mysqli_query($conn, $sqlSelect_uncofirmed_1);
               
           $row_2 = mysqli_fetch_array($result_uncofirmed_1);
           $student_fname = $row_2['first_name'];           
           $student_lname = $row_2['last_name'];       
    ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $student_number; ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="./<?php echo $logo; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?php echo $student_fname; ?></div>
                                            <div class="widget-subheading opacity-7"><?php echo $student_lname; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $student_add; ?></td>
                            <td class="text-center">
                                <div class="badge badge-warning">Pending verification</div>
                            </td>
                        </tr>
    <?php
       }
       ?>
                    </tbody>
                </table>
            </div> 
       <?php
    }else {
        ?>
            <div class="card-header">Active Tasks for unverified students to clear none
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Task Id</th>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
    <?php    
    }
    ?>
        </div>
    </div>
</div>
    <?php
    $sqlSelect_uncofirmed_grads = "SELECT * FROM graduate where institution_id='$user_id' and account_con=0 order by id desc";                   
    $result_uncofirmed_grads = mysqli_query($conn, $sqlSelect_uncofirmed_grads);
        
?> 
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_uncofirmed_grads) > 0)
    {
        $unconfirmed_grads = mysqli_num_rows($result_uncofirmed_grads);
    ?>
            <div class="card-header">Active Tasks for unverified Graduates to clear <?php echo $unconfirmed_grads; ?>
            </div>  
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Task Id</th>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
       while ($row = mysqli_fetch_array($result_uncofirmed_grads)) {
           $student_id = $row['user_id'];
           $student_number = $row['student_number'];
           $student_add = $row['created'];
               
           $sqlSelect_uncofirmed = "SELECT * FROM user where user_id='$student_id'";                   
           $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
           $unconfirmed = mysqli_num_rows($result_uncofirmed);
           $row_2 = mysqli_fetch_array($result_uncofirmed);
           $student_fname = $row_2['first_name'];           
           $student_lname = $row_2['last_name'];       
    ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $student_number; ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="./<?php echo $logo; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading"><?php echo $student_fname; ?></div>
                                            <div class="widget-subheading opacity-7"><?php echo $student_lname; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $student_add; ?></td>
                            <td class="text-center">
                                <div class="badge badge-warning">Pending verification</div>
                            </td>
                        </tr>
    <?php
       }
       ?>
                    </tbody>
                </table>
            </div> 
       <?php
    } else {
        ?>
            <div class="card-header">Active Tasks for unverified Graduates to clear none
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Task Id</th>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
    <?php    
    }
    ?>
        </div>
    </div>
</div>
    <?php
}
//dashboad for employers
else if($account_type == 'employer'){
?>
<div clas="row">
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Confirm Employee Graduate Details</h5>
                <form action="../api_controller/upload_employee_list.php" method="post"
                      name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Skill name" class="">Select Institution</label>
                                <select name="name" id="name" class="form-control" required>
                                    <option>Select Institution</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkAccounts = mysqli_query($conn, ("select * from institution_admin"));
                                                $checkExistances = mysqli_num_rows($checkAccounts);
                                                if($checkExistances > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['institution_name'];
                                                        echo '<option value="'.$inst_id.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Skill name" class="">Employment ID</label>
                                <input name="employment-id" id="title" placeholder="Employment ID" 
                                       type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Skill name" class="">Academic Registration Number</label>
                                <input name="reg_number" id="reg_number" placeholder="Registration Number" 
                                       type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="Skill name" class="">Employee Surname</label>
                                <input name="surname" id="surname" placeholder="Employee Last-name" 
                                       type="text" class="form-control">
                            </div>
                        </div>
                    </div> 
                    <input name="user_id" id="user_id" value="<?php echo $user_id; ?>" 
                           type="hidden" class="form-control" required>
                    <button class="mt-2 btn btn-primary" name="Confirm" 
                            type="submit" id="btn-upload">Confirm</button>
                </form>                      
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card btn-primary">
            <div class="card-header">
                <?php
                    if($_GET["result"] === null){
                        $result_feedback = "";
                        echo $result_feedback; 
                    } else {
                        $result_feedback = $_GET["result"];
                        echo $result_feedback;   
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
<?php
    //get number of confirmed students accounts                  
    $sqlSelect_uncofirmed = "SELECT * FROM employement where employer_id = '$employer_id' and account_con = 0";                   
    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
    $unconfirmed = mysqli_num_rows($result_uncofirmed);
    if (mysqli_num_rows($result_uncofirmed) > 0)
    {   
    ?>
            <div class="card-header">Unconfirmed Employees
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Employment ID</th>
                            <th class="text-center">Employee Name</th>
                            <th class="text-center">Date Created</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                            while ($row = mysqli_fetch_array($result_uncofirmed)){
                                    $employment_id = $row['employement_id'];
                                    $account_con = $row['account_con'];
                                    //employement account status
                                    if($account_con == 0){
                                        $account = 'Activation Needed'; 
                                        $account_v = '<div class="badge badge-warning">Pending Verification</div>';
                                    } else {
                                        $account = 'Activated'; 
                                        $account_v = '<div class="badge badge-success">Verified</div>';
                                    }                        
                        ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $employment_id; ?></td>
                            <td class="text-center text-muted">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account <?php echo $first_name.' '.$last_name; ?></div>
                                            <div class="widget-subheading opacity-7"><?php echo $account; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-muted"><?php echo $row['date_created']; ?></td>
                            <td class="text-center text-muted">
                                <?php echo $account_v; ?>
                            </td>
                            <td class="text-center text-muted">
                                <form action="../api_controller/upload_employee_list.php" method="post" >
                                    <input name="employment_id" id="id" value="<?php echo $employment_id; ?>" 
                                           type="hidden" class="form-control">
                                    <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="employ">
                                        Confirm
                                    </button>
                                </form>
                            </td>
                        </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
    <?php
    }
?>
        </div>
    </div>
</div>
<?php
} 
//dashboad for students and graduates
else if($account_type == 'graduate'){ 
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
<?php
    //get number of confirmed students accounts                  
    $sqlSelect_cofirmed = "SELECT * FROM graduate where user_id = '$user_id' and account_con = 0";                   
    $result_cofirmed = mysqli_query($conn, $sqlSelect_cofirmed);
    $confirmed = mysqli_num_rows($result_cofirmed);
    if (mysqli_num_rows($result_cofirmed) > 0)
    {
        $row = mysqli_fetch_array($result_cofirmed);   
    ?>
            <div class="card-header">Active Tasks on Institution
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account <?php echo $first_name.' '.$last_name; ?></div>
                                            <div class="widget-subheading opacity-7">Activation Needed</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $row['created']; ?></td>
                            <td class="text-center">
                                <div class="badge badge-warning">Pending Verification</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    <?php
    } else {
        echo '<div class="card-header">Active Tasks on Institution
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account '.$first_name.' '.$last_name.'</div>
                                            <div class="widget-subheading opacity-7">Activated</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">'.$Updated.'</td>
                            <td class="text-center">
                                <div class="badge badge-warning">Verified</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>';
    }
    ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
<?php
    //get number of confirmed students accounts                  
    $sqlSelect_uncofirmed = "SELECT * FROM employement where graduate_id = '$user_id'";                   
    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
    $unconfirmed = mysqli_num_rows($result_uncofirmed);
    if (mysqli_num_rows($result_uncofirmed) > 0)
    {
    ?>
            <div class="card-header">Active Tasks ON Employment
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Employment Id</th>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($row = mysqli_fetch_array($result_uncofirmed)){
                                    $employment_id = $row['employement_id'];
                                    $account_con = $row['account_con'];
                                    //employement account status
                                    if($account_con == 0){
                                        $account = 'Activation Needed'; 
                                        $account_v = '<div class="badge badge-warning">Pending Verification</div>';
                                    } else {
                                        $account = 'Activated'; 
                                        $account_v = '<div class="badge badge-success">Verified</div>';
                                    }                        
                        ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $employment_id; ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account <?php echo $first_name.' '.$last_name; ?></div>
                                            <div class="widget-subheading opacity-7"><?php echo $account; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $row['date_created']; ?></td>
                            <td class="text-center">
                                <?php echo $account_v; ?>
                            </td>
                        </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
    <?php
    }else {
        echo '<div class="card-header">Active Tasks ON Employment
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account '.$first_name.' '.$last_name.'</div>
                                            <div class="widget-subheading opacity-7">Account employment</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">'.$created_g.'</td>
                            <td class="text-center">
                                <div class="badge badge-warning">No Employment Details</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>';
    }
    ?>
        </div>
    </div>
</div>
<?php }
//dashboad for students and graduates
else { 
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
<?php
    //get number of confirmed students accounts                  
    $sqlSelect_cofirmed = "SELECT * FROM student where user_id = '$user_id' and account_con = 0";                   
    $result_cofirmed = mysqli_query($conn, $sqlSelect_cofirmed);
    $confirmed = mysqli_num_rows($result_cofirmed);
    if (mysqli_num_rows($result_cofirmed) > 0)
    {
        $row = mysqli_fetch_array($result_cofirmed);   
    ?>
            <div class="card-header">Active Tasks on Institution
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account <?php echo $first_name.' '.$last_name; ?></div>
                                            <div class="widget-subheading opacity-7">Activation Needed</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $row['created']; ?></td>
                            <td class="text-center">
                                <div class="badge badge-warning">Pending Verification</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    <?php
    } else {
        echo '<div class="card-header">Active Tasks on Institution
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th class="text-center">Date Started</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Account '.$first_name.' '.$last_name.'</div>
                                            <div class="widget-subheading opacity-7">Activated</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">'.$Updated.'</td>
                            <td class="text-center">
                                <div class="badge badge-warning">Verified</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>';
    }
    ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Skills Standings
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="active btn btn-focus">Last Week</button>
                        <button class="btn btn-focus">All Month</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Skill Id</th>
                            <th>Skill Name</th>
                            <th class="text-center">Date Created</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">File Size</th>
                        </tr>
                    </thead>
                    <tbody>
                                <?php
                                    $sqlSelect_uncofirmed = "SELECT * FROM skill where user_id='$user_id' order by skill_id desc";                   
                                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                    if (mysqli_num_rows($result_uncofirmed) > 0)
                                    {
                                    while($row = mysqli_fetch_array($result_uncofirmed))
                                    {
                                        $skill_id = $row['skill_id'];
                                        $skill_name = $row['Name'];
                                        $skill_path = $row['doc_path'];
                                        $skill_type = $row['file_type'];
                                        $skill_size = $row['file_size'];
                                        $skill_status = $row['rating'];
                                        $skill_created = $row['date_created'];
                                            
                                ?>
                        <tr>
                            <td class="text-center text-muted">S00<?php echo $skill_id; ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading"><?php echo $skill_name; ?></div>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $skill_created; ?></td>
                            <td class="text-center">
                                        <?php 
                                            if ($skill_status == '1'){                                                
                                                echo '<div class="badge badge-warning">Average</div>'; 
                                            } else if ($skill_status == '2'){                                                
                                                echo '<div class="badge badge-success">Perfected</div>'; 
                                            } else {                                                
                                                echo '<div class="badge badge-info">Beginner</div>'; 
                                            }
                                        ?>
                            </td>
                            <td class="text-center"><?php echo $skill_size/1000; echo ' Kbs'; ?></td>
                        </tr>
                                <?php
                                        }
                                    } else {
                                        $sqlSelect_uncofirmed = "SELECT * FROM skill where employer_id='$user_id' order by skill_id desc";                   
                                        $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                        if (mysqli_num_rows($result_uncofirmed) > 0)
                                        {
                                            while($row = mysqli_fetch_array($result_uncofirmed))
                                            {
                                                $skill_id = $row['skill_id'];
                                                $skill_name = $row['Name'];
                                                $skill_path = $row['doc_path'];
                                                $skill_type = $row['file_type'];
                                                $skill_size = $row['file_size'];
                                                $skill_status = $row['rating'];
                                                $skill_created = $row['date_created'];
                                                    
                                ?>
                        <tr>
                            <td class="text-center text-muted">S00<?php echo $skill_id; ?></td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading"><?php echo $skill_name; ?></div>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo $skill_created; ?></td>
                            <td class="text-center">
                                        <?php 
                                            if ($skill_status == '1'){                                                
                                                echo '<div class="badge badge-warning">Average</div>'; 
                                            } else if ($skill_status == '2'){                                                
                                                echo '<div class="badge badge-success">Perfected</div>'; 
                                            } else {                                                
                                                echo '<div class="badge badge-info">Beginner</div>'; 
                                            }
                                        ?>
                            </td>
                            <td class="text-center"><?php echo $skill_size/1000; echo ' Kbs'; ?></td>
                        </tr>
                                        <?php
                                                }
                                        }
                                }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } 