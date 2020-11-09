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
                        Curriculums
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin -->
        <?php  if(isset($_POST['view'])){
          $curriculum = filter_input(INPUT_POST, 'id');  
        }?>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Revised Curriculum
                    </div>  
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Curriculum Id</th>
                                    <th class="text-center">Curriculum Title</th>
                                    <th class="text-center">File Type</th>
                                    <th class="text-center">File Size</th>
                                    <th class="text-center">Date Upload</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    $sqlSelect_uncofirmed = "SELECT * FROM curriculum where institution_admin_id='$curriculum' and status=1 order by curriculum_id desc";                   
                                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                    if (mysqli_num_rows($result_uncofirmed) > 0)
                                    {
                                    while($row = mysqli_fetch_array($result_uncofirmed))
                                    {
                                        $cul_id = $row['curriculum_id'];
                                        $cul_name = $row['curriculum'];
                                        $cul_path = $row['file_path'];
                                        $cul_type = $row['file_type'];
                                        $cul_size = $row['file_size'];
                                        $cul_status = $row['status'];
                                        $cul_created = $row['created'];
                                        
                                 ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo 'Cul_00'.$cul_id; ?></td>
                                    <td class="text-center"><?php echo $cul_name; ?></td>
                                    <td class="text-center"><?php echo $cul_type; ?></td>
                                    <td class="text-center"><?php echo $cul_size/1000; echo ' Kbs'; ?></td>
                                    <td class="text-center"><?php echo $cul_created; ?></td>
                                    <td class="text-center">
                                        <?php if($cul_status == 1){
                                           ?>
                                        <div class="badge badge-success">Endorsed</div>
                                        <?php
                                        }elseif ($cul_status == 2) {
                                            ?><div class="badge badge-danger">Canceled</div> 
                                        <?php
                                        }else {
                                        ?>
                                            <div class="badge badge-info">On Hold</div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="../api_controller/<?php echo $cul_path; ?>" target="_blank">
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">
                                                Download
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php
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