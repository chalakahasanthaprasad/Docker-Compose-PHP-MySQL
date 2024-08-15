<?php
// controller/BatchController.php 

include('../../config/dbcon.php');
include('../models/BatchModel.php');
require_once('../controllers/CourseController.php');
require_once('../controllers/TrainingCenterLocationController.php');

class BatchController
{
    private $batchModel;
    private $courseController;
    private $trainingCenterLocationController;

    public function __construct($db)
    {
        $this->batchModel = new BatchModel($db);
        $this->courseController = new CourseController($db);
        $this->trainingCenterLocationController = new TrainingCenterLocationController($db);
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
            $course_id = $_POST['course'];
            $course_type = $_POST['course_type'];
            $faculty_id = $_POST['faculty'];
            $center_id = $_POST['tcenter'];
            $batch_year = $_POST['start_year'];
            $estart_date = $_POST['start_date'];
            $eend_date = $_POST['end_date'];
            $this->generate_BatchCode($center_id, $course_id, $course_type, $batch_year);
            // $query = $this->batchModel->addBatch($course_id, $faculty_id, $center_id, $batch_year, $estart_date, $eend_date);

            // if ($query) {
            //     echo '<script>alert("batch Added successfully"); window.location.href="../views/add_batch.php";</script>';
            // } else {
            //     echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_batch.php";</script>';
            // }

            // exit;
        }

    }

    public function generate_BatchCode($center_id, $course_id, $course_type, $batch_year)
    {
        $course = $this->courseController->loadCourseById($course_id);
        $course_code = $course['code']; // MCA

        $center = $this->trainingCenterLocationController->getCenterCode($center_id);
        $center_code = $center['c_code'];

        $lastTwoDigitsYear = substr($batch_year, -2);

        $batch_code_v1 = $center_code . '' . $course_code . '' . $lastTwoDigitsYear;

        echo json_encode(['available' => $batch_code_v1]);
        //echo json_encode(['available' => $course['code']]);
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
