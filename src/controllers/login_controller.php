<?php
session_start();
include_once '../../config/dbcon.php';
include_once '../models/user.php';

class LoginController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }
    
    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        
        if ($username == isset($user['username']) && $password == $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            //print console
            //echo "<script>console.log('" . addslashes("Point") . "');</script>";
            return header('location:../views/dashboard.php');
        } else {
            return "Invalid username or password.";
        }
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginController = new LoginController($connect);
    $message = $loginController->login($username, $password);
    if ($message) {
        // Redirect back to login page with error message
        $_SESSION['login_error'] = $message;
        header('location: ../views/login.php');
        exit;
    }
}
?>
