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
                        Curriculum Review
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
         <?php
//dashboad for registrars
if($account_type == 'registrar'){
    
    if (isset($_POST['scouted'])){
        
        $skill = $_POST['scouted'];
        //positive
        $sqlSelect_uncofirmed = "SELECT * FROM feedback where programming_language like '%$skill%' and institution_admin_id='$institution_id' and comment_status = 'positive' LIMIT 5";                   
        $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
        $positive = 'Positive Comments';
        $positive_value = mysqli_num_rows($result_uncofirmed);
        //negative
        $sqlSelect_negative = "SELECT * FROM feedback where programming_language like '%$skill%' and institution_admin_id='$institution_id' and comment_status = 'negative' LIMIT 5";                   
        $result_negative= mysqli_query($conn, $sqlSelect_negative);
        $negative = 'Negative Comments';
        $negative_value = mysqli_num_rows($result_negative);
            
    }else{
        $skill = $_POST['all'];
        //positive
        $sqlSelect_uncofirmed = "SELECT * FROM feedback where programming_language like '%$skill%' and comment_status = 'positive' LIMIT 5";                   
        $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
        $positive = 'Positive Comments';
        $positive_value = mysqli_num_rows($result_uncofirmed);
        //negative
        $sqlSelect_negative = "SELECT * FROM feedback where programming_language like '%$skill%' and comment_status = 'negative' LIMIT 5";                   
        $result_negative= mysqli_query($conn, $sqlSelect_negative);
        $negative = 'Negative Comments';
        $negative_value = mysqli_num_rows($result_negative);
    }    
?> 
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_uncofirmed) > 0)
    {
        $unconfirmed = mysqli_num_rows($result_uncofirmed);
    ?>      
                    <div class="card-header">Comments <?php echo $unconfirmed; ?>
                        <form  action="all_comments.php" method="post" style="margin-left: 5px;">
                            <input type="hidden" name="scouted" value="<?php echo $skill; ?>" />
                            <button class="btn btn-success">
                                View all Comments
                            </button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Comments</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $i=0;    
                                   while ($row = mysqli_fetch_array($result_uncofirmed)) {  
                                    $i++;
                                    $comment = $row['feedback_content'];
                                    $status = $row['comment_status'];
                                ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i; ?></td>
                                    <td><?php echo $comment; ?></td>
                                    <td class="text-center"><?php echo $status; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
       <?php
    }else {
        ?>
                    <div class="card-header">Comments
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Comments</th>
                                    <th class="text-center">Comment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
    <?php    
    }
    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_negative) > 0)
    {
        $unconfirmed = mysqli_num_rows($result_negative);
    ?>      
                    <div class="card-header">Comments <?php echo $unconfirmed; ?> 
                        <form  action="all_comments.php" method="post">
                            <input type="hidden" name="negative" value="<?php echo $skill; ?>" />
                            <button class="btn btn-success" style="margin-left: 5px;">View all Comments</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Comments</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $i=0;    
                                   while ($row = mysqli_fetch_array($result_negative)) {  
                                    $i++;
                                    $comment = $row['feedback_content'];
                                    $status = $row['comment_status'];
                                ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i; ?></td>
                                    <td><?php echo $comment; ?></td>
                                    <td class="text-center"><?php echo $status; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div> 
       <?php
    }else {
        ?>
                    <div class="card-header">Comments
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Comments</th>
                                    <th class="text-center">Comment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
    <?php    
    }
    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        function drawChart() {
                            
                            var data = google.visualization.arrayToDataTable([
                                ['Skills', 'Points'],
                                          <?php
                                            echo"['Postive',".$positive_value."],['Negative',".$negative_value."],";               
                                          ?>
                                                  ]);
                                                  var options = {
                                                      title: 'Skill analysis and review',
                                                      subtitle: 'Skill analysis and review'
                                                  };
                                                  
                                                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                                  
                                                  chart.draw(data, options);
                                              }
                    </script>
                    <div id="piechart" style="width: 50%; height:500px; margin-left: 250px; margin-right: 250px;"></div>  
                </div>                    
            </div>                
        </div>
        <?php
            }                
        ?>                                 
        <!--end-->
    </div> 
<?php
    include_once('./footer.php');