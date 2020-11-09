<?php
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include_once('./header.php');
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
                       Dashboard
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
                                <div class="widget-heading">Registered Institutions</div>
                                <div class="widget-subheading">Total</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success"><?php echo $number_of_isntitutions; ?></div>
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
                                <div class="widget-heading">Registered Students & Graduates</div>
                                <div class="widget-subheading">Total</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><?php echo $number_of_students+$number_of_graduates; ?></div>
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
                                <div class="widget-heading">Registered Employers</div>
                                <div class="widget-subheading">People Interested</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger"><?php echo $number_of_employers; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>                             
         <?php include_once('../api_controller/tasks_handler.php');  ?>                                 
        <!--end-->
    </div> 
<?php
    include_once('./footer.php');