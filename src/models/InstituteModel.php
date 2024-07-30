<?php
// model/institute_model.php

class InstituteModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllfaculties()
    {
        $table_name = "tbl_faculty";
        $query = "SELECT * FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $faculties = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $faculties[] = $i;
            }
            return $faculties;
        } else {
            return false;
        }
    }

    public function getAllTrainingCentersLocations()
    {
        $table_name = "tbl_training_center_locations";
        $query = "SELECT location_id,center_name FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $tclocations = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $tclocations[] = $i;
            }
            return $tclocations;
        } else {
            return false;
        }
    }
}
