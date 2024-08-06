<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time(); // Checking the time now when home page starts.

    require_once('../controllers/DashboardController.php');
    $bsc_count = $msc_count = $bec_count = $bcomc_count = 0; // Default values
    $training_centers_count = $locations_count = $faculties_count = 0; // New default values
    $master_courses_count = $degree_courses_count = $diploma_courses_count = 0; // New default values

    foreach ($ccounts as $ccount) {
        $bsc_count = $ccount['bsc_count'];
        $msc_count = $ccount['msc_count'];
        $bec_count = $ccount['bec_count'];
        $bcomc_count = $ccount['bcomc_count'];
        // $training_centers_count = $ccount['training_centers_count'];
        // $locations_count = $ccount['locations_count'];
        // $faculties_count = $ccount['faculties_count'];
        // $master_courses_count = $ccount['master_courses_count'];
        // $degree_courses_count = $ccount['degree_courses_count'];
    }

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {
        ?>
        <?php include('../../includes/header.php'); ?>
        <?php require_once('../controllers/courseController.php'); ?>
        <?php require_once('../controllers/StudentController.php'); ?>
        <div id="wrapper">
            <?php include('../../includes/sidebar.php'); ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                            <h4><?php echo strtoupper("Welcome " . htmlentities($_SESSION['username'])); ?></h4>
                        </div>
                    </div>
                    <br><br>


                    <!-- studnts Section -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="section-heading">Students</h3>
                        </div>
                        <!-- Student Counts Chart -->
                        <div class="col-lg-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($stdCount); ?></div>
                                            <div>Total Students</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_students.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Student Counts by Course Type</h3>
                                </div>
                                <div class="panel-body">
                                    <canvas id="performance-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Course Enrollment Chart -->
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Training Centers wise Students</h3>
                                </div>
                                <div class="panel-body">
                                    <canvas id="enrollment-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Section -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="section-heading">Courses</h3>
                        </div>
                        <!-- Total Courses -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-book fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($coursesCount); ?></div>
                                            <div>Total Courses</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_courses.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Master Courses -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-graduation-cap fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($master_courses_count); ?></div>
                                            <div>Master Courses</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_master_courses.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Degree Courses -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-graduation-cap fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($degree_courses_count); ?></div>
                                            <div>Degree Courses</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_degree_courses.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Diploma Courses -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-graduation-cap fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($diploma_courses_count); ?></div>
                                            <div>Diploma Courses</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_diploma_courses.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Centers Section -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="section-heading">Centers and Faculties</h3>
                        </div>
                        <!-- Training Centers -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-building fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($training_centers_count); ?></div>
                                            <div>Training Centers</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_training_centers.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Faculties -->
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-chalkboard-teacher fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo htmlspecialchars($faculties_count); ?></div>
                                            <div>Faculties</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_faculties.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include '../../includes/datetime.php'; ?>
        <script>
            $(document).ready(function () {
                // Initialize Chart.js
                var ctx1 = document.getElementById('performance-chart').getContext('2d');
                var performanceChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: ['B.Sc', 'MCA', 'B.E', 'B.Com'],
                        datasets: [{
                            label: 'Student Counts',
                            data: [<?php echo $bsc_count; ?>, <?php echo $msc_count; ?>, <?php echo $bec_count; ?>, <?php echo $bcomc_count; ?>],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                var ctx2 = document.getElementById('enrollment-chart').getContext('2d');
                var enrollmentChart = new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: ['Colombo', 'Kurunagela', 'Kandy', 'Galle', 'Mathara'],
                        datasets: [{
                            label: 'Training Centers wise Students',
                            data: [26547, 12753, 13457, 8751, 11656],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(120, 110, 102, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(60, 60, 60, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            });
        </script>
        <?php
    }
}
?>
<?php include '../../includes/footer.php'; ?>