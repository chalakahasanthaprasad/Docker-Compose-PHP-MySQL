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

    public function registerStudent()
    {
        if (isset($_POST['submit'])) {

            $data = [

                'fname' => $_POST['name'],
                'course' => $_POST['course'],
                'gender' => $_POST['gender'],
                'address' => $_POST['address'],
                'dob' => $_POST['dob'],
                'mobile' => $_POST['mobile'],
                'parent_mobile' => $_POST['parent_mobile'],
                'regdate' => $_POST['registerd_date'],
                'city' => $_POST['city']
            ];

            // Encode the data as JSON
            $jsonData = json_encode($data);

            // Output the JSON data to the browser's console
            echo "<script>console.log($jsonData);</script>";

            if ($this->studentModel->registerStudent($data)) {
                echo '<script>alert("Student Registration successful "); window.location.href="../views/add_student.php";</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_student.php";</script>';
            }
        }
    }
}

$studentController = new StudentController($connect);
$students = $studentController->viewStudents();
$studentController->registerStudent();
mysqli_close($connect);
