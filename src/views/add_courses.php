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
        <form method="post" id="courseForm" action="../controllers/CourseController.php">
            <div id="wrapper">
                <!-- Navigation -->
                <?php include ('../../includes/sidebar.php') ?>;

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header">
                                <?php echo strtoupper("welcome" . " " . htmlentities($_SESSION['username'])); ?>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Add Course</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Course Short Name<span id=""
                                                            style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" name="course-code" id="course-code"
                                                        required="required" onblur="checkCourseAvailability()">
                                                    <span id="course-availability-status" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Course Full Name<span id=""
                                                            style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" name="course-full" id="course-full"
                                                        required="required">
                                                    <span id="course-status" style="font-size:12px;"></span>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Creation Date</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" value="<?php echo date('d-m-Y'); ?>"
                                                        readonly="readonly" name="cdate">
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-6">
                                                    <br><br>
                                                    <input type="submit" class="btn btn-primary" name="submit"
                                                        value="Create Course">
                                                </div>
                                            </div>
                                        </div>
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
            function checkCourseAvailability() {
                let courseShort = $("#course-code").val();
                $.ajax({
                    url: "../controllers/CourseController.php",
                    type: "POST",
                    data: { cshort: courseShort },
                    success: function (response) {
                        let data = JSON.parse(response);
                        if (!data.available) {
                            $("#course-availability-status").html("<span style='color:red'>Course Code Name Already Exist</span>");
                        } else {
                            $("#course-availability-status").html("<span style='color:green'>Course Code Name Available</span>");
                        }
                    }
                });
            }
        </script>

        <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>