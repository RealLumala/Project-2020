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
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Revised Curriculums
                    </div> 
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Emblem</th>
                                    <th class="text-center">Institution</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                    $sqlSelect_uncofirmed = "SELECT DISTINCT institution_admin_id FROM curriculum order by curriculum_id desc";                   
                                    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
                                    if (mysqli_num_rows($result_uncofirmed) > 0)
                                    {
                                    while($row = mysqli_fetch_array($result_uncofirmed))
                                    {
                                        $cul_in = $row['institution_admin_id'];
                                        //get registrar detials
                                        $checkAccount = mysqli_query($conn, ("select * from institution_admin WHERE "
                                                . "user_id='$cul_in'"));
                                        $checkExistance = mysqli_num_rows($checkAccount);                    
                                        if($checkExistance > 0){ 
                                            //user details
                                           $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
                                           $institution_name = $fetchDetails['institution_name'];
                                           $logo2 = $fetchDetails['logo'];
                                        }
                                        
                                 ?>
                                <tr>
                                    <td class="text-center text-muted"><img width="42" class="rounded-circle" src="../api_controller/<?php echo $logo2; ?>" alt=""></td>
                                    <td class="text-center"><?php echo $institution_name; ?></td>
                                    <td class="text-center">
                                        <form action="./view-curriculums.php" method="post" >
                                            <input name="id" id="id" value="<?php echo $cul_in; ?>" 
                                                   type="hidden" class="form-control">
                                            <button type="submit" id="PopoverCustomT-1" class="btn btn-primary btn-sm" name="view">
                                                View Curriculums
                                            </button>
                                        </form>
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