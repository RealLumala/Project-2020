<?php
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include_once('header.php');
    include_once('side_bar_manue.php');
    if (isset($_POST['year'])){
        
        $year = filter_input(INPUT_POST, 'year');
        
?>
<style>    
    
    .outer-container {
        background: #F0F0F0;
        border: #e0dfdf 1px solid;
        padding: 40px 20px;
        border-radius: 2px;
    }
    
    .btn-submit {
        background: #333;
        border: #1d1d1d 1px solid;
        border-radius: 2px;
        color: #f0f0f0;
        cursor: pointer;
        padding: 5px 20px;
        font-size:0.9em;
    }
    
    .tutorial-table {
        margin-top: 40px;
        font-size: 0.8em;
        border-collapse: collapse;
        width: 100%;
    }
    
    .tutorial-table th {
        background: #f0f0f0;
        border-bottom: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }
    
    .tutorial-table td {
        background: #FFF;
        border-bottom: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }
    
    #response {
        padding: 10px;
        margin-top: 10px;
        border-radius: 2px;
        display:none;
    }
    
    .success {
        background: #c7efd9;
        border: #bbe2cd 1px solid;
    }
    
    .error {
        background: #fbcfcf;
        border: #f3c6c7 1px solid;
    }
    
    div#response.display-block {
        display: block;
    }
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
                        Graduate List 
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin -->         
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Graduate List <?php echo $year; ?>  
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="grad_list_details.php" method="post">
                                    <input type="hidden" name="year" id="year" value="<?php echo $year?>" />
                                    <input type="text" name="reg_number" id="reg_number" 
                                        class="my-form" placeholder="Registration Number" />
                                    <button class="active btn btn-focus">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php 
                     $student_reg_number = '';
                     if (isset($_POST['reg_number'])){
                        $student_reg_number = filter_input(INPUT_POST, 'reg_number');
                     }
                    ?>
                    <div class="table-responsive">
                        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
                            <?php if(!empty($message)) { echo $message; } ?></div>
                        <?php
                            $sqlSelect = "SELECT * FROM graduate_list Where student_number = '$student_reg_number' and year = '$year' and "
                                    . "institution_admin_id='$institution_id'";
                            $result_list = mysqli_query($conn, $sqlSelect);

                        if (mysqli_num_rows($result_list) > 0)
                        {
                        ?>
                        <table class='tutorial-table'>
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Registration Number</th>
                                    <th>Course</th>
                                    <th>Graduation Year</th>
                                </tr>
                            </thead>
                        <?php
                            while ($row = mysqli_fetch_array($result_list)) {
                        ?>                  
                            <tbody>
                                <tr>
                                    <td><?php  echo $row['student_name']; ?></td>
                                    <td><?php  echo $row['student_number']; ?></td>
                                    <td><?php  echo $row['course']; ?></td>
                                    <td><?php  echo $row['year']; ?></td>
                                </tr>
                        <?php
                            }
                        ?>
                            </tbody>
                        </table>
                        <?php 
                        } else {
                        ?>
                            <?php
                                $sqlSelect = "SELECT * FROM graduate_list Where year = '$year' and "
                                    . "institution_admin_id='$institution_id'";
                                $result_list = mysqli_query($conn, $sqlSelect);

                            if (mysqli_num_rows($result_list) > 0)
                            {
                            ?>
                            <table class='tutorial-table'>
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Registration Number</th>
                                        <th>Course</th>
                                        <th>Graduation Year</th>
                                    </tr>
                                </thead>
                            <?php
                                while ($row = mysqli_fetch_array($result_list)) {
                            ?>                  
                                <tbody>
                                    <tr>
                                        <td><?php  echo $row['student_name']; ?></td>
                                        <td><?php  echo $row['student_number']; ?></td>
                                        <td><?php  echo $row['course']; ?></td>
                                        <td><?php  echo $row['year']; ?></td>
                                    </tr>
                            <?php
                                }
                            ?>
                                </tbody>
                            </table>
                            <?php 
                            }
                        } 
                        ?> 
                    </div>
                </div>
            </div>
        </div>        
        <!--end-->
    </div> 
<?php
    }
    include_once('footer.php');