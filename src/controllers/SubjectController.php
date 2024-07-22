<?php
// controller/SubjectController.php

include('../../config/dbcon.php');
include('../models/SubjectModel.php');

class SubjectController
{
    private $subjectModel;

    public function __construct($db)
    {
        $this->subjectModel = new SubjectModel($db);
    }

    public function viewSubjects()
    {
        $Subjects = $this->subjectModel->getAllSubjects();
        if ($Subjects === false) {
            echo "Error fetching subject.";
            return;
        }
        return $Subjects;
    }

    public function checkSubjectAvailability()
    {
        if (isset($_POST['sbjname'])) {
            $sname = $_POST['sbjname'];
            $isAvailable = $this->subjectModel->isSubjectAvailable($sname);
            echo json_encode(['available' => $isAvailable]);
        }
    }
}


$subjectController = new SubjectController($connect);
//$subjects = $subjectController->viewSubjects();

// Handle AJAX request
if (isset($_POST['sbjname'])) {
    $subjectController->checkSubjectAvailability();
}

mysqli_close($connect);
