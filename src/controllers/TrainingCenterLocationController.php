<?php
// controller/facultyController.php

include('../../config/dbcon.php');
require_once('../models/InstituteModel.php');

class TrainingCenterLocationController
{
    private $instituteModel;
    public function __construct($db)
    {
        $this->instituteModel = new InstituteModel($db);
    }

    public function viewTrainingCentersLocations()
    {
        $tclocations = $this->instituteModel->getAllTrainingCentersLocations();
        if ($tclocations === false) {
            echo "Error fetching Training Centers Locations.";
            return;
        }
        return $tclocations;
    }

    public function getCenterCode($center_id)
    {
        $lastSubject = $this->instituteModel->getCenterCodeById($center_id);
        return $lastSubject;
    }

}

$trainingCenterLocationController = new trainingCenterLocationController($connect);
$tclocations = $trainingCenterLocationController->viewTrainingCentersLocations();
//mysqli_close($connect);
