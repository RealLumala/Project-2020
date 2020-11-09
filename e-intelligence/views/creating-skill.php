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
                        Skills
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin -->
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Available Skills</div>
                                <div class="widget-subheading">Total</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">
                                    <?php if($account_type != 'employer'){
                                        echo $number_of_skills;                                        
                                    }else {
                                        echo $number_of_eskills;  
                                    } ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <?php if($logo == null){ $img = 'css/assets/images/avatar.svg'; } else { $img = '../api_controller/'.$logo; } ?>
                                <img width="42" height="42" class="rounded-circle" src="<?php echo $img; ?>" alt="">
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning">Skills</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Perfected Skills</div>
                                <div class="widget-subheading"></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger">
                                    <?php if($account_type != 'employer'){
                                        echo $number_of_ps;
                                    }else {
                                        echo $number_of_pes;  
                                    } ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div clas="row">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Add Skill Details</h5>
                        <form action="../api_controller/create_skill.php" method="post"
                              name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Skill Name</label>
                                        <input name="skill-name" id="skill-name" placeholder="Skill name" 
                                               type="text" class="form-control">
                                    </div>
                                </div>
                                <?php if($account_type == 'employer'){?>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Select Institution of your Interest</label>
                                        <select name="selinsname" id="insname-id" class="form-control">
                                            <option>Select Open for a wider Mapping</option>
                                            <option value="0">Open</option>
                                            <?php 
                                                //student login of account aready exists
                                                $checkAccounts = mysqli_query($conn, ("select * from institution_admin"));
                                                $checkExistances = mysqli_num_rows($checkAccounts);
                                                if($checkExistances > 0){ 
                                                    while($fetchDetail_s = mysqli_fetch_array($checkAccounts, MYSQLI_ASSOC)){ 
                                                        $inst_id = $fetchDetail_s['user_id'];
                                                        $inst_name = $fetchDetail_s['institution_name'];
                                                        echo '<option value="'.$inst_id.'">'.$inst_name.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } else {
                                ?>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Select Institution of your Interest</label>
                                        <select name="selinsname" id="insname-id" class="form-control">
                                            <option>Select Open for a wider Mapping</option>
                                            <option value="0">Open</option>
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
                                <?php    
                                }?>
                                <div class="col-md-6">   
                                    <div class="position-relative form-group">
                                        <label for="Upload Files" class="">File</label>
                                        <input name="file" id="files" type="file" multiple="" class="form-control-file">
                                        <small class="form-text text-muted">
                                            Upload Required Skill Files.
                                        </small>
                                    </div>
                                </div>
                            </div>                            
                            <button class="mt-2 btn btn-primary" 
                                    name="btn-upload" type="submit" id="btn-upload">
                                Create Skill
                            </button>
                        </form>
                    </div>
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
                                    <th class="text-center">Actions</th>
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
                                    <td class="text-center">
                                        <form action="../api_controller/create_skill.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $skill_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="avreage">
                                                Averaged
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="../api_controller/create_skill.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $skill_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="perfected">
                                                Perfected
                                            </button> 
                                        </form>
                                    </td>                                            
                                    <td class="text-center">
                                        <form action="../api_controller/create_skill.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $skill_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                        $sqlSelect_uncofirmed = "SELECT * FROM skill where user_id = 0 and employer_id='$user_id' order by skill_id desc";                   
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
                                    <td class="text-center">
                                        <form action="../api_controller/create_skill.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $skill_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="avreage">
                                                Averaged
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="../api_controller/create_skill.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $skill_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="perfected">
                                                Perfected
                                            </button> 
                                        </form>
                                    </td>                                            
                                    <td class="text-center">
                                        <form action="../api_controller/create_skill.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $skill_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
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
        <!--end-->
    </div> 
<?php
    include_once('footer.php');