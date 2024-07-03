<?php
// model/student_model.php

class StudentModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllStudents()
    {
        $table_name = "tbl_student";
        $query = "SELECT * FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $students = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $students[] = $i;
            }
            return $students;
        } else {
            return false;
        }
    }
}
