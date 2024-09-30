<?php
class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function getUserByUsername($username)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, loginid, password FROM tbl_login WHERE loginid = ?");
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $id = $loginid = $password = null;

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $loginid, $password);
                $stmt->fetch();
                return ['id' => $id, 'username' => $loginid, 'password' => $password];
            } else {
                return null;
            }

        } catch (Exception $e) {
            error_log("Error in getUserByUsername: " . $e->getMessage());
            return false;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
        }
    }
}
?>
