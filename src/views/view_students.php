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
        <?php include('../controllers/StudentController.php'); ?>
        <div id="wrapper">

            <!-- Navigation -->
            <?php include '../../includes/sidebar.php'; ?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">View Students</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Student List
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover"
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Course</th>
                                                <th>Gender</th>
                                                <th>Birth Of Date</th>
                                                <th>Address</th>
                                                <th>Mobile Number</th>
                                                <th>Parents M.Number</th>
                                                <th>Registered Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($students as $student): ?>
                                                <tr>
                                                    <td><b><?php echo $student['std_id']; ?></b></td>
                                                    <td><?php echo $student['std_name']; ?></td>
                                                    <td><?php echo $student['course_code']; ?></td>
                                                    <td><?php echo $student['gender']; ?></td>
                                                    <td><?php echo $student['birthofdate']; ?></td>
                                                    <td><?php echo $student['address']; ?></td>
                                                    <td><?php echo $student['mobile_number']; ?></td>
                                                    <td><?php echo $student['parent_number']; ?></td>
                                                    <td><?php echo $student['registered_date']; ?></td>
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