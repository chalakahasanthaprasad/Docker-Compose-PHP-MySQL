<?php
// model/SubjectModel.php

class SubjectModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllSubjects()
    {
        $table_name = "tbl_subject";
        $query = "SELECT * FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $Subjects = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $Subjects[] = $i;
            }
            return $Subjects;
        } else {
            return false;
        }
    }

    public function registerStudent($data)
    {
        $query = "INSERT INTO registration (std_name,course_code,gender,address,birthofdate,mobile_number,parent_number,registered_date,city_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssss", ...array_values($data));
        return $stmt->execute();
    }
}
