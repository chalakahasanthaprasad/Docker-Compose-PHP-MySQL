<?php
// controller/StudentController.php 

include ('../../config/dbcon.php');
include ('../models/CityModel.php');

class CityController
{
    private $cityModel;

    public function __construct($db)
    {
        $this->cityModel = new CityModel($db);
    }

    public function viewCities()
    {
        $cities = $this->cityModel->getAllCities();
        if ($cities === false) {
            echo "Error fetching city.";
            return;
        }
        return $cities;
    }
}


$cityController = new CityController($connect);
$cities = $cityController->viewCities();
mysqli_close($connect);
