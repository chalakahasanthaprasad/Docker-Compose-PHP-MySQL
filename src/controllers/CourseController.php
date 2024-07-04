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

    public function addCourse()
    {
        if (isset($_POST['submit'])) {
            $code = $_POST['course-short'];
            $cfullname = $_POST['course-full'];
            $created_date = $_POST['cdate'];

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
$courseController->addCourse();
mysqli_close($connect);
