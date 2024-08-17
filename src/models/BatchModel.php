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
            SELECT batch_id, batch_code,student_count FROM tbl_batch WHERE center_id= ? AND faculty_id= ? AND course_id= ? AND enrollment_end_date > CURDATE();
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

    public function addBatch($batch_code, $course_id, $faculty_id, $center_id, $student_count, $batch_year, $estart_date, $eend_date)
    {
        $this->db->begin_transaction();

        try {

            $stmt = $this->db->prepare("INSERT INTO tbl_batch (batch_code, course_id, faculty_id, center_id,student_count,batch_year, enrollment_start_date, enrollment_end_date) VALUES (?, ?, ?,?,?,?,?,?)");

            if ($stmt === false) {
                throw new Exception('Prepare failed (batch table): ' . $this->db->error);
            }

            $stmt->bind_param('siiiisss', $batch_code, $course_id, $faculty_id, $center_id, $student_count, $batch_year, $estart_date, $eend_date);
            $success = $stmt->execute();

            if ($success === false) {
                throw new Exception('Execute failed (batch table): ' . $stmt->error);
            }
            $this->db->commit();
            $stmt->close();
            return true;

        } catch (Exception $e) {
            $this->db->rollback();
            error_log($e->getMessage());
            echo '<script>alert("Something 1 went wrong. Please try again"); window.location.href="../views/add_batch.php";</script>';
            return false;
        }
    }

    public function updateBatchStdCount($centerId, $facultyId, $courseId)
    {
        $stmt = $this->db->prepare("UPDATE tbl_batch SET student_count = student_count+1 WHERE center_id= ? AND faculty_id= ? AND course_id= ?");
        $stmt->bind_param('iii', $centerId, $facultyId, $courseId); // 's' for string, 'i' for integer
        $res = $stmt->execute();
        return $res;
    }

    public function searchBatchCodeByCode($batchCodePrefix, $batchCodeSuffix)
    {
        $query = "SELECT * FROM tbl_batch WHERE batch_code LIKE ?";
        $stmt = $this->db->prepare($query);
        $searchTerm = $batchCodePrefix . "_" . $batchCodeSuffix;
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $batches = [];
        while ($row = $result->fetch_assoc()) {
            $batches[] = $row;
        }

        return $batches;
    }

}
