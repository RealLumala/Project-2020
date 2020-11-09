<?php
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include_once('header.php');
    include_once('side_bar_manue.php');
?>
<style>
    textarea.form-control {
        height: 150px;
    }
    .box{
        display: none;
    }
    .Programming{}
    .Application-Design{}
    .Application-Development{}
    .other{}
</style>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-satellite icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Give Institutions Feedback
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin --> 
        <div clas="row">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">General Feedback Par Institution</h5>
                        <form action="../api_controller/feedback.php" method="post"
                              name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <?php 
                            $employments = '';
                            if (isset($_POST['employment_feedback'])){                        
                                $employments = filter_input(INPUT_POST, 'employment_feedback');
                                //get number of confirmed students accounts                  
                                $sqlSelect_uncofirmed = "SELECT * FROM employement where employement_id = '$employments' and employer_id = '$user_id'";                   
                                $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                $unconfirmed = mysqli_num_rows($result_uncofirmed);
                                if (mysqli_num_rows($result_uncofirmed) > 0)
                                {                                    
                                    $row = mysqli_fetch_array($result_uncofirmed);
                                    $graduate_id = $row['graduate_id'];
                                        
                                    $employment_feedback = $row['employement_id'];
                                    $sqlSelect_un = "SELECT * FROM graduate where user_id = '$graduate_id'";                   
                                    $result_un = mysqli_query($conn, $sqlSelect_un);
                                    $un = mysqli_num_rows($result_un);
                                        
                                    if (mysqli_num_rows($result_un) > 0)
                                    {
                                        $row_un = mysqli_fetch_array($result_un);
                                        $in_id = $row_un['institution_id'];
                                        $sqlSelect_u = "SELECT * FROM institution_admin where user_id = '$in_id'";                   
                                        $result_u = mysqli_query($conn, $sqlSelect_u);
                                        $u = mysqli_num_rows($result_u);
                                        if (mysqli_num_rows($result_u) > 0)
                                        {
                                            $row_u = mysqli_fetch_array($result_u);
                                            $name_Inst = $row_u['institution_name'];
                                        }
                                    } else {
                                       $name_Inst = 0; 
                                    }
                                }
                            ?>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Select Institution</label>
                                        <select name="institution_id" id="institution_id" class="form-control" required>
                                            <?php 
                                                //student login of account aready exists
                                                $checkAccounts = mysqli_query($conn, ("select * from institution_admin where user_id = '$in_id'"));
                                                $checkExistances = mysqli_num_rows($checkAccounts);
                                                if($checkExistances > 0){ 
                                                    $fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC);
                                                    $inst_ids = $fetchDetail_s['id'];
                                                    $inst_names = $fetchDetail_s['institution_name'];
                                                    echo '<option value="'.$inst_ids.'">'.$inst_names.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Enter Employment ID</label>
                                        <input name="employment_id" id="employment_id" type="text"
                                               class="form-control" 
                                               value="<?php echo $employments; ?>"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Field of Employment</label>
                                        <select name="field-employment" id="institution_id" class="form-control" required>
                                            <option value="General" id="basic-it">General</option>
                                            <option value="Basic-IT" id="basic-it">Basic IT</option>
                                            <option value="Programming" id="programming">Programming</option>
                                            <option value="Networking" id="networking">Networking</option>
                                            <option value="Data-Analysis-and-Database-Development" id="data-analysis">Data Analysis and Database Development</option>
                                            <option value="System-Analysis-and-Design" id="system-analysis">System Analysis and Design</option>
                                            <option value="System-and-Software-Maintenance" id="system-maintenance">System and Software Maintenance</option>
                                            <option value="Application-Design" id="programming">Application Design</option>
                                            <option value="Application-Development" id="programming">Application Development</option>
                                        </select> 
                                    </div>
                                    <div class="Programming box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <select name="programming-language" id="institution_id" class="form-control" required>
                                            <option value="programming">Select Programming Language</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkprogramming_languages = mysqli_query($conn, ("select * from programming_languages"));
                                                $checkExistancesprogramming_languages = mysqli_num_rows($checkprogramming_languages);
                                                if($checkExistancesprogramming_languages > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkprogramming_languages, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['name'];
                                                        echo '<option value="'.$inst_name.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                            <option value="other" id="other">Other</option>
                                        </select> 
                                    </div>
                                    <!-- design -->
                                    <div class="Application-Design box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <select name="programming-language-d" id="institution_id" class="form-control" required>
                                            <option value="application-design">Select Programming Language</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkprogramming_languages_d = mysqli_query($conn, ("select * from programming_languages"));
                                                $checkExistancesprogramming_languages_d = mysqli_num_rows($checkprogramming_languages_d);
                                                if($checkExistancesprogramming_languages_d > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkprogramming_languages_d, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['name'];
                                                        echo '<option value="'.$inst_name.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                            <option value="other" id="other">Other</option>
                                        </select> 
                                    </div>
                                    <!-- development -->
                                    <div class="Application-Development box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <select name="programming-language-a" id="institution_id" class="form-control" required>
                                            <option value="application-development">Select Programming Language</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkprogramming_languages_ = mysqli_query($conn, ("select * from programming_languages"));
                                                $checkExistancesprogramming_languages_ = mysqli_num_rows($checkprogramming_languages_);
                                                if($checkExistancesprogramming_languages_ > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkprogramming_languages_, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['name'];
                                                        echo '<option value="'.$inst_name.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                            <option value="other" id="other">Other</option>
                                        </select> 
                                    </div>
                                    <!-- development -->
                                    <div class="other box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <input name="programming-language-other" id="employment_id" type="text" 
                                               class="form-control" 
                                               placeholder="Enter Programming Languag"
                                               style="text-transform:uppercase" > 
                                    </div>
                                    <script src="css/jquery-1.12.4.min.js"></script>
                                    <script>
                                        $(document).ready(function(){
                                            $("select").change(function(){
                                                $(this).find("option:selected").each(function(){
                                                    var optionValue = $(this).attr("value");
                                                    if(optionValue){
                                                        $(".box").not("." + optionValue).hide();
                                                        $("." + optionValue).show();
                                                    } else{
                                                        $(".box").hide();
                                                    }
                                                });
                                            }).change();
                                        });
                                    </script>
                                </div>
                                <div class="col-md-6">   
                                    <div class="position-relative form-group">
                                        <label for="Upload Files" class="">Feedback Comment</label>
                                        <textarea name="comment" id="comment" class="form-control" required></textarea>  
                                    </div>
                                </div>
                            </div> 
                            <?php
                                } else {
                            ?>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Select Institution</label>
                                        <select name="institution_id" id="institution_id" class="form-control" required>
                                            <option>Select Institution</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkAccounts = mysqli_query($conn, ("select * from institution_admin"));
                                                $checkExistances = mysqli_num_rows($checkAccounts);
                                                if($checkExistances > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC)){ 
                                                        $inst_ids = $fetchDetail_s['id'];
                                                        $inst_names = $fetchDetail_s['institution_name'];
                                                        echo '<option value="'.$inst_ids.'">'.$inst_names.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Enter Employment ID</label>
                                        <input name="employment_id" id="employment_id" type="text"
                                               class="form-control" 
                                               placeholder="Optional"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Field of Employment</label>
                                        <select name="field-employment" id="institution_id" class="form-control" required>
                                            <option value="General" id="basic-it">General</option>
                                            <option value="Basic-IT" id="basic-it">Basic IT</option>
                                            <option value="Programming" id="programming">Programming</option>
                                            <option value="Networking" id="networking">Networking</option>
                                            <option value="Data-Analysis-and-Database-Development" id="data-analysis">Data Analysis and Database Development</option>
                                            <option value="System-Analysis-and-Design" id="system-analysis">System Analysis and Design</option>
                                            <option value="System-and-Software-Maintenance" id="system-maintenance">System and Software Maintenance</option>
                                            <option value="Application-Design" id="programming">Application Design</option>
                                            <option value="Application-Development" id="programming">Application Development</option>
                                        </select> 
                                    </div>
                                    <div class="Programming box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <select name="programming-language" id="institution_id" class="form-control" required>
                                            <option value="programming">Select Programming Language</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkprogramming_languages = mysqli_query($conn, ("select * from programming_languages"));
                                                $checkExistancesprogramming_languages = mysqli_num_rows($checkprogramming_languages);
                                                if($checkExistancesprogramming_languages > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkprogramming_languages, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['name'];
                                                        echo '<option value="'.$inst_name.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                            <option value="other" id="other">Other</option>
                                        </select> 
                                    </div>
                                    <!-- design -->
                                    <div class="Application-Design box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <select name="programming-language-d" id="institution_id" class="form-control" required>
                                            <option value="application-design">Select Programming Language</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkprogramming_languages_d = mysqli_query($conn, ("select * from programming_languages"));
                                                $checkExistancesprogramming_languages_d = mysqli_num_rows($checkprogramming_languages_d);
                                                if($checkExistancesprogramming_languages_d > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkprogramming_languages_d, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['name'];
                                                        echo '<option value="'.$inst_name.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                            <option value="other" id="other">Other</option>
                                        </select> 
                                    </div>
                                    <!-- development -->
                                    <div class="Application-Development box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <select name="programming-language-a" id="institution_id" class="form-control" required>
                                            <option value="application-development">Select Programming Language</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkprogramming_languages_ = mysqli_query($conn, ("select * from programming_languages"));
                                                $checkExistancesprogramming_languages_ = mysqli_num_rows($checkprogramming_languages_);
                                                if($checkExistancesprogramming_languages_ > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkprogramming_languages_, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['id'];
                                                        $inst_name = $fetchDetail_s['name'];
                                                        echo '<option value="'.$inst_name.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                            <option value="other" id="other">Other</option>
                                        </select> 
                                    </div>
                                    <!-- development -->
                                    <div class="other box position-relative form-group">
                                        <label for="Skill name" class="">Programming Language</label>
                                        <input name="programming-language-other" id="employment_id" type="text" 
                                               class="form-control" 
                                               placeholder="Enter Programming Languag"
                                               style="text-transform:uppercase" > 
                                    </div>
                                    <script src="css/jquery-1.12.4.min.js"></script>
                                    <script>
                                        $(document).ready(function(){
                                            $("select").change(function(){
                                                $(this).find("option:selected").each(function(){
                                                    var optionValue = $(this).attr("value");
                                                    if(optionValue){
                                                        $(".box").not("." + optionValue).hide();
                                                        $("." + optionValue).show();
                                                    } else{
                                                        $(".box").hide();
                                                    }
                                                });
                                            }).change();
                                        });
                                    </script>
                                </div>
                                <div class="col-md-6">   
                                    <div class="position-relative form-group">
                                        <label for="Upload Files" class="">Feedback Comment</label>
                                        <textarea name="comment" id="comment" class="form-control" required></textarea>  
                                    </div>
                                </div>
                            </div>
                            <?php  
                            }
                            ?>
                            <input name="user_id" id="user_id" type="hidden"
                                   class="form-control" 
                                   value="<?php echo $user_id; ?>"> 
                            <button class="mt-2 btn btn-primary" name="btn-upload" 
                                    type="submit" id="btn-upload">Give feedback</button>
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
                $employment_s = '';
                if (isset($_POST['employment_id'])){                        
                    $employment_s = filter_input(INPUT_POST, 'employment_id');
                    //get number of confirmed students accounts                  
                    $sqlSelect_uncofirmed = "SELECT * FROM employement where employement_id = '$employment_s' and employer_id = '$user_id'";                   
                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                    $unconfirmed = mysqli_num_rows($result_uncofirmed);
                    if (mysqli_num_rows($result_uncofirmed) > 0)
                        {   
                    ?>
                    <div class="card-header">
                        Employees
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="give_feedback.php?result" method="post">
                                    <input type="text" name="employment_id" id="employment_id" 
                                           class="my-form" placeholder="Employment ID" />
                                    <button class="active btn btn-focus">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Employment ID</th>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Date Created</th>
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
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    }
                } else {
                    //get number of confirmed students accounts                  
                    $sqlSelect_uncofirmed = "SELECT * FROM employement where employer_id = '$user_id' and account_con = 1";                   
                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                    $unconfirmed = mysqli_num_rows($result_uncofirmed);
                    if (mysqli_num_rows($result_uncofirmed) > 0)
                        {   
                    ?>
                    <div class="card-header">
                        Employees
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="give_feedback.php?result" method="post">
                                    <input type="text" name="employment_id" id="employment_id" 
                                           class="my-form" placeholder="Employment ID" />
                                    <button class="active btn btn-focus">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Employment ID</th>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Date Created</th>
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
                                        <form action="give_feedback.php?result=Give Feedback on your Employee" method="post" >
                                            <input name="employment_feedback" id="employment_id" value="<?php echo $employment_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Give Feedback
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
                }
                ?>                    
                </div>
            </div>
        </div>
        <!--end-->
    </div> 
<?php
    include_once('footer.php');