<?php
// model/city_model.php

class CityModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCities()
    {
        $table_name = "tbl_city";
        $query = "SELECT * FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $cities = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $cities[] = $i;
            }
            return $cities;
        } else {
            return false;
        }
    }
}
