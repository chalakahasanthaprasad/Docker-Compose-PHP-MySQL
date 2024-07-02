<?php
// models/User.php
class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT id,loginid, password FROM tbl_login WHERE loginid = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        //initializing
        $id = $username = $password = null;

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $password);
            $stmt->fetch();
            //echo "$id, $username, $password";
            return ['id' => $id, 'username' => $username, 'password' => $password];
        }

        return null;
    }
}
?>