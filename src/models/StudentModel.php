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

    public function getStudentById($sid)
    {
        $stmt = mysqli_prepare($this->db, "SELECT * FROM tbl_student WHERE std_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $sid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $student = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $student;
    }

    public function registerStudent($data)
    {
        $query = "INSERT INTO tbl_student (std_name,course_code,gender,address,birthofdate,mobile_number,parent_number,registered_date,city_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssss", ...array_values($data));
        return $stmt->execute();
    }

    public function deleteStudentById($sid)
    {
        $stmt = $this->db->prepare("DELETE FROM tbl_student WHERE std_id = ?");
        $stmt->bind_param('i', $sid);
        $stmt->execute();
        $stmt->close();
    }
}
