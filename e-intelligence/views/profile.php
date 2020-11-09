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
                        Profile Management 
                    </div>
                </div>                   
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Edit Profile</h5>
                        <form action="../api_controller/update_profile.php" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">
                                            First Name
                                        </label>
                                        <input name="fname" id="fname"
                                              value="<?php echo $first_name; ?>" 
                                              type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                            Last Name
                                        </label>
                                        <input name="lname" id="lname"
                                               value="<?php echo $last_name; ?>"
                                               type="text"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">
                                            Email
                                        </label>
                                        <input name="email" id="email"
                                              value="<?php echo $email; ?>" 
                                              type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                            Phone Number
                                        </label>
                                        <input name="number" id="number"
                                               placeholder="<?php echo $number; ?>"
                                               type="tel"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">
                                            Username
                                        </label>
                                        <input name="username" id="username"
                                              value="<?php echo $username; ?>" 
                                              type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                            Password
                                        </label>
                                        <input name="password" id="Password"
                                               value="<?php echo $password; ?>"
                                               type="password"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                            Confirm Password
                                        </label>
                                        <input name="cpassword" id="cpassword"
                                               value="<?php echo $password; ?>"
                                               type="password"
                                               class="form-control">
                                    </div>
                                </div>
                                <?php if($account_type != 'employer'){ ?>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                           Institution Name
                                        </label>
                                        <input name="Iname" id="Iname"
                                               placeholder="<?php echo $institution_name; ?>"
                                               type="text"
                                               class="form-control" disabled="">
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                           Company Name
                                        </label>
                                        <input name="cname" id="cname"
                                               value="<?php echo $institution_name; ?>"
                                               type="text"
                                               class="form-control" >
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                             <?php if($account_type == 'student' || $account_type == 'graduate'){ ?>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">
                                            Registration Number
                                        </label>
                                        <input name="student_number" id="student_number"
                                              value="<?php echo $student_number; ?>" 
                                              type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <?php } ?>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">
                                           <?php if($account_type == 'student' || $account_type == 'graduate'){ ?> Profile Photo <?php } else { ?> Institution Logo <?php } ?>
                                        </label>
                                        <input type="file" name="file" id="file" >
                                    </div>
                                </div>
                            </div>
                            <button class="mt-2 btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    <?php
        include_once('footer.php');