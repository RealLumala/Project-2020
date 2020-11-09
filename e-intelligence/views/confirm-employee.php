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
                        Confirm Employee 
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin -->
        <div clas="row">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Upload Employee List Par Institution</h5>
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
                                        <label for="Upload Files" class="">Upload Employee List</label>
                                        <input name="file" id="files" type="file" multiple="" class="form-control-file" required>
                                        <small class="form-text text-muted">
                                            Upload Employee List
                                        </small>
                                    </div>
                                </div>
                            </div>                            
                            <button class="mt-2 btn btn-primary" name="import" 
                                    type="submit" id="btn-upload">Upload Employee List</button>
                        </form>
                        <h6>NB: File Format Excel With the following Layout.</h6>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover bg-mean-fruit">
                            <thead>
                                <tr>
                                    <th class="text-center">Employment Id</th>
                                    <th>Institution graduate Registration Number</th>
                                </tr>
                            </thead>
                        </table> 
                        <?php
                            if($_GET["result"] === null){
                                $result_feedback = "Load graduate list";
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
                        $sqlSelect_uncofirmed = "SELECT * FROM employment_list where employment_id = '$employment_s' and employer_id = '$user_id'";                   
                        $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                        $unconfirmed = mysqli_num_rows($result_uncofirmed);
                        if (mysqli_num_rows($result_uncofirmed) > 0)
                        {   
                    ?>  
                    <div class="card-header">
                        confirmed Employees
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="confirm-employee.php?result" method="post">
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
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Institution</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     while ($row = mysqli_fetch_array($result_uncofirmed)){
                                            $cul_id = $row['id'];
                                            $employment_id = $row['employment_id'];
                                            $institution_id = $row['institution_id']; 
                                            //get number of confirmed students accounts                  
                                            $sqlSelect_uncofirmed = "SELECT * FROM employement where "
                                                    . "employement_id = '$employment_id' "
                                                    . "and employer_id = '$user_id'";                   
                                            $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                            $unconfirmed = mysqli_num_rows($result_uncofirmed);
                                            if (mysqli_num_rows($result_uncofirmed) > 0)
                                            {
                                                $row_ = mysqli_fetch_array($result_uncofirmed);
                                                $account_con = $row_['account_con'];
                                                 //employement account status
                                                 if($account_con == 0){ 
                                                    $account_v = '<td class="text-center text-muted">
                                                        <form action="../api_controller/upload_employee_list.php" method="post" >
                                                            <input name="employment_id" id="employment_id" value="'.$employment_id.'" 
                                                             type="hidden" class="form-control">
                                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="employ">
                                                                Employ
                                                            </button> 
                                                        </form>
                                                    </td>';
                                                 } else {
                                                    $account_v = '<td class="text-center text-muted">
                                                        <form action="../api_controller/upload_employee_list.php" method="post" >
                                                            <input name="employment_id" id="employment_id" value="'.$employment_id.'" 
                                                             type="hidden" class="form-control">
                                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="dismiss">
                                                                Dismiss
                                                            </button> 
                                                        </form>
                                                    </td>';
                                                 }
                                            } else {
                                                $account_v = '<td class="text-center text-muted">
                                                        Has No User Account on This Platform
                                                    </td>';   
                                            }
                                 ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $employment_id; ?></td>
                                    <td class="text-center text-muted"><?php echo $row['created']; ?></td>
                                    <td class="text-center text-muted">
                                        <?php 
                                            $checkAccounts = mysqli_query($conn, ("select * from institution_admin where id='$institution_id'"));
                                            $checkExistances = mysqli_num_rows($checkAccounts);
                                            $fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC);
                                            echo $fetchDetail_s['institution_name']; 
                                        ?>
                                    </td>
                                    <?php echo $account_v; ?>
                                    <td class="text-center text-muted">
                                        <form action="../api_controller/upload_employee_list.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $cul_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <input name="employment_id" id="employment_id" value="<?php echo $employment_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Delete
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
                } else {
                        //get number of confirmed students accounts                  
                        $sqlSelect_un = "SELECT * FROM employment_list where employer_id = '$user_id' order by id DESC LIMIT 10";                   
                        $result_un = mysqli_query($conn, $sqlSelect_un);
                        $un = mysqli_num_rows($result_un);
                        if (mysqli_num_rows($result_un) > 0)
                        {   
                    ?>  
                    <div class="card-header">
                        confirmed Employees
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="confirm-employee.php?result" method="post">
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
                                    <th class="text-center">Date Created</th>
                                    <th class="text-center">Institution</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     while ($row = mysqli_fetch_array($result_un)){
                                            $cul_id = $row['id'];
                                            $employment_id = $row['employment_id'];
                                            $institution_id = $row['institution_id'];
                                            //get number of confirmed students accounts                  
                                            $sqlSelect_c = "SELECT * FROM employement where "
                                                    . "employement_id = '$employment_id' "
                                                    . "and employer_id = '$user_id'";                   
                                            $result_c = mysqli_query($conn, $sqlSelect_c);
                                            $c = mysqli_num_rows($result_c);
                                            if (mysqli_num_rows($result_c) > 0)
                                            {
                                                $row_ = mysqli_fetch_array($result_c);
                                                $account_con = $row_['account_con'];
                                                 //employement account status
                                                 if($account_con == 0){ 
                                                    $account_v = '<td class="text-center text-muted">
                                                        <form action="../api_controller/upload_employee_list.php" method="post" >
                                                            <input name="employment_id" id="employment_id" value="'.$employment_id.'" 
                                                             type="hidden" class="form-control">
                                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="employ">
                                                                Employ
                                                            </button> 
                                                        </form>
                                                    </td>';
                                                 } else {
                                                    $account_v = '<td class="text-center text-muted">
                                                        <form action="../api_controller/upload_employee_list.php" method="post" >
                                                            <input name="employment_id" id="employment_id" value="'.$employment_id.'" 
                                                             type="hidden" class="form-control">
                                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="dismiss">
                                                                Dismiss
                                                            </button> 
                                                        </form>
                                                    </td>';
                                                 }
                                            } else {
                                                $account_v = '<td class="text-center text-muted">
                                                        Has No User Account on This Platform
                                                    </td>';   
                                            }
                                 ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $employment_id; ?></td>
                                    <td class="text-center text-muted"><?php echo $row['created']; ?></td>
                                    <td class="text-center text-muted">
                                        <?php 
                                            $checkAccounts = mysqli_query($conn, ("select * from institution_admin where id='$institution_id'"));
                                            $checkExistances = mysqli_num_rows($checkAccounts);
                                            $fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC);
                                            echo $fetchDetail_s['institution_name']; 
                                        ?>
                                    </td>
                                    <?php echo $account_v; ?>
                                    <td class="text-center text-muted">
                                        <form action="../api_controller/upload_employee_list.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $cul_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <input name="employment_id" id="employment_id" value="<?php echo $employment_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Delete
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