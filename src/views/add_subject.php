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
        <?php include('../controllers/CourseController.php'); ?>
        <?php include('../controllers/SubjectController.php'); ?>
        <form method="post" id="addSubjectForm" action="../controllers/SubjectController.php">
            <div id="wrapper">
                <!-- Navigation -->
                <?php include('../../includes/sidebar.php') ?>;

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
                                <div class="panel-heading">Add New Subject</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label for="course">Select Course<span id=""
                                                            style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="course" id="course" class="form-control">
                                                        <option value="">Select Course</option>
                                                        <?php
                                                        if ($courses) {
                                                            foreach ($courses as $course) {
                                                                echo '<option value="' . htmlentities($course['cid']) . '">' . htmlentities($course['cfull']) . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">No courses available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <div id="last-subject-code" style="font-size:12px; font-weight: bold;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Subject Full Name<span id=""
                                                            style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" name="sbjname" id="sbjname" required="required"
                                                        onblur="checkSubjectAvailability()">
                                                    <span id="subject-availability-status" style="font-size:12px;"></span>
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
                                                        value="Create Subject">
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
            function checkSubjectAvailability() {
                let subjectName = $("#sbjname").val();
                $.ajax({
                    url: "../controllers/SubjectController.php",
                    type: "POST",
                    data: { sbjname: subjectName },
                    success: function (response) {
                        let data = JSON.parse(response);
                        if (!data.available) {
                            $("#subject-availability-status").html("<span style='color:red'>Course Code Already Exist</span>");
                        } else {
                            $("#subject-availability-status").html("<span style='color:green'>Course Code Available</span>");
                        }
                    }
                });
            }

            // Fetch and display the last registered subject code for the selected course
            $(document).ready(function () {
                $("#course").change(function () {
                    let courseCode = $(this).val();
                    if (courseCode) {
                        $.ajax({
                            url: "../controllers/CourseController.php",
                            type: "POST",
                            data: { course_code: courseCode },
                            success: function (response) {
                                console.log("AJAX response:", response); // Debugging line
                                let data = JSON.parse(response);
                                if (data && data.subject_code) {
                                    $("#last-subject-code").text("Last Registered Subject Code: " + data.subject_code);
                                } else {
                                    $("#last-subject-code").text("No subjects registered for this course.");
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX error:", status, error); // Error handling
                            }
                        });
                    } else {
                        $("#last-subject-code").text("");
                    }
                });
            });

        </script>
        <?php
    }
}
?>
<?php include '../../includes/footer.php';
?>