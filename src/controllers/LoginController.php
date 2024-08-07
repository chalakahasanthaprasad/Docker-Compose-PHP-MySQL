<?php
session_start();
include_once '../../config/dbcon.php';
include_once '../models/UserModel.php';

class LoginController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function login($username, $password)
    {
        $user = $this->userModel->getUserByUsername($username);

        if ($username == isset($user['username']) && $password == $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
            //print console
            //echo "<script>console.log('" . addslashes("Point") . "');</script>";
            header('location:../views/dashboard.php');
            exit;
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
        header('location:../views/login.php');
        exit;
    }
}
