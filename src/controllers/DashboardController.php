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
}

try {
    $dashboardController = new DashboardController($connect);
    $ccounts = $dashboardController->viewCountOfCoursesStudents();
} catch (Exception $e) {
    error_log($e->getMessage()); // Log the error for debugging
}

//mysqli_close($connect);
