<?php include '../../includes/header.php'; ?>
<main>
    <h2>Login</h2>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form action="../controllers/login_controller.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</main>
<?php include '../../includes/footer.php'; ?>
