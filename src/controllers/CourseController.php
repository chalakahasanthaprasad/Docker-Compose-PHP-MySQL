<?php
// controller/CourseController.php

include('../../config/dbcon.php');
require_once('../models/CourseModel.php');

class CourseController
{
    private $courseModel;

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
            $created_date = $_POST['cdate'];

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

            $query = $this->courseModel->addCourse($code, $cfullname, $created_date);

            if ($query) {
                echo '<script>alert("Course Added successfully"); window.location.href="../views/add_courses.php";</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_courses.php";</script>';
            }

            exit;
        }

    }
    public function editCourse($cid)
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
        $this->courseModel->deleteCourseById($cid);
        echo '<script>alert("Course deleted")</script>';
        echo '<script>window.location.href="../views/manage_courses.php"</script>';
    }

    public function updateCourse($cid, $cshortname, $cfullname, $udate)
    {
        $this->courseModel->updateCourse($cid, $cshortname, $cfullname, $udate);
        echo '<script>alert("Course updated successfully")</script>';
        echo '<script>window.location.href="../views/manage_courses.php"</script>';
    }


    public function checkCourseCodeAvailability()
    {
        if (isset($_POST['code'])) {
            $code = $_POST['code'];
            $isAvailable = $this->courseModel->isCourseCodeAvailable($code);
            echo json_encode(['available' => $isAvailable]);
        }
    }

    public function checkCourseNameAvailability()
    {
        if (isset($_POST['cfull'])) {
            $cfull = $_POST['cfull'];
            $isAvailable = $this->courseModel->isCourseNameAvailable($cfull);
            echo json_encode(['available' => $isAvailable]);
        }
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
if (isset($_POST['submit']) && isset($_POST['form_id']) && $_POST['form_id'] == 'addcourseForm') {
    $courseController->addCourse();
}

$courses = $courseController->viewCourses();
//mysqli_close($connect);
