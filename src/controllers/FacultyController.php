<?php
// controller/facultyController.php

include('../../config/dbcon.php');
require_once('../models/InstituteModel.php');

class FacultyController
{
    private $instituteModel;
    public function __construct($db)
    {
        $this->instituteModel = new InstituteModel($db);
    }

    public function viewfaculties()
    {
        $faculties = $this->instituteModel->getAllfaculties();
        if ($faculties === false) {
            echo "Error fetching faculties.";
            return;
        }
        return $faculties;
    }

    public function LoadFacultiesByCenterId($centerId)
    {
        $faculties = $this->instituteModel->getFacultiesByCenterId($centerId);
        echo json_encode($faculties);
        exit;
    }

    public function LoadCoursesByCenterIdAndFacultyId($centerId, $facultyId)
    {
        $courses = $this->instituteModel->getCoursesByCenterIdAndFacultyId($centerId, $facultyId);
        echo json_encode($courses);
        exit;
    }

}
$facultyController = new facultyController($connect);

if (isset($_POST['center_id'])) {
    $centerId = $_POST['center_id'];
    $facultyController->LoadFacultiesByCenterId($centerId);
}

if (isset($_POST['faculty_id_2'])) {
    $facultyId = $_POST['faculty_id_2'];
    $centerId = $_POST['center_id_2'];
    $facultyController->LoadCoursesByCenterIdAndFacultyId($centerId, $facultyId);
}

//$faculties = $facultyController->viewfaculties();
mysqli_close($connect);
