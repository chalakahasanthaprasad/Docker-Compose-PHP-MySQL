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

    public function addBatch()
    {
        if (isset($_POST['submit'])) {
            $batch_code = $_POST['cdate'];
            $course_id = $_POST['course'];
            $faculty_id = $_POST['faculty'];
            $center_id = $_POST['center_id'];
            $batch_year = $_POST['cdate'];
            $estart_date = $_POST['cdate'];
            $eend_date = $_POST['cdate'];
            $query = $this->batchModel->addBatch($batch_code, $course_id, $faculty_id, $center_id, $batch_year, $estart_date, $eend_date);

            if ($query) {
                echo '<script>alert("batch Added successfully"); window.location.href="../views/add_batch.php";</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_batch.php";</script>';
            }

            exit;
        }

    }

}

$batchController = new BatchController($connect);
$batchController->addBatch();

if (isset($_POST['course_id_2'])) {
    $facultyId = $_POST['faculty_id_2'];
    $centerId = $_POST['center_id_2'];
    $courseId = $_POST['course_id_2'];
    $batchController->LoadBatchesByCenterIdAndFacultyIdAndCourse($centerId, $facultyId, $courseId);
}

mysqli_close($connect);
