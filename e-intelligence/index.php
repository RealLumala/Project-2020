<?php
    if(isset($_SESSION['username'])){        
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=views/dashboard.php' />"; 
    }
    $user_id = '';
    include_once('./api_controller/db_connection.php'); 
    include_once('./api_controller/count_dataBadse.php'); 
?> 
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>e-intelligence</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
        <!-- Fonts -->
        <!-- Lato -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/css/ionicons.min.css">
        
        <!-- CSS -->
        
        <link rel="stylesheet" href="css/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/css/owl.carousel.css">
        <link rel="stylesheet" href="css/css/animate.css">
        <link rel="stylesheet" href="css/css/main.css">
        <!-- Responsive Stylesheet -->
        <link rel="stylesheet" href="css/css/responsive.css">        
        <script src="views/css/assets/scripts/loader.js"></script> 
        <style>
            body::-webkit-scrollbar {
                width: 0.50em;
                border-radius: 0 2px 0 2px; 
            }
            body::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            }
            body::-webkit-scrollbar-thumb {
                background-color: darkgrey;
                outline: 1px solid slategrey;
            }
        </style>
    </head>
    <body id="body">
        <div id="preloader">
            <div class="book">
                <div class="book__page"></div>
                <div class="book__page"></div>
                <div class="book__page"></div>
            </div>
        </div>
        <!-- 
        Header start
        ==================== -->
        <div class="navbar-default navbar-fixed-top" id="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img class="logo-1" src="css/images/logo.png" alt="LOGO">
                        <img class="logo-2" src="css/images/logo-2.png" alt="LOGO">
                    </a>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <nav class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right" id="top-nav">
                        <li><a href="#ranking">University Ranking</a></li>
                        <li><a href="sign_in.php?login=">Login</a></li>
                        <li><a href="sign_up.php">Create Account</a></li>
                    </ul>
                </nav><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </div>
        
        <section id="hero-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block">
                            <h1 class="wow fadeInDown">A passionate way To get A career Started</h1>
                            <div class="wow fadeInDown" data-wow-delay="0.3s">
                                <a class="btn btn-default btn-home" href="#ranking" role="button">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow zoomIn">
                        <div class="block">
                            <div class="counter text-center">
                                <ul id="countdown_dashboard">
                                    <li>
                                        <div class="dash days_dash">
                                            <div class="digits"><?php echo $number_of_students; ?></div>
                                            <span class="dash_title">Number of Students</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dash hours_dash">
                                            <div class="digits"><?php echo $number_of_graduates; ?></div>
                                            <span class="dash_title">Number of Graduates</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dash minutes_dash">
                                            <div class="digits"><?php echo $number_of_isntitutions; ?></div>
                                            <span class="dash_title">Number of Universities</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dash seconds_dash">
                                            <div class="digits"><?php echo $number_of_employers; ?></div>
                                            <span class="dash_title">Number of Employers</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- .row close -->
            </div><!-- .container close -->
        </section><!-- header close -->
        <!-- 
        Service start
        ==================== -->
        <section id="ranking" class="section">
            <div class="container">
                <div class="row">
                    <div class="heading wow fadeInUp">
                        <h2>University Ranking</h2>
                        <p>Current University Ranking and Standings</p>
                        <p>S:G = Number of students Graduated, E:G = Number of Graduates Employed out of Graduates, F:E = Number of graduates fired out of Employed, U:G = Number of graduates still Unemployed, S:E = Number of graduates still Employed, F:B = Points from Good feedback of employers</p>
                    </div>
                    <div class="col-sm-12 col-md-12 wow fadeInLeft">
                        <div class="service">
                            <table class="table">
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
                                                 style="border-radius: 25px;" src="./api_controller/<?php echo $logo; ?>"
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
                    </div>
                </div>
            </div>
            <!-- .container close -->
        </section>
        <section id="ranking" class="section">
            <div class="container">
                <div class="row">
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
            </div>
            <!-- .container close -->
        </section>
        <section id="ranking" class="section">
            <div class="container">
                <div class="row">
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
            <!-- .container close -->
        </section>
        <!-- #service close -->
        <section id="call-to-action" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow text-center">
                        <div class="block">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Your Email Address">
                                <button class="btn btn-default btn-submit" type="submit">Get Notified</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- #call-to-action close -->
        <section clas="wow fadeInUp">
            <div class="map-wrapper">
            </div>
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | by by e-Intelligence</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Js -->
        <script src="css/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="css/js/vendor/jquery-1.10.2.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="css/js/jquery.lwtCountdown-1.0.js"></script>
        <script src="css/js/bootstrap.min.js"></script>
        <script src="css/js/owl.carousel.min.js"></script>
        <script src="css/js/jquery.validate.min.js"></script>
        <script src="css/js/jquery.form.js"></script>
        <script src="css/js/jquery.nav.js"></script>
        <script src="css/js/jquery.sticky.js"></script>
        <script src="css/js/plugins.js"></script>
        <script src="css/js/wow.min.js"></script>
        <script src="css/js/main_1.js"></script> 
    </body>
</html>
