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

    public function addCourse($code, $cfullname, $created_date)
    {
        $stmt = $this->db->prepare("INSERT INTO tbl_course (code, cfull, created_date) VALUES (?, ?, ?)");

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }

        // Bind the parameters to the placeholders
        $stmt->bind_param('sss', $code, $cfullname, $created_date);

        $success = $stmt->execute();

        if ($success === false) {
            die('Execute failed: ' . $stmt->error);
        }
        $stmt->close();

        return $success;
    }


}
