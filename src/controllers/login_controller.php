<?php
// controllers/LoginController.php
session_start();
include_once '../../config/dbcon.php';
include_once '../models/user.php';

class LoginController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function login2($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            return "Login successful. Welcome, " . $user['username'];
        } else {
            return "Invalid username or password.";
        }
    }

    public function login($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        
        if ($username == $user['username'] && $password == $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            //return "Login successful. Welcome, " . $user['username'];
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
    include '../views/login.php';
}
?>