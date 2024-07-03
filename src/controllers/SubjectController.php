<?php
// controller/SubjectController.php

include ('../../config/dbcon.php');
include ('../models/SubjectModel.php');

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
}


$subjectController = new SubjectController($connect);
$subjects = $subjectController->viewSubjects();

mysqli_close($connect);
