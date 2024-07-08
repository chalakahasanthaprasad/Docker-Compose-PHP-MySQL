<?php
// controller/CourseController.php

include ('../../config/dbcon.php');
include ('../models/CourseModel.php');

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


    public function checkCourseAvailability()
    {
        if (isset($_POST['cshort'])) {
            $code = $_POST['cshort'];
            $isAvailable = $this->courseModel->isCourseAvailable($code);
            echo json_encode(['available' => $isAvailable]);
        }
    }

    public function addCourse()
    {
        if (isset($_POST['submit'])) {
            $code = $_POST['course-code'];
            $cfullname = $_POST['course-full'];
            $created_date = $_POST['cdate'];

            if (!$this->courseModel->isCourseAvailable($code)) {
                echo '<script>alert("Course Code Name Already Exist")</script>';
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

}


$courseController = new CourseController($connect);
$courses = $courseController->viewCourses();

// Handle AJAX request
if (isset($_POST['cshort'])) {
    $courseController->checkCourseAvailability();
} else {
    $courseController->addCourse();
}

mysqli_close($connect);
