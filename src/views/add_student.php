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
        <?php include('../controllers/TrainingCenterLocationController.php'); ?>
        <form method="post" id="addstudentForm" action="../controllers/StudentController.php">
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
                                <div class="panel-heading">Course Details</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="course">Preferred Training Center</label>
                                                <select name="course" id="course" class="form-control">
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
                                                <label for="course">Preferred Faculty</label>
                                                <select name="course" id="course" class="form-control">
                                                    <option value="">Select Faculty</option>
                                                    <?php
                                                    if ($faculties) {
                                                        foreach ($faculties as $faculty) {
                                                            echo '<option value="' . htmlentities($faculty['faculty_id']) . '">' . htmlentities($faculty['faculty_name']) . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">No Faculties available</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="course">Course Program You are Looking For</label>
                                                <select name="course" id="course" class="form-control">
                                                    <option value="">Select Course</option>
                                                    <?php
                                                    if ($courses) {
                                                        foreach ($courses as $course) {
                                                            echo '<option value="' . htmlentities($course['code']) . '">' . htmlentities($course['cfull']) . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">No courses available</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Personal Informations</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label>Title<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select name="title" id="title" class="form-control">
                                                        <option value="">Select Title</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Rev">Rev</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label>Full Name<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input class="form-control" name="name" required="required"
                                                        pattern="[A-Za-z]+$">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label>National Identity Card (NIC) Number<span
                                                            style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="text" id="nic" name="nic" maxlength="12"
                                                        required="required">
                                                    <p id="message"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label>Gender</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="radio" name="gender" id="male" value="Male" checked>
                                                    <label>Male</label>
                                                    <input type="radio" name="gender" id="female" value="Female">
                                                    <label>Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label>Date of birth</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input class="form-control" value="<?php echo date('Y-m-d'); ?>" name="dob">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label>Fluent In</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select name="language" id="language" class="form-control">
                                                        <option value="">Select Language</option>
                                                        <option value="English">English</option>
                                                        <option value="Sinhala">Sinhala</option>
                                                        <option value="Tamil">Tamil</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Contact Informations</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Mobile Number<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="tel" name="mobile" required="required"
                                                        maxlength="10" pattern="[0-9]{10}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Email<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="email" name="email" required="required">
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Parent Mobile Number<span
                                                            style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="tel" name="parent_mobile"
                                                        required="required" maxlength="10" pattern="[0-9]{10}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>City<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="city" id="city" class="form-control">
                                                        <option value="">Select city</option>
                                                        <?php
                                                        if ($cities) {
                                                            foreach ($cities as $city) {
                                                                echo '<option value="' . htmlentities($city['id']) . '">' . htmlentities($city['name']) . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">No courses available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Address<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <textarea class="form-control" rows="3" name="address"
                                                        required="required"></textarea>
                                                </div>
                                            </div>
                                            <br><br>
                                            <br><br>
                                            <div class="col-lg-4">
                                                <label>Registerd Date</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                                    readonly="readonly" name="registerd_date">
                                            </div>
                                            <br><br>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                </div>
                                                <div class="col-lg-6">
                                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                                </div>
                                            </div>
                                            <br><br>
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
        </script>

        <?php
    }
}
?>


<?php include '../../includes/footer.php';


?>