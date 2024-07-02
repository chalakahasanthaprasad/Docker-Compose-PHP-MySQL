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
        $Subject = $this->subjectModel->getAllSubjects();
        if ($Subject === false) {
            echo "Error fetching courses.";
            return;
        }
        return $Subject;
    }
}


$subjectController = new SubjectController($connect);
$subjects = $subjectController->viewSubjects();

mysqli_close($connect);
