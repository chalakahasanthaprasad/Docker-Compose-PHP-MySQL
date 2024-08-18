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
        <?php require_once('../controllers/CourseController.php'); ?>
        <?php require_once('../controllers/FacultyController.php'); ?>
        <?php require_once('../controllers/BatchController.php'); ?>
        <?php require_once('../controllers/TrainingCenterLocationController.php'); ?>
        <form method="post" id="addbatchForm" action="../controllers/BatchController.php">
            <div id="wrapper">
                <?php include('../../includes/sidebar.php'); ?>
                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header"><?php echo strtoupper("welcome " . htmlentities($_SESSION['username'])); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php include '../../includes/datetime.php'; ?>
    <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>