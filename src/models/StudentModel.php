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
            $stmt = mysqli_prepare($this->db, "SELECT s.*, c.cfull, f.faculty_name, b.batch_code FROM tbl_student s
                    JOIN tbl_course c ON s.course_code = c.cid
                    JOIN tbl_faculty f ON s.faculty_id = f.faculty_id
                    JOIN tbl_batch b ON s.batch_id = b.batch_id
                    WHERE s.std_id = ?");
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
            $query = "INSERT INTO tbl_student (title,std_name,std_index,tcenter_id,faculty_id,course_code,batch_id,nic_no,gender,address,email, birthofdate, mobile_number, parent_number,f_language,registered_date, city_id)
                      VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ? ,? ,? ,?,?,?)";
            $stmt = $this->db->prepare($query);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . mysqli_error($this->db));
            }
            $stmt->bind_param("sssiiiisssssssssi", ...array_values($data));
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

    public function updateStudent($std_id, $index, $std_tcenter, $std_title, $std_name, $std_gender, $std_dob, $std_language, $std_mobile, $std_email, $std_parent_mobile, $std_city, $std_address, $update)
    {
        $stmt = $this->db->prepare("UPDATE tbl_student SET tcenter_id = ?, title = ?, std_name = ?, gender = ?, birthofdate = ?, f_language = ?, mobile_number = ?, email = ?, parent_number = ?, city_id = ?, address = ?, update_date = ? WHERE std_id = ?");
        $stmt->bind_param('issssssssisi', $std_tcenter, $std_title, $std_name, $std_gender, $std_dob, $std_language, $std_mobile, $std_email, $std_parent_mobile, $std_parent_mobile, $std_city, $std_address, $update, $std_id); // 's' for string, 'i' for integer
        $stmt->execute();
        $stmt->close();
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
