<?php
session_start();
include '../../includes/header.php';
?>
<main style="text-align: center; margin-top: 50px;">
    <h2>Login</h2>
    <?php
    if (isset($_SESSION['login_error'])) {
        echo "<p style='color: red;'>{$_SESSION['login_error']}</p>";
        unset($_SESSION['login_error']); // Clear the error message after displaying it
    }
    ?>

    <form action="../controllers/login_controller.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</main>
<?php include '../../includes/footer.php'; ?>