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
            list($batch_code_v2, $isPosibble) = $this->generate_BatchCode($center_id, $course_id, $course_type, $batch_year);
            if ($isPosibble == 1) {
                $student_count = 0;
                $query = $this->batchModel->addBatch($batch_code_v2, $course_id, $faculty_id, $center_id, $student_count, $batch_year, $estart_date, $eend_date);

                if ($query) {
                    echo '<script>alert("batch Added successfully"); window.location.href="../views/add_batch.php";</script>';
                } else {
                    echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_batch.php";</script>';
                }

                exit;
            } else {

            }

        }

    }

    public function generate_BatchCode($center_id, $course_id, $course_type, $batch_year)
    {
        $isPosibble = 0;
        $course = $this->courseController->loadCourseById($course_id);
        $course_code = $course['code']; // MCA

        $center = $this->trainingCenterLocationController->getCenterCode($center_id);
        $center_code = $center['c_code'];

        $lastTwoDigitsYear = substr($batch_year, -2);

        $batch_code_v1 = $center_code . '' . $course_code . '' . $lastTwoDigitsYear;

        $searchResult = $this->batchModel->searchBatchCodeByCode($batch_code_v1, $course_type);

        $result = $this->getMaxBatchCode($searchResult, $batch_code_v1, $course_type);

        if ($result == 3) {
            $batch_code_v1 = "Nan";
            echo '<script>alert("Already have 3 batches"); window.location.href="../views/add_batch.php";</script>';
            exit;
        } else {
            $batch_code_v2 = $center_code . '' . $course_code . '' . $lastTwoDigitsYear . '' . $result + 1 . '' . $course_type;
            $isPosibble = 1;
        }

        echo json_encode(['available' => $batch_code_v2]);
        //echo json_encode(['available' => $searchResult]);
        //echo json_encode(['available' => $course['code']]);
        return [$batch_code_v2, $isPosibble];
    }

    function getMaxBatchCode($batches, $batch_code_v1, $course_type)
    {
        $maxBatchCode = '';
        $lastNumber = 0;
        foreach ($batches as $batch) {
            // Check if the batch code matches the pattern 
            if (strpos($batch['batch_code'], $batch_code_v1) === 0 && substr($batch['batch_code'], -1) === $course_type) {
                // Compare batch codes to find the maximum
                if ($batch['batch_code'] > $maxBatchCode) {
                    $maxBatchCode = $batch['batch_code'];
                    $lastNumber = substr($maxBatchCode, -2, 1);
                }
            }
        }

        return $lastNumber;
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
