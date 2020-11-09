<?php
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include_once('header.php');
    include_once('side_bar_manue.php');
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-satellite icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Employment
                    </div>
                </div>    
            </div>
        </div>
        <!-- begin -->
        <div clas="row">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Add Employment Details</h5>
                        <form action="../api_controller/create_work_profile.php" method="post"
                              name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Employer Name" class="">Employer Name</label>
                                        <select name="name" id="name" class="form-control">
                                            <option>Select Company</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkAccounts = mysqli_query($conn, ("select * from employer"));
                                                $checkExistances = mysqli_num_rows($checkAccounts);
                                                if($checkExistances > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['user_id'];
                                                        $inst_name = $fetchDetail_s['company_name'];
                                                        echo '<option value="'.$inst_id.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="employment-id" class="">Employment ID</label>
                                <input name="employment-id" id="employment-id" 
                                       placeholder="employment-id" type="text" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="employment-id" class="">Graduation year</label>
                                        <input name="year" id="year" 
                                            placeholder="Graduation year" type="number" 
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-2 btn btn-primary" name="btn-upload" type="submit" id="btn-upload">
                                Add Work Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Your Employment Standings
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
                                    <th class="text-center">Employment Id</th>
                                    <th>Company Name</th>
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Employment Status</th>
                                    <th class="text-center">Employment Account Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <?php
                            //get number of confirmed students accounts                  
                            $sqlSelect_uncofirmed = "SELECT * FROM employement where graduate_id = '$user_id'";                   
                            $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                            $unconfirmed = mysqli_num_rows($result_uncofirmed);
                            if (mysqli_num_rows($result_uncofirmed) > 0)
                            {
                            ?>
                            <tbody>
                                <?php 
                                    while ($row = mysqli_fetch_array($result_uncofirmed)){
                                        
                                            $employment_id = $row['employement_id'];
                                            $employer_id = $row['employer_id'];
                                            $status = $row['stetus'];
                                            $date_created = $row['date_created'];
                                            $account_con = $row['account_con'];                                            
                                            //employement status
                                            if($status == 1){
                                                $st = '<div class="badge badge-info">Employed</div>';
                                            } else if ($account_con == 2){
                                                $st = '<div class="badge badge-danger">Probation</div>'; 
                                            }else{
                                                $st = '<div class="badge badge-warning">Unemployed</div>'; 
                                            }
                                            $sqlSelect_uncofirmed = "SELECT * FROM employer where user_id = '$employer_id'";                   
                                            $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                            $row_ = mysqli_fetch_array($result_uncofirmed);
                                            $company_name = $row_['company_name'];
                                            $personnel_id = $row_['user_id'];
                                            //employement account status
                                            if($account_con == 0){
                                                
                                                $account = 'Activation Needed'; 
                                                $account_v = '<div class="badge badge-warning">Pending Verification</div>';
                                                $personnel_name = '';
                                                
                                            } else {
                                                
                                                $account = 'Activated'; 
                                                $account_v = '<div class="badge badge-success">Verified</div>';
                                                //personnel details
                                                $sqlSelect_personnel = "SELECT * FROM user where user_id = '$personnel_id'";                   
                                                $result_personnel = mysqli_query($conn, $sqlSelect_personnel);
                                                $row_personnel = mysqli_fetch_array($result_personnel);
                                                $personnel_name = 'Contact Personnel: Mr/Miss. '.$row_personnel['first_name'].'  '.$row_personnel['last_name'];
                                            }
                                            
                                            
                                ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo 'ID: '.$employment_id; ?></td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $company_name; ?></div>
                                                    <div class="widget-subheading opacity-7"><?php echo $personnel_name; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $date_created; ?></td>
                                    <td class="text-center">
                                        <?php echo $st; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $account_v; ?>
                                    </td>
                                    <td class="text-center">
                                        <form action="../api_controller/create_work_profile.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $employment_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end-->
    </div> 
<?php
    include_once('footer.php');