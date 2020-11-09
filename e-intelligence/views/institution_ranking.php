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
    <div class="app-main__inner" style="padding-bottom: 50px;">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-database icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Institution Ranking Dashboard
                    </div>
                </div>   
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card-body">
                    <h5 class="card-title">Live Standing of Institutions</h5>
                    <table class="mb-0 table table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Ranking</th>
                                <th scope="col">Emblem</th>
                                <th scope="col">University</th>
                                <th scope="col">S:G</th>
                                <th scope="col">E:G</th>
                                <th scope="col">F:G</th>
                                <th scope="col">U:G</th>
                                <th scope="col">S:E</th>
                                <th scope="col">F:B</th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php
                                        //get number of students                  
                                        $sqlSelect = "SELECT * FROM institution_ranking order by rank_points DESC";                   
                                        $result = mysqli_query($conn, $sqlSelect);
                                        if (mysqli_num_rows($result) > 0)
                                        {
                                            $i = 0;
                                            $e = 0;
                                            $se = 0;
                                            $sg = 0; 
                                            $fe = 0;
                                            $points = 0;
                                            while ($row = mysqli_fetch_array($result)){
                                            $i++;
                                            $institution_id = $row['institution_id'];
                                            $points = $row['rank_points']; 
                                                
                                            $sqlSelects = "SELECT * FROM institution_admin WHERE id = $institution_id";                   
                                            $results = mysqli_query($conn, $sqlSelects);
                                            if (mysqli_num_rows($results) > 0)
                                            {
                                                $row = mysqli_fetch_array($results);
                                                $institution_name = $row['institution_name']; 
                                                $institution_gp = $row['user_id']; 
                                                $logo = $row['logo']; 
                                                    
                                                $sqlSelecti = "SELECT * FROM graduate_list WHERE institution_admin_id = $institution_id";                   
                                                $resulti = mysqli_query($conn, $sqlSelecti);
                                                if (mysqli_num_rows($resulti) > 0)
                                                {
                                                    $sg = mysqli_num_rows($resulti);
                                                }                                                
                                                $sqlSelecte = "SELECT * FROM employement WHERE institution_id = $institution_gp";                   
                                                $resulte = mysqli_query($conn, $sqlSelecte);
                                                if (mysqli_num_rows($resulte) > 0)
                                                {
                                                    $e = mysqli_num_rows($resulte);
                                                }
                                                $sqlSelectse = "SELECT * FROM employement WHERE stetus = 1 and institution_id = $institution_gp";                   
                                                $resultse = mysqli_query($conn, $sqlSelectse);
                                                if (mysqli_num_rows($resultse) > 0)
                                                {
                                                    $se = mysqli_num_rows($resultse);
                                                }
                                                $sqlSelectfe = "SELECT * FROM employement WHERE stetus = 0 and institution_id = $institution_gp";                   
                                                $resultfe = mysqli_query($conn, $sqlSelectfe);
                                                if (mysqli_num_rows($resultfe) > 0)
                                                {
                                                    $fe = mysqli_num_rows($resultfe);
                                                }
                                                $ue = $sg - $e;
                                            }
                                    ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td>
                                    <img width="42" class="rounded-circle" 
                                         style="border-radius: 25px;" src="../api_controller/<?php echo $logo; ?>"
                                         alt="">
                                </td>
                                <td><?php echo $institution_name; ?></td>
                                <td><?php echo $sg; ?> </td>
                                <td><?php echo $e; ?> </td>
                                <td><?php echo $fe; ?> </td>
                                <td><?php echo $ue + $fe; ?> </td></td>
                                <td><?php echo $se; ?></td>
                                <td><?php echo $points; ?></td>
                            </tr>
                                    <?php
                                            }
                                        }else
                                        {
                                    ?>
                            <tr>
                                <th scope="row">No data</th>
                                <td>logo</td>
                                <td>Name</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                                    <?php
                                        
                                        }
                                    ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="heading wow fadeInUp">
                        <h2>University Ranking by Number of Graduates</h2>
                        <p>Current University Ranking and Standings by number of graduates</p>
                    </div>
                    <div class="col-sm-12 col-md-12 wow fadeInLeft">
                        <div class="service">
                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);
                                
                                function drawChart() {
                                    
                                    var data = google.visualization.arrayToDataTable([
                                        ['Universities', 'Graduates'],
                                        <?php
                                            $sql = "SELECT * FROM institution_admin";
                                            $fire = mysqli_query($conn,$sql);
                                            while ($result = mysqli_fetch_assoc($fire)) {                                               
                                               $institution_id = $result['id'];
                                               $sg = 0;
                                               $sqlSelecti = "SELECT * FROM graduate_list WHERE institution_admin_id = $institution_id";                   
                                               $resulti = mysqli_query($conn, $sqlSelecti);
                                               if (mysqli_num_rows($resulti) > 0)
                                               {
                                                  $sg = mysqli_num_rows($resulti);
                                               }
                                               echo"['".$result['institution_name']."',".$sg."],";
                                            }
                                                        
                                        ?>
                                                ]);
                                                var options = {
                                                    chart: {
                                                        title: 'Universities Performance',
                                                        subtitle: 'Ranking and Standings by number of graduates',
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
                <div class="card-body">
                    <div class="heading wow fadeInUp">
                        <h2>University Ranking by Employment</h2>
                        <p>Current University Ranking and Standings by Employment</p>
                    </div>
                    <div class="col-sm-6 col-md-3 wow fadeInLeft">
                        <div class="service">
                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['bar']});
                                google.charts.setOnLoadCallback(drawChart);
                                
                                function drawChart() {
                                    
                                    var data = google.visualization.arrayToDataTable([
                                        ['Universities', 'Graduates'],
                                        <?php
                                            $sqlse = "SELECT * FROM institution_admin";
                                            $firese = mysqli_query($conn,$sqlse);
                                            while ($result = mysqli_fetch_assoc($firese)) {                                               
                                               $institution_gp = $result['user_id'];
                                               $se = 0;
                                               $sqlSelectse = "SELECT * FROM employement WHERE stetus = 1 and institution_id = $institution_gp";                   
                                               $resultse = mysqli_query($conn, $sqlSelectse);
                                               if (mysqli_num_rows($resultse) > 0)
                                               {
                                                    $se = mysqli_num_rows($resultse);
                                               }
                                               echo"['".$result['institution_name']."',".$se."],";
                                            }
                                                        
                                        ?>
                                                ]);
                                                var options = {
                                                    chart: {
                                                        title: 'Universities Performance',
                                                        subtitle: 'Ranking and Standings by Employment',
                                                    },
                                                    bars: 'horizontal' // Required for Material Bar Charts.
                                                };
                                                
                                                var chart = new google.charts.Bar(document.getElementById('piechartse'));
                                                
                                                chart.draw(data, google.charts.Bar.convertOptions(options));
                                            }
                            </script>
                            <div id="piechartse" style="width: 900px; height:auto;"></div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card-body">
                    <h5 class="card-title">Key Map</h5>
                    <p><b>S:G</b> = Number of students Graduated,<br/> 
                        <b>E:G</b> = Number of Graduates Employed out of Graduates,<br/> 
                        <b>F:E</b> = Number of graduates fired out of Employed,<br/> 
                        <b>U:G</b> = Number of graduates still Unemployed,<br/>
                        <b>S:E</b> = Number of graduates still Employed,<br/>
                        <b>F:B</b> = Points from Good feedback of employers 
                    </p>  
                </div>
            </div>
        </div>
    </div>   
<?php
    include_once('footer.php');