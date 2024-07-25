<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time(); // Checking the time now when the home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {
        ?>
        <?php include('../../includes/header.php'); ?>
        <?php include('../controllers/CourseController.php'); ?>
        <?php include('../controllers/SubjectController.php'); ?>
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
                                    <!-- Dropdown Menu -->
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <input type="hidden" name="form_id" value="addSubjectForm">
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
                                    <br><br><br>
                                    <div class="col-lg-10">
                                        <div id="subject-table"></div>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
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
                $("#course").change(function () {
                    let courseCode = $(this).val();
                    if (courseCode) {
                        $.ajax({
                            url: "../controllers/SubjectController.php",
                            type: "POST",
                            data: { course_code: courseCode },
                            success: function (response) {
                                console.log("AJAX response:", response); // Debugging line
                                let data = JSON.parse(response);
                                if (data && data.length > 0) {
                                    let tableHTML = `<table id="subjects-table" class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Subject Code</th>
                                                                                <th>Subject Name</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>`;
                                    data.forEach(function (subject) {
                                        tableHTML += `<tr>
                                                                        <td>${subject.subject_code}</td>
                                                                        <td>${subject.subject_name}</td>
                                                                      </tr>`;
                                    });
                                    tableHTML += `</tbody></table>`;
                                    $("#subject-table").html(tableHTML);
                                    $('#subjects-table').DataTable(); // Initialize DataTables
                                } else {
                                    $("#subject-table").html("<p>No subjects registered for this course.</p>");
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX error:", status, error); // Error handling
                            }
                        });
                    } else {
                        $("#subject-table").html("");
                    }
                });
            });


        </script>

        <?php
    }
}
?>

<?php include '../../includes/footer.php'; ?>