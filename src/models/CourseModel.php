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
        $query = "SELECT * FROM $table_name WHERE isActive = 1 AND isDelete = 0";
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

    public function addCourse($code, $cfullname, $courselevel, $created_date)
    {
        $this->db->begin_transaction();

        try {
            $stmt = $this->db->prepare("INSERT INTO tbl_course (code, cfull, course_level, created_date) VALUES (?, ?,?, ?)");

            if ($stmt === false) {
                throw new Exception('Prepare failed: ' . $this->db->error);
            }

            $stmt->bind_param('ssss', $code, $cfullname, $courselevel, $created_date);
            $success = $stmt->execute();

            if ($success === false) {
                throw new Exception('Execute failed: ' . $stmt->error);
            }

            // Commit the transaction
            $this->db->commit();

            $stmt->close();
            return $success;
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            $this->db->rollback();
            error_log($e->getMessage());
            return false;
        }
    }

    public function isCourseCodeAvailable($code)
    {
        $count = null;
        $stmt = $this->db->prepare("SELECT count(*) FROM tbl_course WHERE code = ?");
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count == 0;
    }

    // //  Less Secure .......................................................................................
//     public function checkShortNameExists($code)
//     {
//         $query = mysqli_query($this->db, "SELECT * FROM tbl_course WHERE code='$code'");
//         return mysqli_num_rows($query) > 0;
//     }

    //     public function checkFullNameExists($cfull)
//     {
//         $query = mysqli_query($this->db, "SELECT * FROM tbl_course WHERE cfull='$cfull'");
//         return mysqli_num_rows($query) > 0;
//     }
    // //  Less Secure .........................................................................................

    public function isCourseNameAvailable($code)
    {
        $count = null;
        $stmt = $this->db->prepare("SELECT count(*) FROM tbl_course WHERE cfull = ?");
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count == 0;
    }

    // public function getCourseById($cid)
    // {
    //     $query = mysqli_query($this->db, "SELECT * FROM tbl_course WHERE cid='$cid'");
    //     return mysqli_fetch_assoc($query);
    // }

    public function getCourseById($cid)
    {
        $stmt = mysqli_prepare($this->db, "SELECT * FROM tbl_course WHERE cid = ?");
        mysqli_stmt_bind_param($stmt, 'i', $cid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $course = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $course;
    }

    public function getLastSubjectByCourse($courseCode)
    {
        $query = "
            SELECT s.subject_code
            FROM course_subjects cs
            JOIN tbl_subjects s ON cs.subject_id = s.subject_id
            JOIN tbl_course c ON cs.course_id = c.cid
            WHERE c.cid = ?
            ORDER BY s.subject_code DESC
            LIMIT 1
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $courseCode);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateCourse($cid, $cshortname, $cfullname, $udate)
    {
        $stmt = $this->db->prepare("UPDATE tbl_course SET code = ?, cfull = ?, update_date = ? WHERE cid = ?");
        $stmt->bind_param('sssi', $cshortname, $cfullname, $udate, $cid); // 's' for string, 'i' for integer
        $stmt->execute();
        $stmt->close();
    }

    public function deactivateCourse($cid)
    {
        $stmt = $this->db->prepare("UPDATE tbl_course SET isActive = 0 WHERE cid = ?");
        $stmt->bind_param("i", $cid);
        $res = $stmt->execute();
        return $res;
    }

    public function softDeleteCourseById($cid)
    {
        $stmt = $this->db->prepare("UPDATE tbl_course SET isDelete = 1 WHERE cid = ?");
        $stmt->bind_param("i", $cid);
        $res = $stmt->execute();
        return $res;
    }

    public function deleteCourseById($cid)
    {
        $stmt = $this->db->prepare("DELETE FROM tbl_course WHERE cid = ?");
        $stmt->bind_param('i', $cid); // 'i' for integer
        $stmt->execute();
        $stmt->close();
    }


}
