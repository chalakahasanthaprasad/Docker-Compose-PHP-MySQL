<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time(); // 30 min -  Checking the time now when home page starts.

    require_once('../controllers/CourseController.php');
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $cid = isset($_GET['cid']) ? intval($_GET['cid']) : null;
        // echo 'console.log(' . json_encode($action) . ');';
        switch ($action) {
            case 'edit':
                $course = $courseController->editCourse($cid);
                break;
            case 'delete':
                $courseController->deleteCourse($cid);
                break;
        }
    } else {
        $courseController->viewCourses();
    }

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {
        ?>
        <?php include('../../includes/header.php'); ?>
        <?php require_once('../controllers/CourseController.php'); ?>
        <form method="post" id="updatecourseForm" action="../controllers/CourseController.php">
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
                                <div class="panel-heading">Edit Course</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <?php

                                            if ($courses) { ?>
                                                <div class="form-group">
                                                    <input type="hidden" name="form_id" value="updatecourseForm">
                                                    <div class="col-lg-4">
                                                        <label>Course Short Name<span
                                                                style="font-size:11px;color:red">*</span></label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="hidden" class="form-control" name="cid" id="cid"
                                                            value="<?php echo $course['cid']; ?>" required="required">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input class="form-control" name="code" id="code"
                                                            value="<?php echo $course['code']; ?>" required="required"
                                                            onblur="checkCourseCodeAvailability()">
                                                        <span id="course-code-availability-status" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <label>Course Full Name<span
                                                                style="font-size:11px;color:red">*</span></label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input class="form-control" name="cfull" id="cfull"
                                                            value="<?php echo $course['cfull']; ?>" required="required"
                                                            onblur="checkCourseNameAvailability()">
                                                        <span id="course-name-availability-status" style="font-size:12px;"></span>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <label>Course Level<span style="font-size:11px;color:red">*</span></label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <select id="course_level" name="course_level" class="form-control" required>
                                                            <option value="Certificate" <?php echo $course['course_level'] === 'Certificate' ? 'selected' : ''; ?>>
                                                                Certificate</option>
                                                            <option value="Diploma" <?php echo $course['course_level'] === 'Diploma' ? 'selected' : ''; ?>>Diploma</option>
                                                            <option value="Higher National Diploma" <?php echo $course['course_level'] === 'Higher National Diploma' ? 'selected' : ''; ?>>Higher National Diploma</option>
                                                            <option value="Degree" <?php echo $course['course_level'] === 'Degree' ? 'selected' : ''; ?>>Degree</option>
                                                            <option value="Master" <?php echo $course['course_level'] === 'Master' ? 'selected' : ''; ?>>Master</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <label>Last Updated Date</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input class="form-control" value="<?php echo date('d-m-Y'); ?>"
                                                            readonly="readonly" name="udate">
                                                    </div>
                                                </div>
                                                <br><br>
                                            <?php } else { ?>
                                                <h5 style="color:red;" align="center">No record found</h5>
                                            <?php } ?>
                                            <div class="form-group">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-6"><br><br>
                                                    <input type="submit" class="btn btn-primary" name="submit" value="update">
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
            function checkCourseCodeAvailability() {
                let courseShort = $("#code").val();
                $.ajax({
                    url: "../controllers/CourseController.php",
                    type: "POST",
                    data: { code: courseShort },
                    success: function (response) {
                        let data = JSON.parse(response);
                        if (!data.available) {
                            $("#course-code-availability-status").html("<span style='color:red'>Course Code Already Exist</span>");
                        } else {
                            $("#course-code-availability-status").html("<span style='color:green'>Course Code Available</span>");
                        }
                    }
                });
            }

            function checkCourseNameAvailability() {
                let courseName = $("#cfull").val();
                $.ajax({
                    url: "../controllers/CourseController.php",
                    type: "POST",
                    data: { cfull: courseName },
                    success: function (response) {
                        let data = JSON.parse(response);
                        if (!data.available) {
                            $("#course-name-availability-status").html("<span style='color:red'>Course Name Already Exist</span>");
                        } else {
                            $("#course-name-availability-status").html("<span style='color:green'>Course Name Available</span>");
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