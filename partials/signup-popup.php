<?php
$active_class="";
$username_error="";
$email_error="";
$password_error="";
$confirm_password_error="";
$username="";
$email="";
if (isset($_SESSION["errors"]["signup"])) {
    $username_error = $_SESSION["errors"]["signup"]["username_error"] ?? "";
    $email_error = $_SESSION["errors"]["signup"]["email_error"] ?? "";
    $password_error = $_SESSION["errors"]["signup"]["password_error"] ?? "";
    $confirm_password_error = $_SESSION["errors"]["signup"]["confirm_password_error"] ?? "";
    $username=$_SESSION["errors"]["signup"]["username"] ?? "";
    $email=$_SESSION["errors"]["signup"]["email"] ?? "";
    $active_class="active";
    unset($_SESSION["errors"]["signup"]);
}
?>
<div class="popup-container signup-popup <?= $active_class ?>">
    <form action="actions/register.php" method="post">
        <h3>Register</h3>
        <div class="input-group">
            <label for="username"><i class="fas fa-user"></i></label>
            <input type="text" name="username" value="<?= $username; ?>" id="username" placeholder="Username">
        </div>
        <span class="error"><?= $username_error; ?></span>
        <div class="input-group">
            <label for="email"><i class="fas fa-envelope"></i></label>
            <input type="email" name="email" id="email" value="<?= $email; ?>" placeholder="Email">
        </div>
        <span class="error"><?= $email_error; ?></span>
        <div class="input-group">
            <label for="password"><i class="fas fa-lock"></i></label>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <span class="error"><?= $password_error; ?></span>
        <div class="input-group">
            <label for="confirm_password"><i class="fas fa-lock"></i></label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter password again">
        </div>
        <span class="error"><?= $confirm_password_error; ?></span>
        <button type="submit">Register</button>
    </form>
    <div class="close-btn"><i class="fas fa-times"></i></div>
</div>