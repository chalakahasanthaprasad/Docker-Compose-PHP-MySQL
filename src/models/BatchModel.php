<?php
// model/batch_model.php

class BatchModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getBatchesByCenterIdAndFacultyIdAndCoursesId($centerId, $facultyId, $courseId)
    {
        $query = "
            SELECT batch_id, batch_code FROM tbl_batch WHERE center_id= ? AND faculty_id= ? AND course_id= ? AND enrollment_end_date > CURDATE();
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $centerId, $facultyId, $courseId);
        $stmt->execute();
        $result = $stmt->get_result();


        $batches = [];
        while ($row = $result->fetch_assoc()) {
            $batches[] = $row;
        }
        return $batches;
    }
}
