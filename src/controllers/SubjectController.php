<?php
// controller/SubjectController.php

require_once('../../config/dbcon.php');
require_once('../models/SubjectModel.php');
require_once('../models/CourseModel.php');

class SubjectController
{
    private $subjectModel;
    private $courseModel;

    public function __construct($db)
    {
        $this->subjectModel = new SubjectModel($db);
        $this->courseModel = new CourseModel($db);
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
    public function loadCourseById($courseCode)
    {
        return $this->courseModel->getLastSubjectByCourse($courseCode);
    }

    public function addSubject()
    {
        if (isset($_POST['submit'])) {
            $courseCode = $_POST['course'];
            $subjectname = $_POST['sbjname'];
            $created_date = $_POST['cdate'];
            $lastSubjectCode = $this->loadCourseById($courseCode); // output is arrary

            // Debugging: Print the $lastSubjectCode
            // echo "<pre>";
            // print_r($lastSubjectCode);
            // echo "</pre>";

            //Output Array Like this
            // Array
            // (
            //     [subject_code] => CS111
            // )

            // echo $lastSubjectCode['subject_code'];

            $newSubjectCode = $this->incrementString($lastSubjectCode['subject_code']);
            $query = $this->subjectModel->addSubject($courseCode, $newSubjectCode, $subjectname, $created_date);

            if ($query) {
                echo '<script>alert("Subject Added successfully"); window.location.href="../views/add_subject.php";</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again"); window.location.href="../views/add_subject.php";</script>';
            }

            exit;
        }

    }
    public function getCourseSubjects($courseCode)
    {
        $subjects = $this->subjectModel->getAllSubjectsByCourse($courseCode);
        echo json_encode($subjects);
        exit;
    }
    public function incrementString($input)
    {
        if (preg_match('/([a-zA-Z]+)(\d+)/', $input, $matches)) {
            $alphabeticPart = $matches[1];
            $numericPart = $matches[2];
            $newNumericPart = $numericPart + 1;
            return $alphabeticPart . $newNumericPart;
        } else {
            return $input;
        }
    }
}


$subjectController = new SubjectController($connect);
//$subjects = $subjectController->viewSubjects();

// Handle AJAX request
if (isset($_POST['sbjname'])) {
    $subjectController->checkSubjectAvailability();
}
if (isset($_POST['submit']) && isset($_POST['form_id']) && $_POST['form_id'] == 'addSubjectForm' && isset($_POST['course'])) {
    $subjectController->addSubject();
}

if (isset($_POST['course_code'])) {
    $courseCode = $_POST['course_code'];
    $subjectController->getCourseSubjects($courseCode);
}

mysqli_close($connect);
