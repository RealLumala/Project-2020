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
                        Curriculum Dashboard
                    </div>
                </div>   
            </div>
        </div>
        <!-- begin -->
        <div clas="row">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Curriculum</h5>
                        <form action="../api_controller/upload_curriculum.php" method="post"
                                name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="Skill name" class="">Curriculum Title</label>
                                        <input name="title" id="title" placeholder="Title" 
                                               type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">   
                                    <div class="position-relative form-group">
                                        <label for="Upload Files" class="">Upload Curriculum</label>
                                        <input name="file" id="files" type="file" multiple="" class="form-control-file">
                                        <small class="form-text text-muted">
                                            Upload Curriculum.
                                        </small>
                                    </div>
                                </div>
                            </div>                            
                            <button class="mt-2 btn btn-primary" name="btn-upload" 
                                type="submit" id="btn-upload">Create Curriculum</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                                    $sqlSelect_uncofirmed = "SELECT * FROM curriculum where institution_admin_id='$user_id' order by curriculum_id desc";                   
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
                                        <form action="../api_controller/upload_curriculum.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $cul_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="endorsed">
                                                Endorse
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form action="../api_controller/upload_curriculum.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $cul_id; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="delete">
                                                Delete
                                            </button>
                                        </form>
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