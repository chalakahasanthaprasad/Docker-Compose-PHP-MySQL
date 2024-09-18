<?php
// controller/CourseController.php

include('../../config/dbcon.php');
require_once('../models/CourseModel.php');
require_once('../helpers/validation.php');

class CourseController
{
    private $courseModel;
    private $dv_course;
    public function __construct($db)
    {
        $this->courseModel = new CourseModel($db);
    }

    public function viewCourses()
    {
        $courses = $this->courseModel->getAllCourses();
        if ($courses === false) {
            echo "Error fetching courses.";
            return;
        }
        return $courses;
    }

    public function addCourse()
    {
        if (isset($_POST['submit'])) {
            $code = $_POST['code'];
            $cfullname = $_POST['cfull'];
            $courselevel = $_POST['course_level'];
            $created_date = $_POST['cdate'];


            $errors = [];
            $code_result = validate_input($code, "Course Code");
            if ($code_result !== true) {
                $errors[] = $code_result;
            }

            $cfullname_result = validate_input($cfullname, "Course Full Name");
            if ($cfullname_result !== true) {
                $errors[] = $cfullname_result;
            }

            $courselevel_result = validate_input($courselevel, "Course Level");
            if ($courselevel_result !== true) {
                $errors[] = $courselevel_result;
            }

            if (empty($created_date)) {
                $errors[] = "Created Date cannot be empty.";
            } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $created_date)) {
                $errors[] = "Created Date format should be YYYY-MM-DD.";
            }

            if (!empty($errors)) {

                if (!empty($errors)) {
                    $all_errors = implode("\\n", $errors);
                    echo '<script>alert("' . $all_errors . '"); window.location.href="../views/add_courses.php";</script>';
                }
            } else {
                if (!$this->courseModel->isCourseCodeAvailable($code)) {
                    echo '<script>alert("Course Code Already Exist")</script>';
                    echo '<script>window.location.href="../views/add_courses.php";</script>';
                    exit;
                }
                if (!$this->courseModel->isCourseNameAvailable($cfullname)) {
                    echo '<script>alert("Course Name Already Exist")</script>';
                    echo '<script>window.location.href="../views/add_courses.php";</script>';
                    exit;
                }

                $code = strtoupper($_POST['code']);
                if (preg_match('/^[A-Z0-9]+$/', $code)) {
                    $query = $this->courseModel->addCourse($code, $cfullname, $courselevel, $created_date);
                    if ($query) {
                        echo '<script>alert("Course Added successfully"); window.location.href="../views/add_courses.php";</script>';
                    } else {
                        echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_courses.php";</script>';
                    }
                    exit;

                } else {
                    echo '<script>alert("Invalid code: Only letters and numbers are allowed. No spaces or special characters."); window.location.href="../views/add_courses.php";</script>';
                    exit;
                }
            }
        }
    }
    public function loadCourseById($cid)
    {
        $course = $this->courseModel->getCourseById($cid);
        if ($course === false) {
            echo "Error fetching courses.";
            return;
        }
        return $course;
    }

    public function deleteCourse($cid)
    {
        $deleteSuccess = $this->courseModel->softDeleteCourseById($cid);
        $message = $deleteSuccess ? 'Course deleted successfully!' : 'Failed to deleted course.';
        echo "<script>alert('$message');</script>";
        echo '<script>window.location.href="../views/manage_courses.php"</script>';
    }

    public function updateCourse($cid, $cshortname, $cfullname, $udate)
    {
        $dv_course = $this->loadCourseById($cid);
        if ($dv_course['code'] !== $cshortname || $dv_course['cfull'] !== $cfullname) {
            $this->courseModel->updateCourse($cid, $cshortname, $cfullname, $udate);
            echo '<script>alert("Course updated successfully ")</script>';
            echo '<script>window.location.href="../views/manage_courses.php"</script>';
        } else {
            // echo '<script>alert("Nothing Change ' . $dv_course['code'] . '|| ' . $cshortname . '")</script>';
            echo '<script>window.location.href="../views/manage_courses.php"</script>';
        }
    }

    public function deactivateCourse($cid)
    {
        $deactivationSuccess = $this->courseModel->deactivateCourse($cid);
        $message = $deactivationSuccess ? 'Course deactivated successfully!' : 'Failed to deactivate course.';
        echo "<script>alert('$message');</script>";
        echo '<script>window.location.href="../views/manage_courses.php"</script>';
    }


    public function checkCourseCodeAvailability()
    {
        if (isset($_POST['code'])) {
            $code = $_POST['code'];
            $isAvailable = $this->courseModel->isCourseCodeAvailable($code);
            //echo json_encode(['available' => $isAvailable]);
        }
    }

    public function checkCourseNameAvailability()
    {
        if (isset($_POST['cfull'])) {
            $cfull = $_POST['cfull'];
            $isAvailable = $this->courseModel->isCourseNameAvailable($cfull);
            //echo json_encode(['available' => $isAvailable]);
        }
    }
    public function getLastSubject($courseCode)
    {
        $lastSubject = $this->courseModel->getLastSubjectByCourse($courseCode);
        echo json_encode($lastSubject);
        exit;
    }


}


$courseController = new CourseController($connect);

// Handle AJAX request
if (isset($_POST['code'])) {
    $courseController->checkCourseCodeAvailability();
}
if (isset($_POST['cfull'])) {
    $courseController->checkCourseNameAvailability();
}

if (isset($_POST['submit']) && isset($_POST['form_id']) && $_POST['form_id'] == 'updatecourseForm') {
    $cid = $_POST['cid'];
    $cshortname = $_POST['code'] ?? null;
    $cfullname = $_POST['cfull'] ?? null;
    $udate = $_POST['udate'] ?? null;
    $courseController->updateCourse($cid, $cshortname, $cfullname, $udate);

}
if (isset($_POST['deactivate']) && $_POST['form_id'] == 'updatecourseForm') {
    $cid = $_POST['cid'];
    $courseController->deactivateCourse($cid);

}
if (isset($_POST['submit']) && isset($_POST['form_id']) && $_POST['form_id'] == 'addcourseForm') {
    $courseController->addCourse();
}

if (isset($_POST['course_code'])) {
    $courseCode = $_POST['course_code'];
    $courseController->getLastSubject($courseCode);
}

$courses = $courseController->viewCourses();
//mysqli_close($connect);
