<?php

class CityModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function getAllCities()
    {
        try {
            $table_name = "tbl_city";
            $query = "SELECT * FROM $table_name";

            // Prepare the statement
            $stmt = mysqli_prepare($this->db, $query);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . mysqli_error($this->db));
            }

            
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (!$result) {
                throw new Exception("Failed to get result: " . mysqli_error($this->db));
            }

            $cities = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cities[] = $row;
            }

            mysqli_stmt_free_result($stmt);
            mysqli_stmt_close($stmt);

            return $cities;
        } catch (Exception $e) {
            error_log("Error in getAllCities: " . $e->getMessage());
            return false;
        }
    }
}

