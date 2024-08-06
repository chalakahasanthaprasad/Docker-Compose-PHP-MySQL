<?php
// controller/StudentController.php 

require_once('../../config/dbcon.php');
require_once('../models/DashboardModel.php');

class DashboardController
{
    private $dashboardModel;

    public function __construct($db)
    {
        $this->dashboardModel = new DashboardModel($db);
    }

    public function viewCountOfCoursesStudents()
    {
        try {
            $ccounts = $this->dashboardModel->getCoursesWithStudentsCount();
            if ($ccounts === false) {
                throw new Exception("Error fetching count.");
            }
            return $ccounts;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage()); // Log the error for debugging
            return false;
        }
    }

    public function countsOfCoursesAndtypes()
    {
        try {
            $coursesCounts = $this->dashboardModel->getCoursesCount();
            if ($coursesCounts === false) {
                throw new Exception("Error fetching courses count.");
            }
            return $coursesCounts;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage());
            return false;
        }
    }

    public function countsOfCenters()
    {
        try {
            $centerCounts = $this->dashboardModel->getCentersCount();
            if ($centerCounts === false) {
                throw new Exception("Error fetching centers count.");
            }
            return $centerCounts;
        } catch (Exception $e) {
            echo $e->getMessage();
            error_log($e->getMessage());
            return false;
        }
    }
}

try {
    $dashboardController = new DashboardController($connect);
    $ccounts = $dashboardController->viewCountOfCoursesStudents();
    $coursesCounts = $dashboardController->countsOfCoursesAndtypes();
    $centerCounts = $dashboardController->countsOfCenters();
} catch (Exception $e) {
    error_log($e->getMessage()); // Log the error for debugging
}

//mysqli_close($connect);
