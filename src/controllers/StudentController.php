<?php
// controller/StudentController.php 

include ('../../config/dbcon.php');
include ('../models/StudentModel.php');

class StudentController
{
    private $studentModel;

    public function __construct($db)
    {
        $this->studentModel = new StudentModel($db);
    }

    public function viewStudents()
    {
        $students = $this->studentModel->getAllStudents();
        if ($students === false) {
            echo "Error fetching student.";
            return;
        }
        return $students;
    }
}


$studentController = new StudentController($connect);
$students = $studentController->viewStudents();
mysqli_close($connect);
