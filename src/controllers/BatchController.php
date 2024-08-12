<?php
// controller/BatchController.php 

include('../../config/dbcon.php');
include('../models/BatchModel.php');

class BatchController
{
    private $batchModel;

    public function __construct($db)
    {
        $this->batchModel = new BatchModel($db);
    }

    public function LoadBatchesByCenterIdAndFacultyIdAndCourse($centerId, $facultyId, $courseId)
    {
        $batches = $this->batchModel->getBatchesByCenterIdAndFacultyIdAndCoursesId($centerId, $facultyId, $courseId);
        echo json_encode($batches);
        exit;
    }

}

$batchController = new BatchController($connect);
if (isset($_POST['course_id_2'])) {
    $facultyId = $_POST['faculty_id_2'];
    $centerId = $_POST['center_id_2'];
    $courseId = $_POST['course_id_2'];
    $batchController->LoadBatchesByCenterIdAndFacultyIdAndCourse($centerId, $facultyId, $courseId);
}

mysqli_close($connect);
