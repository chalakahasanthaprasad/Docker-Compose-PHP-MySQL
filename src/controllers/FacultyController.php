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

}


$facultyController = new facultyController($connect);
$faculties = $facultyController->viewfaculties();
mysqli_close($connect);
