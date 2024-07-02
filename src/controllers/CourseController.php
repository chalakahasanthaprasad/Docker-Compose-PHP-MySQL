<?php
// controller/CourseController.php

include('../../config/dbcon.php');
include('../models/CourseModel.php');

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
}


$courseController = new CourseController($connect);
$courses = $courseController->viewCourses();
mysqli_close($connect);
