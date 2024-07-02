<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time(); // 30 min -  Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {
?>
        <?php include('../../includes/header.php'); ?>
        <div id="wrapper">
            <?php include('../../includes/sidebar.php') ?>;

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header"> <?php echo strtoupper("welcome" . " " . htmlentities($_SESSION['username'])); ?></h4>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- content here -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Student Information
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Class</th>
                                                <th>Age</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Add PHP code here to fetch and display students from the database -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../../includes/datetime.php'; ?>

<?php
    }
}
?>


<?php include '../../includes/footer.php'; ?>