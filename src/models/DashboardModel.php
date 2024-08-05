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
            $query = "SELECT SUM(CASE WHEN course_code = 'B.Sc.' THEN 1 ELSE 0 END) AS bsc_count FROM $table_name";
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
}
