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
        $table_name = "tbl_training_centers";
        $query = "SELECT center_id,center_name FROM $table_name";
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

    public function getFacultiesByCenterId($centerId)
    {
        $query = "
            SELECT tc.center_id, tc.center_name, f.faculty_id, f.faculty_name 
            FROM tbl_training_centers tc 
            JOIN training_center_faculties fc ON tc.center_id = fc.center_id 
            JOIN tbl_faculty f ON fc.faculty_id = f.faculty_id 
            WHERE tc.center_id = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $centerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $faculties = [];
        while ($row = $result->fetch_assoc()) {
            $faculties[] = $row;
        }
        return $faculties;
    }

    public function getCoursesByCenterIdAndFacultyId($centerId, $facultyId)
    {
        $query = "
            SELECT c.cid, c.cfull
            FROM tbl_course c
            JOIN course_faculty cf ON c.cid = cf.course_id
            JOIN training_center_courses tcc ON c.cid = tcc.course_id
            WHERE tcc.center_id = ? AND cf.faculty_id = ?;
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $centerId, $facultyId);
        $stmt->execute();
        $result = $stmt->get_result();


        $faculties = [];
        while ($row = $result->fetch_assoc()) {
            $faculties[] = $row;
        }
        return $faculties;
    }

    public function getCenterCodeById($center_id)
    {
        $stmt = mysqli_prepare($this->db, "SELECT * FROM tbl_training_centers WHERE center_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $center_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $code = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $code;
    }
}
