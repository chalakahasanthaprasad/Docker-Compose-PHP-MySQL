<?php
// model/course_model.php

class CourseModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCourses()
    {
        $table_name = "tbl_course";
        $query = "SELECT * FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $courses = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $courses[] = $i;
            }
            return $courses;
        } else {
            return false;
        }
    }
}
