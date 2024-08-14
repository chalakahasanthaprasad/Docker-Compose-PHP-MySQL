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
        <?php include('../controllers/CityController.php'); ?>
        <?php include('../controllers/FacultyController.php'); ?>
        <?php include('../controllers/BatchController.php'); ?>
        <?php include('../controllers/TrainingCenterLocationController.php'); ?>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Create New Batch</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="tcenter">Training Center</label>
                                                <select name="tcenter" id="tcenter" class="form-control">
                                                    <option value="">Select Training Center</option>
                                                    <?php
                                                    if ($tclocations) {
                                                        foreach ($tclocations as $tclocation) {
                                                            echo '<option value="' . htmlentities($tclocation['center_id']) . '">' . htmlentities($tclocation['center_name']) . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">No Training Center available</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="faculty">Faculty</label>
                                                <select id="d_faculty" name="faculty" class="form-control">
                                                    <option>Select Faculty</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="course">Course Program</label>
                                                <select id="d_courses" name="course" class="form-control">
                                                    <option value="">Select Programme</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-lg-4">
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-success" name="submit">Create</button>
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
            document.getElementById('nic').addEventListener('input', function () {
                const nicInput = document.getElementById('nic').value;
                const messageElement = document.getElementById('message');

                // Regex patterns for NIC numbers
                const oldNicPattern = /^[0-9]{9}[vVxX]$/;
                const newNicPattern = /^[0-9]{12}$/;

                // Check if the NIC number matches either pattern
                if (oldNicPattern.test(nicInput) || newNicPattern.test(nicInput)) {
                    messageElement.textContent = '  Valid NIC number!';
                    messageElement.className = 'success';
                    messageElement.style.color = 'green';
                } else {
                    messageElement.textContent = '  Invalid NIC number. Please enter a valid NIC.';
                    messageElement.className = 'error';
                    messageElement.style.color = 'red';
                }
            });

            // Fetch and display the all faculties by trainnig center id wise
            $(document).ready(function () {
                $("#tcenter").change(function () {
                    let centerId = $(this).val();
                    if (centerId) {
                        $.ajax({
                            url: "../controllers/FacultyController.php",
                            type: "POST",
                            data: { center_id: centerId },
                            success: function (response) {
                                console.log("Faculty AJAX response:", response); // Debugging line
                                let facultyData = JSON.parse(response);
                                let $facultyDropdown = $("#d_faculty");
                                $facultyDropdown.empty(); // Clear existing options
                                if (facultyData && facultyData.length > 0) {
                                    facultyData.forEach(function (faculty) {
                                        $facultyDropdown.append(
                                            $("<option></option>")
                                                .attr("value", faculty.faculty_id)
                                                .text(faculty.faculty_name)
                                        );
                                    });
                                } else {
                                    $facultyDropdown.append(
                                        $("<option></option>")
                                            .attr("value", "")
                                            .text("No faculty available")
                                    );
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

            // Fetch and display the all courses by trainnig center and faculty id wise
            $(document).ready(function () {
                // Assuming you already have code to capture and set the centerId variable
                let centerId = $("#tcenter").val();

                $("#d_faculty").change(function () {
                    let facultyId = $(this).val();
                    if (facultyId && centerId) {
                        $.ajax({
                            url: "../controllers/FacultyController.php",
                            type: "POST",
                            data: { faculty_id_2: facultyId, center_id_2: centerId },
                            success: function (response) {
                                console.log("Courses AJAX response:", response); // Debugging line
                                let courseData = JSON.parse(response);
                                let $courseDropdown = $("#d_courses");
                                $courseDropdown.empty(); // Clear existing options

                                if (courseData && courseData.length > 0) {
                                    $courseDropdown.append($("<option></option>").attr("value", "").text("Select Course"));
                                    courseData.forEach(function (course) {
                                        $courseDropdown.append(
                                            $("<option></option>")
                                                .attr("value", course.cid)
                                                .text(course.cfull)
                                        );
                                    });
                                } else {
                                    $courseDropdown.append(
                                        $("<option></option>")
                                            .attr("value", "")
                                            .text("No courses available")
                                    );
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("Courses AJAX error:", status, error); // Error handling
                            }
                        });
                    } else {
                        $("#d_courses").empty(); // Clear the courses dropdown if no faculty or center is selected
                    }
                });

                // Optional: Update the centerId variable when the center dropdown changes
                $("#tcenter").change(function () {
                    centerId = $(this).val();
                    $("#d_faculty").trigger('change'); // Trigger change on faculty dropdown to refresh courses
                });
            });


            // Fetch and display the all courses by trainnig center and faculty id wise
            $(document).ready(function () {
                // Assuming you already have code to capture and set the centerId variable
                let centerId = $("#tcenter").val();
                let facultyId = $("#d_faculty").val();

                $("#d_courses").change(function () {
                    let courseId = $(this).val();
                    //console.log("Batch AJAX response:", centerId, facultyId, courseId);
                    if (facultyId && centerId && courseId) {
                        $.ajax({
                            url: "../controllers/BatchController.php",
                            type: "POST",
                            data: { faculty_id_2: facultyId, center_id_2: centerId, course_id_2: courseId },
                            success: function (response) {
                                console.log("Batch AJAX response:", response); // Debugging line

                                let batchData = JSON.parse(response);
                                let $batchDropdown = $("#d_batches");
                                $batchDropdown.empty(); // Clear existing options

                                if (batchData && batchData.length > 0) {
                                    $batchDropdown.append($("<option></option>").attr("value", "").text("Select Batch"));
                                    batchData.forEach(function (batch) {
                                        $batchDropdown.append(
                                            $("<option></option>")
                                                .attr("value", batch.batch_id)
                                                .text(batch.batch_code)
                                        );
                                    });
                                } else {
                                    $batchDropdown.append(
                                        $("<option></option>")
                                            .attr("value", "")
                                            .text("No batches available")
                                    );
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("Batches AJAX error:", status, error); // Error handling
                            }
                        });
                    } else {
                        $("#d_courses").empty(); // Clear the courses dropdown if no faculty or center is selected
                    }
                });

                // Update the centerId variable when the center dropdown changes
                $("#tcenter").change(function () {
                    centerId = $(this).val();
                    $("#d_courses").trigger('change');
                });

                // Update the facultyId variable when the faculty dropdown changes
                $("#d_faculty").change(function () {
                    facultyId = $(this).val(); // Update the facultyId
                    $("#d_courses").trigger('change'); // Trigger change event to update batches
                });
            });

        </script>

        <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>