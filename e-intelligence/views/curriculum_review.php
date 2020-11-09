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
    //get number of unconfirmed students accounts  
    $sqlSelect_uncofirmed = "SELECT DISTINCT Name FROM skill where institution_admin_id='$user_id' and scouted > 0";                   
    $result_uncofirmed = mysqli_query($conn, $sqlSelect_uncofirmed);
        
?> 
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_uncofirmed) > 0)
    {
        $unconfirmed = mysqli_num_rows($result_uncofirmed);
    ?>      
                    <div class="card-header">Skills Scouted In the Market from this Institution <?php echo $unconfirmed; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Review Name</th>
                                    <th class="text-center">Rank Points</th>
                                    <th class="text-center">Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
       $i=0;
       //SCOUTED SKILLS FROM INSTITUTION
       $type_analysis = 1;    
       while ($row = mysqli_fetch_array($result_uncofirmed)) {
           
            $skill_name = $row['Name'];
            //count number of records (ranking units)
            //get number of unconfirmed students accounts  
            $sqlSelect_count = "SELECT * FROM skill where name = '$skill_name' and institution_admin_id='$user_id' and scouted > 0";                   
            $result_count = mysqli_query($conn, $sqlSelect_count);
            $skill_ranking = mysqli_num_rows($result_count);
                
            //get number of unconfirmed students accounts  
            $sqlSelect_analysis = "SELECT * FROM analysis_revi where skill_name = '$skill_name' and "
                    . "institution_id='$user_id' and type_analysis = 1";                   
            $result_analysis= mysqli_query($conn, $sqlSelect_analysis);
            if (mysqli_num_rows($result_analysis) > 0)
            {
                $row = mysqli_fetch_array($result_analysis);
                $analysis_id = $row['id'];
                    
                //Update data
               $messageinsertSQL = "UPDATE analysis_revi SET skill_value = '$skill_ranking', updated = now() WHERE id='$analysis_id'";
                $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){
                    $message = "analysis is up to date";
                }else
                {
                    $message = "analysis is not up to date";
                }
                    
            }else
            {
                //start Ranking
                $messageinsertSQL = "INSERT INTO analysis_revi (skill_name, institution_id, skill_value, type_analysis, updated)
                VALUES ('$skill_name', '$user_id', '$skill_ranking', '$type_analysis', now())";
                 $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){
                    $message = "analysis is up to date";
                }else
                {
                    $message = "analysis is not up to date";
                }
                    
            }
                
       }       
           
    //pick skills from analysis table with there rankings       //get number of unconfirmed students accounts  
    $sqlSelect_rank = "SELECT * FROM analysis_revi where institution_id='$user_id' and type_analysis = 1 order by skill_value DESC";                    
    $result_rank = mysqli_query($conn, $sqlSelect_rank);
    if (mysqli_num_rows($result_rank) > 0)
    {   
        $i=0;
        while ($row = mysqli_fetch_array($result_rank)) { 
        $i++;
        $name = $row['skill_name'];
        $rank = $row['skill_value'];
        $Updated = $row['updated'];
    ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td class="text-center"><?php echo $rank; ?></td>
                                    <td class="text-center"><?php echo $Updated; ?></td>
                                    <td class="text-center">
                                        <form  action="review_analysis.php" method="post">
                                            <input type="hidden" name="scouted" value="<?php echo $name; ?>" />
                                            <button type="submit" class="badge badge-warning" style="cursor: pointer;">
                                                View Analysis
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
       <?php
    }else {
        ?>
                    <div class="card-header">Skills Scouted In the Market from this Institution 
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Review Name</th>
                                    <th class="text-center">Rank Points</th>
                                    <th class="text-center">Updated</th>
                                    <th class="text-center">Action</th>
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
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        function drawChart() {
                            
                            var data = google.visualization.arrayToDataTable([
                                ['Skills', 'Points'],
                                          <?php
                                              $sql = "SELECT * FROM analysis_revi where institution_id='$user_id' and type_analysis = 1 order by skill_value DESC";
                                              $fire = mysqli_query($conn,$sql);
                                              while ($result = mysqli_fetch_assoc($fire)) {                                               
                                                          
                                                echo"['".$result['skill_name']."',".$result['skill_value']."],";
                                              }
                                                          
                                          ?>
                                                  ]);
                                                  var options = {
                                                      chart: {
                                                          title: 'Scouted skills',
                                                          subtitle: 'Ranking and Standings of scouted skills',
                                                      },
                                                      bars: 'horizontal' // Required for Material Bar Charts.
                                                  };
                                                  
                                                  var chart = new google.charts.Bar(document.getElementById('piechart'));
                                                  
                                                  chart.draw(data, google.charts.Bar.convertOptions(options));
                                              }
                    </script>
                    <div id="piechart" style="width: 900px; height:auto;"></div>  
                </div>                    
            </div>                
        </div>
    <?php
    $sqlSelect_uncofirmed_grads = "SELECT DISTINCT Name FROM skill where user_id = 0 and institution_admin_id='$user_id'";                   
    $result_uncofirmed_grads = mysqli_query($conn, $sqlSelect_uncofirmed_grads);
        
    ?> 
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_uncofirmed_grads) > 0)
    {
        $unconfirmed_grads = mysqli_num_rows($result_uncofirmed_grads);
    ?>       
                    <div class="card-header">Skills In the Market from this Institution <?php echo $unconfirmed_grads; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Review Name</th>
                                    <th class="text-center">Rank Points</th>
                                    <th class="text-center">Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
       $i=0;
       //SKILLS IN THE MARKET FROM INSTITUTION
       $type_analysis = 2;    
       while ($row = mysqli_fetch_array($result_uncofirmed_grads)) {
           
            $skill_name = $row['Name'];
            //count number of records (ranking units)
            //get number of unconfirmed students accounts  
            $sqlSelect_count_grads = "SELECT * FROM skill where Name = '$skill_name' and user_id = 0 and institution_admin_id='$user_id'";                   
            $result_count_grads = mysqli_query($conn, $sqlSelect_count_grads);
            $skill_ranking = mysqli_num_rows($result_count_grads);
                
            //get number of unconfirmed students accounts  
            $sqlSelect_analysis = "SELECT * FROM analysis_revi where skill_name = '$skill_name' and "
                    . "institution_id='$user_id' and type_analysis = 2";                   
            $result_analysis= mysqli_query($conn, $sqlSelect_analysis);
            if (mysqli_num_rows($result_analysis) > 0)
            {
                $row = mysqli_fetch_array($result_analysis);
                $analysis_id = $row['id'];
                    
                //Update data
               $messageinsertSQL = "UPDATE analysis_revi SET skill_value = '$skill_ranking', updated = now() WHERE id='$analysis_id'";
                $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){
                    $message = "analysis is up to date";
                }else
                {
                    $message = "analysis is not up to date";
                }
                    
            }else
            {
                //start Ranking
                $messageinsertSQL = "INSERT INTO analysis_revi (skill_name, institution_id, skill_value, type_analysis, updated)
                VALUES ('$skill_name', '$user_id', '$skill_ranking', '$type_analysis', now())";
                 $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){
                    $message = "analysis is up to date";
                }else
                {
                    $message = "analysis is not up to date";
                }
                    
            }
                
       }       
           
    //pick skills from analysis table with there rankings       //get number of unconfirmed students accounts  
    $sqlSelect_rank = "SELECT * FROM analysis_revi where institution_id='$user_id' and type_analysis = 2 order by skill_value DESC";                    
    $result_rank = mysqli_query($conn, $sqlSelect_rank);
    if (mysqli_num_rows($result_rank) > 0)
    {   
        $i=0;
        while ($row = mysqli_fetch_array($result_rank)) { 
        $i++;
        $name = $row['skill_name'];
        $rank = $row['skill_value'];
        $Updated = $row['updated'];
    ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td class="text-center"><?php echo $rank; ?></td>
                                    <td class="text-center"><?php echo $Updated; ?></td>
                                    <td class="text-center">
                                        <form  action="review_analysis.php" method="post">
                                            <input type="hidden" name="scouted" value="<?php echo $name; ?>" />
                                            <button type="submit" class="badge badge-warning" style="cursor: pointer;">
                                                View Analysis
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
       <?php
    }else {
        ?>
                    <div class="card-header">Skills In the Market from this Institution 
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Review Name</th>
                                    <th class="text-center">Rank Points</th>
                                    <th class="text-center">Updated</th>
                                    <th class="text-center">Action</th>
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
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        function drawChart() {
                            
                            var data = google.visualization.arrayToDataTable([
                                ['Skills', 'Points'],
                                          <?php
                                              $sql_in = "SELECT * FROM analysis_revi where institution_id='$user_id' and type_analysis = 2 order by skill_value DESC";
                                              $fire_in = mysqli_query($conn,$sql_in);
                                              while ($result = mysqli_fetch_assoc($fire_in)) {                                               
                                                          
                                                echo"['".$result['skill_name']."',".$result['skill_value']."],";
                                              }
                                                          
                                          ?>
                                                  ]);
                                                  var options = {
                                                      chart: {
                                                          title: 'SKILLS IN THE MARKET FROM THIS INSTITUTION',
                                                          subtitle: 'Ranking and Standings of skills in the market for this Institution',
                                                      },
                                                      bars: 'horizontal' // Required for Material Bar Charts.
                                                  };
                                                  
                                                  var chart = new google.charts.Bar(document.getElementById('piechart2'));
                                                  
                                                  chart.draw(data, google.charts.Bar.convertOptions(options));
                                              }
                    </script>
                    <div id="piechart2" style="width: 900px; height:auto;"></div>  
                </div>                    
            </div>                
        </div>
        <?php
    $sqlSelect_uncofirmed_gs = "SELECT DISTINCT Name FROM skill where user_id = 0 and employer_id != 0 ";                   
    $result_uncofirmed_gs = mysqli_query($conn, $sqlSelect_uncofirmed_grads);
        
    ?> 
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card"> 
<?php
    if (mysqli_num_rows($result_uncofirmed_gs) > 0)
    {
        $unconfirmed_grads = mysqli_num_rows($result_uncofirmed_gs);
    ?>       
                    <div class="card-header">Skills In the Market <?php echo $unconfirmed_grads; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Review Name</th>
                                    <th class="text-center">Rank Points</th>
                                    <th class="text-center">Updated</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
       $i=0;
       //SKILLS IN THE MARKET
       $type_analysis = 3;    
       while ($row = mysqli_fetch_array($result_uncofirmed_gs)) {
           
            $skill_name = $row['Name'];
            //count number of records (ranking units)
            //get number of unconfirmed students accounts  
            $sqlSelect_count_grads = "SELECT * FROM skill where Name = '$skill_name' and user_id = 0 and employer_id != 0";                   
            $result_count_grads = mysqli_query($conn, $sqlSelect_count_grads);
            $skill_ranking = mysqli_num_rows($result_count_grads);
                
            //get number of unconfirmed students accounts  
            $sqlSelect_analysis = "SELECT * FROM analysis_revi where skill_name = '$skill_name' and type_analysis = 3";                   
            $result_analysis= mysqli_query($conn, $sqlSelect_analysis);
            if (mysqli_num_rows($result_analysis) > 0)
            {
                $row = mysqli_fetch_array($result_analysis);
                $analysis_id = $row['id'];
                    
                //Update data
               $messageinsertSQL = "UPDATE analysis_revi SET skill_value = '$skill_ranking', updated = now() WHERE id='$analysis_id'";
                $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){
                    $message = "analysis is up to date";
                }else
                {
                    $message = "analysis is not up to date";
                }
                    
            }else
            {
                //start Ranking
                $messageinsertSQL = "INSERT INTO analysis_revi (skill_name, institution_id, skill_value, type_analysis, updated)
                VALUES ('$skill_name', 0, '$skill_ranking', '$type_analysis', now())";
                 $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
                if($messageinsertQuery){
                    $message = "analysis is up to date";
                }else
                {
                    $message = "analysis is not up to date";
                }
                    
            }
                
       }       
           
    //pick skills from analysis table with there rankings       //get number of unconfirmed students accounts  
    $sqlSelect_rank = "SELECT * FROM analysis_revi where type_analysis = 3 order by skill_value DESC";                    
    $result_rank = mysqli_query($conn, $sqlSelect_rank);
    if (mysqli_num_rows($result_rank) > 0)
    {   
        $i=0;
        while ($row = mysqli_fetch_array($result_rank)) { 
        $i++;
        $name = $row['skill_name'];
        $rank = $row['skill_value'];
        $Updated = $row['updated'];
    ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td class="text-center"><?php echo $rank; ?></td>
                                    <td class="text-center"><?php echo $Updated; ?></td>
                                    <td class="text-center">
                                        <form  action="review_analysis.php" method="post">
                                            <input type="hidden" name="all" value="<?php echo $name; ?>" />
                                            <button type="submit" class="badge badge-warning" style="cursor: pointer;">
                                                View Analysis
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
       <?php
    }else {
        ?>
                    <div class="card-header">Skills In the Market 
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Review Name</th>
                                    <th class="text-center">Rank Points</th>
                                    <th class="text-center">Updated</th>
                                    <th class="text-center">Action</th>
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
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        function drawChart() {
                            
                            var data = google.visualization.arrayToDataTable([
                                ['Skills', 'Points'],
                                          <?php
                                              $sql_ins = "SELECT * FROM analysis_revi where type_analysis = 3 order by skill_value DESC";
                                              $fire_ins = mysqli_query($conn,$sql_ins);
                                              while ($result = mysqli_fetch_assoc($fire_ins)) {                                               
                                                          
                                                echo"['".$result['skill_name']."',".$result['skill_value']."],";
                                              }
                                                          
                                          ?>
                                                  ]);
                                                  var options = {
                                                      chart: {
                                                          title: 'SKILLS IN THE MARKET',
                                                          subtitle: 'Ranking and Standings of skills in the market',
                                                      },
                                                      bars: 'horizontal' // Required for Material Bar Charts.
                                                  };
                                                  
                                                  var chart = new google.charts.Bar(document.getElementById('piechart3'));
                                                  
                                                  chart.draw(data, google.charts.Bar.convertOptions(options));
                                              }
                    </script>
                    <div id="piechart3" style="width: 900px; height:auto;"></div>  
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