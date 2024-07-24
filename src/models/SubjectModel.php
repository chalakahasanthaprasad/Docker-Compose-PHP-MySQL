<?php
// model/SubjectModel.php

class SubjectModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllSubjects()
    {
        $table_name = "tbl_subject";
        $query = "SELECT * FROM $table_name";
        $response = mysqli_query($this->db, $query);

        if ($response) {
            $Subjects = [];
            while ($i = mysqli_fetch_assoc($response)) {
                $Subjects[] = $i;
            }
            return $Subjects;
        } else {
            return false;
        }
    }

    public function addSubject($code, $subjectname, $created_date)
    {
        $this->db->begin_transaction();
        echo $code, $subjectname, $created_date;

        try {
            $stmt = $this->db->prepare("INSERT INTO tbl_subjects(subject_code, subject_name, created_date) VALUES (?, ?, ?)");

            if ($stmt === false) {
                echo 'Execute failed: ' . $stmt->error;
                //throw new Exception('Prepare failed: ' . $this->db->error);
            }

            $stmt->bind_param('sss', $code, $subjectname, $created_date);
            $success = $stmt->execute();

            if ($success === false) {
                echo 'Execute failed: ' . $stmt->error;
                //throw new Exception('Execute failed: ' . $stmt->error);

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

    public function registerStudent($data)
    {
        $query = "INSERT INTO registration (std_name,course_code,gender,address,birthofdate,mobile_number,parent_number,registered_date,city_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssssss", ...array_values($data));
        return $stmt->execute();
    }

    public function isSubjectAvailable($sname)
    {
        $count = null;
        $stmt = $this->db->prepare("SELECT count(*) FROM tbl_subjects WHERE subject_name = ?");
        $stmt->bind_param('s', $sname);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count == 0;
    }
}
