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
        <?php include ('../../includes/header.php'); ?>
        <?php include ('../controllers/SubjectController.php'); ?>
        <div id="wrapper">

            <!-- Navigation -->
            <?php include '../../includes/sidebar.php'; ?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">View Subjects</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Subject List
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Course</th>
                                                <th>Subject I</th>
                                                <th>Subject II</th>
                                                <th>Subject III</th>
                                                <th>Subject IV</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($subjects as $subject): ?>
                                                <tr>
                                                    <td><b><?php echo $subject['cfull']; ?></b></td>
                                                    <td><?php echo $subject['sub1']; ?></td>
                                                    <td><?php echo $subject['sub2']; ?></td>
                                                    <td><?php echo $subject['sub3']; ?></td>
                                                    <td><?php echo $subject['sub4']; ?></td>
                                                    <td><?php echo $subject['created_date']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php include '../../includes/datetime.php'; ?>


        <script>
            $(document).ready(function () {
                $("#courseTable").DataTable({
                    responsive: true
                });
            });
        </script>


        <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>