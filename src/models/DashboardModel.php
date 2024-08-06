<?php
class DashboardModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    # This use for get students count courses registered
    public function getCoursesWithStudentsCount()
    {
        try {
            $table_name = "tbl_student";
            $query = "SELECT SUM(CASE WHEN course_code = 'B.Sc.' THEN 1 ELSE 0 END) AS bsc_count,
            SUM(CASE WHEN course_code = 'MCA' THEN 1 ELSE 0 END) AS msc_count,
            SUM(CASE WHEN course_code='B.E.' THEN 1 ELSE 0 END) AS bec_count,
            SUM(CASE WHEN course_code='B.Com.' THEN 1 ELSE 0 END) AS bcomc_count
            FROM $table_name";
            $response = mysqli_query($this->db, $query);

            if ($response) {
                $ccounts = [];
                while ($i = mysqli_fetch_assoc($response)) {
                    $ccounts[] = $i;
                }
                return $ccounts;
            } else {
                throw new Exception("Error fetching count: " . mysqli_error($this->db));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }


    public function getCoursesCount()
    {
        try {
            $table_name = "tbl_course";
            $query = "SELECT COUNT(*) as total_courses, SUM(CASE WHEN course_level = 'Master' THEN 1 ELSE 0 END) AS master_courses_count,
            SUM(CASE WHEN course_level = 'Degree' THEN 1 ELSE 0 END) AS degree_courses_count,
            SUM(CASE WHEN course_level='Diploma' THEN 1 ELSE 0 END) AS diploma_courses_count
            FROM $table_name";
            $response = mysqli_query($this->db, $query);

            if ($response) {
                $coursesCounts = [];
                while ($i = mysqli_fetch_assoc($response)) {
                    $coursesCounts[] = $i;
                }
                return $coursesCounts;
            } else {
                throw new Exception("Error fetching count: " . mysqli_error($this->db));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getCentersCount()
    {
        try {
            $table_name = "tbl_training_centers";
            $query = "SELECT (SELECT COUNT(DISTINCT center_name) FROM $table_name) as unique_centers,(SELECT COUNT(*) FROM tbl_faculty) AS faculty_count;";
            $response = mysqli_query($this->db, $query);

            if ($response) {
                $centerCounts = [];
                while ($i = mysqli_fetch_assoc($response)) {
                    $centerCounts[] = $i;
                }
                return $centerCounts;
            } else {
                throw new Exception("Error fetching count: " . mysqli_error($this->db));
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
