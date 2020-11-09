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
                        <i class="fa fa-database icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Skill Scouting 
                    </div>
                </div>    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                <?php 
                $intitutions = '';
                if (isset($_POST['intitutions'])){                        
                    $intitutions = filter_input(INPUT_POST, 'intitutions');
                    //get number of confirmed students accounts                  
                    $sqlSelect_uncofirmed = "SELECT * FROM institution_admin where institution_name Like '%$intitutions%'";                   
                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                    $unconfirmed = mysqli_num_rows($result_uncofirmed);
                    if (mysqli_num_rows($result_uncofirmed) > 0)
                        {   
                    ?>
                    <div class="card-header">
                        Institutions
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="scout-skill-student.php?result" method="post">
                                    <input type="text" name="intitutions" id="employment_id" 
                                           class="my-form" placeholder="Institution" />
                                    <button class="active btn btn-focus">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Emblem</th>
                                    <th class="text-center">Institution Name</th>
                                    <th class="text-center">Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     while ($row = mysqli_fetch_array($result_uncofirmed)){
                                             $name_ = $row['institution_name'];
                                             $logo_ = $row['logo']; 
                                             $created_ = $row['created'];
                                             $id_ = $row['user_id'];
                                 ?>
                                <tr>
                                    <td class="text-center text-muted"><img width="42" class="rounded-circle" src="../api_controller/<?php echo $logo_; ?>" alt=""></td>
                                    <td class="text-center text-muted">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $name_; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted"><?php echo $created_; ?></td>
                                    <td class="text-center text-muted">
                                        <form action="scout-skill-student.php?result=" method="post" >
                                            <input name="inst_grads" id="employment_id" value="<?php echo $id_; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Scout
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
                    $sqlSelect_uncofirmed = "SELECT * FROM institution_admin LIMIT 3";                   
                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                    $unconfirmed = mysqli_num_rows($result_uncofirmed);
                    if (mysqli_num_rows($result_uncofirmed) > 0)
                        {   
                    ?>
                    <div class="card-header">
                        Institutions
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="scout-skill-student.php?result" method="post">
                                    <input type="text" name="intitutions" id="employment_id" 
                                           class="my-form" placeholder="Institution" />
                                    <button class="active btn btn-focus">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Emblem</th>
                                    <th class="text-center">Institution Name</th>
                                    <th class="text-center">Date Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     while ($row = mysqli_fetch_array($result_uncofirmed)){
                                             $name_ = $row['institution_name'];
                                             $logo_ = $row['logo']; 
                                             $created_ = $row['created'];
                                             $id_ = $row['user_id'];
                                 ?>
                                <tr>
                                    <td class="text-center text-muted"><img width="42" class="rounded-circle" src="../api_controller/<?php echo $logo_; ?>" alt=""></td>
                                    <td class="text-center text-muted">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $name_; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted"><?php echo $created_; ?></td>
                                    <td class="text-center text-muted">
                                        <form action="scout-skill-student.php?result=" method="post" >
                                            <input name="inst_grads" id="employment_id" value="<?php echo $id_; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Scout
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <h5 class="card-title">Live Standing of scouting</h5>
                    <table class="mb-0 table table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Student Name</th>
                                <th>coalification rating</th>
                                <th>Institution</th> 
                                <th>Support Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $inst_grads = '';
                        if (isset($_POST['inst_grads'])){                        
                            $inst_grads = filter_input(INPUT_POST, 'inst_grads');
                            //get number of confirmed students accounts                  
                            $sqlSelect_uncofirmed = "SELECT * FROM skill where user_id = 0 and employer_id = '$user_id' ";                   
                            $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                            $unconfirmed = mysqli_num_rows($result_uncofirmed);
                            if (mysqli_num_rows($result_uncofirmed) > 0)
                                {
                                $sk = 0;
                                while ($row = mysqli_fetch_array($result_uncofirmed)){
                                       $name_skil = $row['Name'];
                                       $sk++;
                                       ?>
                                            <tr><td><?php echo $sk; ?></td><td>Skill Name: <?php echo $name_skil; ?></td><td></td><td></td><td></td><td></td><td></td></tr>
                                        <?php
                                       $sqlSelect_u = "SELECT * FROM skill where Name = '$name_skil' and employer_id != '$user_id' and institution_admin_id = '$inst_grads'  and scouted = 0 order by rating DESC";                   
                                       $result_u = mysqli_query($conn, $sqlSelect_u); 
                                       $u = mysqli_num_rows($result_u);
                                       if (mysqli_num_rows($result_u) > 0){ 
                                        while ($row_ = mysqli_fetch_array($result_u)){
                                               $scout_grad = $row_['user_id'];                                                       
                                               $skill_scouted = $row_['scouted']; 
                                               $scout_id = $row_['skill_id'];
                                               $scout_skill = $row_['Name'];
                                               $skill_status = $row_['rating'];
                                               $scout_path = $row_['doc_path'];
                                               $sqlSelect_n = "SELECT * FROM user where user_id = '$scout_grad'";                   
                                               $result_n = mysqli_query($conn, $sqlSelect_n);
                                               $row_n = mysqli_fetch_array($result_n);
                                               $scout_fname = $row_n['first_name'];
                                               $scout_lname = $row_n['last_name'];  
                                               $sqlSelect_logo = "SELECT * FROM student where user_id = '$scout_grad'";                   
                                               $result_logo = mysqli_query($conn, $sqlSelect_logo);
                                               if (mysqli_num_rows($result_logo) > 0){
                                                    $row_logo = mysqli_fetch_array($result_logo);
                                                    $scout_logo = $row_logo['profile_pic']; 
                                                    $scout_logo_grad_id = $row_logo['student_number'];
                                                    $scout_ins_id = $row_logo['institution_id']; 
                                                    if($scout_logo == null){ $img = 'css/assets/images/avatar.svg'; } 
                                                    else { $img = '../api_controller/'.$scout_logo;}
                                                    //get number of confirmed students accounts                  
                                                    $sql_i = "SELECT * FROM institution_admin where user_id = '$scout_ins_id'";                   
                                                    $result_in = mysqli_query($conn, $sql_i);
                                                    $row_i = mysqli_fetch_array($result_in);
                                                    $scout_ins_name = $row_i['institution_name']; 
                                                    $scout_ins_user = $row_i['user_id']; 
                                                    $scout_ins_user_id = $row_i['id']; 
                                               
                        ?>
                            <tr>
                                <th scope="row">1</th>
                                <td><img width="42" class="rounded-circle" src="<?php echo $img; ?>" alt=""></td>
                                <td>Mr. / Miss. <?php //echo $scout_fname; ?> <?php echo $scout_lname; ?></td>
                                <td>
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
                                <td><?php echo $scout_ins_name; ?></td>
                                <td>
                                    <a href="../api_controller/<?php echo $scout_path; ?>" target="_blank">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">
                                            Download
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form action="../api_controller/employ-skill.php" method="post" >
                                        <input name="scout_id" id="id" value="<?php echo $scout_id; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="user_id" id="id" value="<?php echo $scout_grad; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="scout_ins_user" id="id" value="<?php echo $scout_ins_user; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="scout_ins_user_id" id="id" value="<?php echo $scout_ins_user_id; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="scout_logo_grad_id" id="id" value="<?php echo $scout_logo_grad_id; ?>" 
                                               type="hidden" class="form-control">
                                        <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="employ-student">
                                            Employ
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php 
                                               }else {
                                                
                                            } }}} }
                            } else {
                                    $sqlSelect_uncofirmed = "SELECT * FROM skill where user_id = 0 and employer_id = '$user_id'";                   
                                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                    $unconfirmed = mysqli_num_rows($result_uncofirmed);
                                    if (mysqli_num_rows($result_uncofirmed) > 0)
                                        { 
                                            $sk = 0;
                                            while ($row = mysqli_fetch_array($result_uncofirmed)){
                                               $name_skil = $row['Name'];
                                               $sk++;
                                               ?>
                                                 <tr><td><?php echo $sk; ?></td><td>Skill Name: <?php echo $name_skil; ?></td><td></td><td></td><td></td><td></td><td></td></tr>
                                               <?php
                                               $sqlSelect_u = "SELECT * FROM skill where Name = '$name_skil' and user_id != 0 and scouted = 0 order by rating DESC";                   
                                               $result_u = mysqli_query($conn, $sqlSelect_u); 
                                               $u = mysqli_num_rows($result_u);
                                               if (mysqli_num_rows($result_u) > 0){ 
                                                while ($row_ = mysqli_fetch_array($result_u)){
                                                       $scout_grad = $row_['user_id'];                                                       
                                                       $skill_scouted = $row_['scouted'];
                                                       $scout_id = $row_['skill_id'];
                                                       $scout_skill = $row_['Name'];
                                                       $skill_status = $row_['rating'];
                                                       $scout_path = $row_['doc_path'];
                                                       $sqlSelect_n = "SELECT * FROM user where user_id = '$scout_grad'";                   
                                                       $result_n = mysqli_query($conn, $sqlSelect_n);
                                                       $row_n = mysqli_fetch_array($result_n);
                                                       $scout_fname = $row_n['first_name'];
                                                       $scout_lname = $row_n['last_name'];
                                                       $sqlSelect_logo = "SELECT * FROM student where user_id = '$scout_grad'";                   
                                                       $result_logo = mysqli_query($conn, $sqlSelect_logo);
                                                       if (mysqli_num_rows($result_logo) > 0){
                                                            $row_logo = mysqli_fetch_array($result_logo);
                                                            $scout_logo = $row_logo['profile_pic']; 
                                                            $scout_logo_grad_id = $row_logo['student_number'];
                                                            $scout_ins_id = $row_logo['institution_id']; 
                                                            if($scout_logo == null){ $img = 'css/assets/images/avatar.svg'; } 
                                                            else { $img = '../api_controller/'.$scout_logo;}
                                                            //get number of confirmed students accounts                  
                                                            $sql_i = "SELECT * FROM institution_admin where user_id = '$scout_ins_id'";                   
                                                            $result_in = mysqli_query($conn, $sql_i);
                                                            $row_i = mysqli_fetch_array($result_in);
                                                            $scout_ins_name = $row_i['institution_name']; 
                                                            $scout_ins_user = $row_i['user_id']; 
                                                            $scout_ins_user_id = $row_i['id'];  
                            ?>
                            <tr>
                                <th scope="row">1</th>
                                <td><img width="42" class="rounded-circle" src="<?php echo $img; ?>" alt=""></td>
                                <td>Mr. / Miss. <?php //echo $scout_fname; ?> <?php echo $scout_lname; ?></td>
                                <td>
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
                                <td><?php echo $scout_ins_name; ?></td>
                                <td>
                                    <a href="../api_controller/<?php echo $scout_path; ?>" target="_blank">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">
                                            Download
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form action="../api_controller/employ-skill.php" method="post" >
                                        <input name="scout_id" id="id" value="<?php echo $scout_id; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="user_id" id="id" value="<?php echo $scout_grad; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="scout_ins_user" id="id" value="<?php echo $scout_ins_user; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="scout_ins_user_id" id="id" value="<?php echo $scout_ins_user_id; ?>" 
                                               type="hidden" class="form-control">
                                        <input name="scout_logo_grad_id" id="id" value="<?php echo $scout_logo_grad_id; ?>" 
                                               type="hidden" class="form-control">
                                        <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="employ-student">
                                            Employ
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php   
                                                
                                            } else {
                                                
                                            } }
                                        }
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
<?php
    include_once('footer.php');