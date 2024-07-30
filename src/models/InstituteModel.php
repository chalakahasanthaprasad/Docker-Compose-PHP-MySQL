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
}
