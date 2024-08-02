<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Student Management System</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://colorlib.com/etc/lf/Login_v1/images/icons/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background: url('../../assets/images/peakpx.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #fff;
        }

        .login-box .form-group {
            margin-bottom: 20px;
        }

        .login-box .form-control {
            border-radius: 4px;
        }

        .login-box .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .login-box .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .login-box .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .login-box .text-center {
            color: #fff;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['login_error'])) {
        echo "<p style='color: red;'>{$_SESSION['login_error']}</p>";
        unset($_SESSION['login_error']); // Clear the error message after displaying it
    }
    ?>
    <div class="login-container">
        <div class="login-box">
            <div class="text-center">
                <img src="../../assets/images/security.png" alt="Logo" class="mb-4">
                <h2>Member Login</h2>
            </div>
            <form action="../controllers/LoginController.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                        required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <div class="text-center mt-3">
                    <a href="#" class="text-light">Forgot Username / Password?</a>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="text-light">Create your Account <i class="fa fa-long-arrow-right ml-2"></i></a>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>