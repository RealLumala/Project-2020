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
                        Upload Graduate List Dashboard
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin -->
        <div clas="row">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Graduate List</h5>
                        <div class="outer-container">
                            <form action="../api_controller/upload_graduate_list.php" method="post"
                                name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="year" class="">Academic Year</label>
                                        <input name="year" id="year" placeholder="Academic Year" 
                                               type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="year" class="">Course Name/ Major</label>
                                        <input name="course" id="course" placeholder="e.g Information Systems (I.T)" 
                                               type="text" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <label>Choose Excel
                                        File</label> <input type="file" name="file"
                                                        id="file" accept=".xls,.xlsx">
                                    <button type="submit" id="submit" name="import"
                                            class="btn-submit">Import</button>

                                </div>

                            </form>
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
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Graduate List   
                    </div>
                    <div class="table-responsive">
                        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
                            <?php if(!empty($message)) { echo $message; } ?></div>
                        <?php
                            $sqlSelect = "SELECT * FROM graduate_list Where "
                                    . "institution_admin_id='$institution_id' order by year desc";
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
                        ?> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Graduate Lists and Academic Years   
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <form action="upload_graduate_list.php?result" method="post">
                                    <input type="number" name="year" id="year" 
                                        class="my-form" placeholder="Academic year" />
                                    <button class="active btn btn-focus">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php 
                     $academic_year = '';
                     if (isset($_POST['year'])){                        
                        $academic_year = filter_input(INPUT_POST, 'year');
                     }
                    ?>
                    <div class="table-responsive">
                        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
                            <?php if(!empty($message)) { echo $message; } ?></div>
                        <?php
                            $sqlSelect = "SELECT * FROM graduate_list Where "
                                    . "institution_admin_id='$institution_id' and year = '$academic_year'";
                            $result_year = mysqli_query($conn, $sqlSelect);

                        if (mysqli_num_rows($result_year) > 0)
                        {
                        ?>
                        <table class='tutorial-table'>
                            <thead>
                                <tr>
                                    <th>Graduation Year</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                        <?php
                            $row = mysqli_fetch_array($result_year);
                        ?>                  
                            <tbody>
                                <tr>
                                    <td><?php  $my_year = $row['year']; echo $my_year; ?></td>
                                    <td>
                                        <form action="grad_list_details.php" method="post">
                                            <input type="hidden" name="year" value="<?php  echo $my_year; ?>" />
                                            <button type="submit" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                                                Details
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php 
                        } 
                        else {?>
                            <?php
                                 $sqlSelect = "SELECT DISTINCT year FROM graduate_list Where "
                                         . "institution_admin_id='$institution_id' order by year desc";
                                 $result_year = mysqli_query($conn, $sqlSelect);

                             if (mysqli_num_rows($result_year) > 0)
                             {
                             ?>
                             <table class='tutorial-table'>
                                 <thead>
                                     <tr>
                                         <th>Graduation Year</th>
                                         <th>Details</th>
                                     </tr>
                                 </thead>                
                                 <tbody>
                                     <?php while ($row = mysqli_fetch_array($result_year)){
                                     ?>
                                        <tr>
                                            <td><?php  $my_year = $row['year']; echo $my_year; ?></td>
                                            <td>
                                                <form action="grad_list_details.php" method="post">
                                                    <input type="hidden" name="year" value="<?php  echo $my_year; ?>" />
                                                    <button type="submit" id="PopoverCustomT-4" class="btn btn-primary btn-sm">
                                                        Details
                                                    </button>
                                                </form>
                                            </td>
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
    include_once('footer.php');