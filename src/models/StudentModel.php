<?php
class StudentModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllStudents()
    {
        try {
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
                throw new Exception("Error fetching students: " . mysqli_error($this->db));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getStudentsCount()
    {
        try {
            $table_name = "tbl_student";
            $query = "SELECT COUNT(*) as total_students FROM $table_name";
            $response = mysqli_query($this->db, $query);

            if ($response) {
                $result = mysqli_fetch_assoc($response);
                return $result['total_students'];
            } else {
                throw new Exception("Error fetching students count: " . mysqli_error($this->db));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getStudentById($sid)
    {
        try {
            $stmt = mysqli_prepare($this->db, "SELECT * FROM tbl_student WHERE std_id = ?");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . mysqli_error($this->db));
            }
            mysqli_stmt_bind_param($stmt, 'i', $sid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (!$result) {
                throw new Exception("Get result failed: " . mysqli_error($this->db));
            }
            $student = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return $student;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function registerStudent($data)
    {
        try {
            $query = "INSERT INTO tbl_student (title,std_name,tcenter_id,faculty_id,course_code,nic_no,gender,email,address, birthofdate, mobile_number, parent_number,f_language,registered_date, city_id)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,?,?,?)";
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . mysqli_error($this->db));
            }
            $stmt->bind_param("ssiiisssssssssi", ...array_values($data));
            if (!$stmt->execute()) {
                throw new Exception("Execute statement failed: " . $stmt->error);
            }
            $stmt->close();
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteStudentById($sid)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM tbl_student WHERE std_id = ?");
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . mysqli_error($this->db));
            }
            $stmt->bind_param('i', $sid);
            if (!$stmt->execute()) {
                throw new Exception("Execute statement failed: " . $stmt->error);
            }
            $stmt->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
