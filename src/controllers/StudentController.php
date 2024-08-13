<?php
// controller/StudentController.php 

require_once('../../config/dbcon.php');
require_once('../models/StudentModel.php');
require_once('../models/BatchModel.php');

class StudentController
{
    private $studentModel;
    private $batchModel;

    public function __construct($db)
    {
        $this->studentModel = new StudentModel($db);
        $this->batchModel = new BatchModel($db);
    }

    public function viewStudents()
    {
        try {
            $students = $this->studentModel->getAllStudents();
            if ($students === false) {
                throw new Exception("Error fetching students.");
            }
            return $students;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage()); // Log the error for debugging
            return false;
        }
    }

    public function countsOfStudents()
    {
        try {
            $stdCount = $this->studentModel->getStudentsCount();
            if ($stdCount === false) {
                throw new Exception("Error fetching students count.");
            }
            return $stdCount;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage());
            return false;
        }
    }

    public function loadStudentById($sid)
    {
        try {
            if (empty($sid) || !is_numeric($sid)) {
                throw new Exception("Invalid student ID");
            }

            $student = $this->studentModel->getStudentById($sid);
            if ($student === false) {
                throw new Exception("Error fetching student");
            }
            return $student;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage()); // Log the error for debugging
            return false;
        }
    }

    public function loadCoursesWithStudentsCountByCourseId($cid)
    {
        try {
            // if (empty($sid) || !is_numeric($sid)) {
            //     throw new Exception("Invalid student ID");
            // }

            $csc = $this->studentModel->getCoursesWithStudentsCount($cid);
            if ($csc === false) {
                throw new Exception("Error fetching student");
            }
            return $csc;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage()); // Log the error for debugging
            return false;
        }
    }

    public function registerStudent()
    {
        try {
            if (isset($_POST['submit'])) {

                $facultyId = $_POST['faculty'];
                $centerId = $_POST['tcenter'];
                $courseId = $_POST['course'];
                $batches = $this->batchModel->getBatchesByCenterIdAndFacultyIdAndCoursesId($centerId, $facultyId, $courseId);

                foreach ($batches as $batch) {
                    $batch_Id = $batch['batch_id'];
                    $batch_Code = $batch['batch_code'];
                    $std_count = $batch['student_count'];
                }

                //create student index
                echo $std_index = $batch_Code . '-0' . $std_count;

                $data = [
                    'title' => $_POST['title'],
                    'fname' => $_POST['name'],
                    'index' => $std_index,
                    'tcenter' => $_POST['tcenter'],
                    'faculty' => $_POST['faculty'],
                    'course' => $_POST['course'],
                    'batch' => $batch_Id,
                    'nic' => $_POST['nic'],
                    'gender' => $_POST['gender'],
                    'address' => $_POST['address'],
                    'email' => $_POST['email'],
                    'dob' => $_POST['dob'],
                    'mobile' => $_POST['mobile'],
                    'parent_mobile' => $_POST['parent_mobile'],
                    'language' => $_POST['language'],
                    'regdate' => $_POST['registerd_date'],
                    'city' => $_POST['city']
                ];

                // Encode the data as JSON
                $jsonData = json_encode($data);

                // Output the JSON data to the browser's console
                echo "<script>console.log($jsonData);</script>";

                if ($this->studentModel->registerStudent($data)) {
                    echo '<script>alert("Student Registration successful "); window.location.href="../views/add_student.php";</script>';
                } else {
                    throw new Exception("Something went wrong. Please try again");
                }
            }
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '"); window.location.href="../views/add_student.php";</script>';
            error_log($e->getMessage()); // Log the error for debugging
        }
    }

    public function deleteStudent($sid)
    {
        try {
            $this->studentModel->deleteStudentById($sid);
            echo '<script>alert("Student Data deleted")</script>';
            echo '<script>window.location.href="../views/manage_student.php"</script>';
        } catch (Exception $e) {
            echo '<script>alert("Error deleting student: ' . $e->getMessage() . '"); window.location.href="../views/manage_student.php";</script>';
            error_log($e->getMessage()); // Log the error for debugging
        }
    }
}

try {
    $studentController = new StudentController($connect);
    $students = $studentController->viewStudents();
    $stdCount = $studentController->countsOfStudents();
    $studentController->registerStudent();

    if (isset($_POST['submit']) && isset($_POST['form_id']) && $_POST['form_id'] == 'updatecourseForm') {
        $cid = $_POST['cid'];
        $cshortname = $_POST['code'] ?? null;
        $cfullname = $_POST['cfull'] ?? null;
        $udate = $_POST['udate'] ?? null;
        $courseController->updateCourse($cid, $cshortname, $cfullname, $udate);
    }
} catch (Exception $e) {
    echo '<script>alert("Error: ' . $e->getMessage() . '"); window.location.href="../views/manage_student.php";</script>';
    error_log($e->getMessage()); // Log the error for debugging
}

//mysqli_close($connect);
