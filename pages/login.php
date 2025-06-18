<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container">
    <h2>Login</h2>
    <form action="../actions/login_process.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required />
        <br />
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required />
        <br />
        <button type="submit">Login</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
