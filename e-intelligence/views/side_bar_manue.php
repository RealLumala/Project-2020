<div class="app-main">
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>    
        <div class="scrollbar-sidebar" style="padding-top: 20px;">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li>
                        <a href="dashboard.php?result=">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Management</li>
                    <?php 
                        if($account_type == 'registrar'){
                            
                        }else { 
                    ?>
                    <?php 
                        if($account_type != 'employer'){
                            
                        }else { 
                    ?>
                    <li>
                        <a href="give_feedback.php?result=">
                            <i class="metismenu-icon pe-7s-science">
                            </i>Give Feed Back
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="creating-skill.php">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Create Skill
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="profile.php">
                            <i class="metismenu-icon pe-7s-diamond"></i>
                            Manage Profile  
                        </a>                        
                    </li>
                    <?php 
                        if($account_type != 'employer'){
                            
                        }else { 
                    ?>
                    <li>
                        <a href="confirm-employee.php?result=">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Manage Employee
                        </a>
                    </li>
                    <?php } ?>
                    <?php 
                        if($account_type != 'graduate'){
                            
                        }else { 
                    ?>
                    <li>
                        <a href="employment.php">
                           <i class="metismenu-icon pe-7s-note2"></i>
                            Employment
                        </a>
                    </li>
                    <?php } ?>
                    <?php 
                        if($account_type != 'registrar'){
                            
                        }else { 
                    ?>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-world"></i>
                            Institution Management
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="upload-curriculum.php">
                                    <i class="metismenu-icon">
                                    </i>Create Curriculum
                                </a>
                            </li>
                            <li>
                                <a href="upload_student_list.php?result">
                                    <i class="metismenu-icon">
                                    </i>Upload Student List
                                </a>
                            </li>
                            <li>
                                <a href="upload_graduate_list.php?result">
                                    <i class="metismenu-icon">
                                    </i>Upload Graduate List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="curriculum_review.php?result=">
                            <i class="metismenu-icon pe-7s-science"></i>
                            Curriculum Review
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="curriculums.php">
                            <i class="metismenu-icon pe-7s-note2"></i>
                            Curriculums 
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div> 