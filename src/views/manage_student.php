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
        <form method="post" id="studentForm" action="../controllers/StudentController.php">
            <div id="wrapper">
                <!-- Navigation -->
                <?php include('../../includes/sidebar.php') ?>;

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header"><?php echo strtoupper("welcome " . htmlentities($_SESSION['username'])); ?>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Manage Courses</div>
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Course</th>
                                                    <th>Gender</th>
                                                    <th>Birth Of Date</th>
                                                    <th>Address</th>
                                                    <th>Mobile Number</th>
                                                    <th>Parents M.Number</th>
                                                    <th>Registered Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1;
                                                foreach ($students as $student) { ?>
                                                    <tr class="odd gradeX">
                                                        <!-- <td><?php echo $sn; ?></td> -->
                                                        <td><b><?php echo $student['std_id']; ?></b></td>
                                                        <td><?php echo $student['std_name']; ?></td>
                                                        <td><?php echo $student['course_code']; ?></td>
                                                        <td><?php echo $student['gender']; ?></td>
                                                        <td><?php echo $student['birthofdate']; ?></td>
                                                        <td><?php echo $student['address']; ?></td>
                                                        <td><?php echo $student['mobile_number']; ?></td>
                                                        <td><?php echo $student['parent_number']; ?></td>
                                                        <td><?php echo $student['registered_date']; ?></td>
                                                        <td>
                                                            <a href="edit_student.php?action=edit&cid=<?php echo htmlentities($student['std_id']); ?>"
                                                                class="btn btn-primary">Edit</a>
                                                            <a href="edit_student.php?action=delete&cid=<?php echo htmlentities($student['std_id']); ?>"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Do you really want to delete?');">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php $sn++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php include '../../includes/datetime.php'; ?>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
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