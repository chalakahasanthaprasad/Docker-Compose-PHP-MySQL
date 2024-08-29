<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
} else {
    $now = time(); // 30 min -  Checking the time now when home page starts.

    require_once('../controllers/StudentController.php');
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $sid = isset($_GET['sid']) ? intval($_GET['sid']) : null;
        switch ($action) {
            case 'edit':
                $student = $studentController->LoadStudentById($sid);
                break;
            case 'delete':
                $studentController->deleteStudent($sid);
                break;
        }
    } else {
        $studentController->viewStudents();
    }


    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired! <a href='http://localhost/src/views/login.php'>Login here</a>";
    } else {
        ?>
        <?php require_once('../../includes/header.php'); ?>
        <?php require_once('../controllers/CourseController.php'); ?>
        <?php require_once('../controllers/CityController.php'); ?>
        <?php require_once('../controllers/FacultyController.php'); ?>
        <?php require_once('../controllers/BatchController.php'); ?>
        <?php require_once('../controllers/TrainingCenterLocationController.php'); ?>
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
                                <div class="panel-heading">
                                    <strong>Index No : <?php echo $student['std_index']; ?>
                                    </strong>
                                </div>
                            </div>
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
                                                <label for="tcenter">Training Center</label>
                                                <select name="tcenter" id="tcenter" class="form-control">
                                                    <option value="">Select Training Center</option>
                                                    <?php
                                                    if ($tclocations) {
                                                        foreach ($tclocations as $tclocation) {
                                                            $selected = ($tclocation['center_id'] == $student['tcenter_id']) ? 'selected' : '';
                                                            echo '<option value="' . htmlentities($tclocation['center_id']) . '" ' . $selected . '>' . htmlentities($tclocation['center_name']) . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">No Training Center available</option>';
                                                    }
                                                    $tcenterId = $student['tcenter_id'];
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="faculty">Faculty</label>
                                                <select id="d_faculty" name="faculty" class="form-control"
                                                    data-selected-faculty-id="<?php echo $student['faculty_id']; ?>">
                                                    <option>Select Faculty</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="course">Course Program</label>
                                                <select id="d_courses" name="course" class="form-control">
                                                    <option value="">Select Programme</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label for="batch">Enroll for which batch</label>
                                                <select id="d_batches" name="batch" class="form-control">
                                                    <option value="">Select Batch</option>
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
                                                        <option value="Mr" <?php echo $student['title'] == 'Mr' ? 'selected' : ''; ?>>Mr</option>
                                                        <option value="Mrs" <?php echo $student['title'] == 'Mrs' ? 'selected' : ''; ?>>Mrs</option>
                                                        <option value="Miss" <?php echo $student['title'] == 'Miss' ? 'selected' : ''; ?>>Miss</option>
                                                        <!-- <option value="Rev" <?php echo $student['title'] == 'Rev' ? 'selected' : ''; ?>>Rev</option> -->
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
                                                        value="<?php echo $student['std_name']; ?>">
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
                                                        required="required" value="<?php echo $student['nic_no']; ?>">
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
                                                    <input type="radio" name="gender" id="male" value="Male" <?php if ($student['gender'] == 'Male')
                                                        echo 'checked'; ?>>
                                                    <label for="male">Male</label>
                                                    <input type="radio" name="gender" id="female" value="Female" <?php if ($student['gender'] == 'Female')
                                                        echo 'checked'; ?>>
                                                    <label for="female">Female</label>
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
                                                    <input class="form-control" value="<?php echo $student['birthofdate']; ?>"
                                                        name="dob">
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
                                                        <option value="English" <?php echo $student['f_language'] == 'English' ? 'selected' : ''; ?>>English</option>
                                                        <option value="Sinhala" <?php echo $student['f_language'] == 'Sinhala' ? 'selected' : ''; ?>>Sinhala</option>
                                                        <!-- <option value="Tamil" <?php echo $student['f_language'] == 'Tamil' ? 'selected' : ''; ?>>Tamil</option> -->
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
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        value="<?php echo $student['mobile_number']; ?>">
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Email<span style="font-size:11px;color:red">*</span></label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="email" name="email" required="required"
                                                        value="<?php echo $student['email']; ?>">
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
                                                        required="required" maxlength="10" pattern="[0-9]{10}"
                                                        value="<?php echo $student['parent_number']; ?>">
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
                                                                $selected = ($city['id'] == $student['city_id']) ? 'selected' : '';
                                                                echo '<option value="' . htmlentities($city['id']) . '" ' . $selected . '>' . htmlentities($city['name']) . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">No city available</option>';
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
                                                        required="required"><?php echo $student['address']; ?></textarea>
                                                </div>
                                            </div>
                                            <br><br>
                                            <br><br>
                                            <div class="col-lg-4">
                                                <label>Registerd Date</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-control" value="<?php echo $student['registered_date']; ?>"
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