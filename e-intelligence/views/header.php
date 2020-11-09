<?php 
    include_once('../api_controller/session_manager.php'); 
    include_once('../api_controller/count_dataBadse.php'); 
?>
<!doctype html>
<html lang="en">
    <head>
    <?php
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include_once('style.php');
    ?>
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-header header-shadow">
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
                <div class="app-header__content">
                    <div class="app-header-left">
                        <ul class="header-menu nav">
                            <li class="nav-item">
                                <a href="institution_ranking.php" class="nav-link">
                                    <i class="nav-link-icon fa fa-university"> </i>
                                    Institution Ranking 
                                </a>
                            </li>
                            <?php 
                                if($account_type == 'registrar'){
                                    
                                }else { 
                                if($account_type == 'employer'){
                            ?>
                            <li class="dropdown nav-item">
                                <button type="button" aria-haspopup="true" 
                                        aria-expanded="false" data-toggle="dropdown" 
                                        class="nav-link dropdown-toggle btn btn-link">
                                    <i class="nav-link-icon fa fa-archive"></i>
                                    Applications
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <a href="pending-applications.php" class="nav-link">
                                            <i class="nav-link-icon fa fa-graduation-cap"></i>
                                            Graduates
                                        </a>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <a href="students_scouted.php" class="nav-link">
                                            <i class="nav-link-icon fa fa-archive"></i>
                                            Students Pending Approval
                                        </a>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <a href="student-approved.php" class="nav-link">
                                            <i class="nav-link-icon fa fa-archive"></i>
                                            Students Approved
                                        </a>
                                    </button>
                                </div>
                            </li>
                            <li class="dropdown nav-item">
                                <button type="button" aria-haspopup="true" 
                                        aria-expanded="false" data-toggle="dropdown" 
                                        class="nav-link dropdown-toggle btn btn-link">
                                    <i class="nav-link-icon fa fa-graduation-cap"></i>
                                    Scout Skill
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <a href="scout-skill.php" class="nav-link">
                                            <i class="nav-link-icon fa fa-graduation-cap"></i>
                                            Graduates
                                        </a>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <a href="scout-skill-student.php" class="nav-link">
                                            <i class="nav-link-icon fa fa-archive"></i>
                                            Students
                                        </a>
                                    </button>
                                </div>
                            </li>
                            <?php
                                   
                                }else if($account_type == 'graduate'){
                            ?>
                            <li class="dropdown nav-item">
                                <a href="job-scouted.php" class="nav-link">
                                    <i class="nav-link-icon fa fa-briefcase"></i>
                                    Skills Pending Approval
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="job-scouting.php" class="nav-link">
                                    <i class="nav-link-icon fa fa-briefcase"></i>
                                    Job Scouting 
                                </a>
                            </li>
                            <?php } else {
                            ?>
                            <li class="dropdown nav-item">
                                <a href="student-approvals.php" class="nav-link">
                                    <i class="nav-link-icon fa fa-briefcase"></i>
                                    Scouted Approvals
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="approved-student-skills.php" class="nav-link">
                                    <i class="nav-link-icon fa fa-briefcase"></i>
                                    Approved Skills
                                </a>
                            </li>
                            <?php }
                            } ?>
                        </ul>        
                    </div>
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <?php if($logo == null){ $img = 'css/assets/images/avatar.svg'; } else { $img = '../api_controller/'.$logo; } ?>
                                                <img width="42" height="42" class="rounded-circle" src="<?php echo $img; ?>" alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <button type="button" tabindex="0" class="dropdown-item">
                                                    <?php if($logo == null){ $img = 'css/assets/images/avatar.svg'; } 
                                                    else { $img = '../api_controller/'.$logo; } ?>
                                                    <img width="42" height="42" class="rounded-circle" src="<?php echo $img; ?>" alt=""></button>                                                
                                                <button type="button" tabindex="0" class="dropdown-item"><?php echo "Mr / Miss. ".$last_name." ".$first_name; ?></button>
                                                <button type="button" tabindex="0" class="dropdown-item"><?php echo "Email: ".$email; ?></button>
                                                <button type="button" tabindex="0" class="dropdown-item"><?php echo "Contact: ".$number; ?></button>
                                                <button type="button" tabindex="0" class="dropdown-item"><?php echo "Institution: ".$institution_name; ?></button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <a href="./logout.php"><button type="button" tabindex="0" class="dropdown-item">Logout</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">
                                            <?php echo "User: ".$username; ?>
                                        </div>
                                    </div>
                                    <div class="widget-content-right header-user-info ml-3">
                                        <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                            <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>        
            
