<?php
require_once dirname(__DIR__)."/database/connection.php";
require_once dirname(__DIR__)."/utils/functions.php";
require_once dirname(__DIR__)."/utils/errors.php";
session_start();

print_pre($_POST);
$username=secure_input($_POST['username']);
$email=secure_input($_POST['email']);
$password=secure_input($_POST['password']);
$confirm_password=secure_input($_POST['confirm_password']);

if (empty_input($username)){
    error_and_redirect("signup", ["username_error" => "Username is required"], "index.php");
}elseif (empty_input($email)){
    error_and_redirect("signup", ["username"=> $username,"email_error" => "Email is required"], "index.php");
}elseif (empty_input($password)){
    error_and_redirect("signup", ["username"=> $username,"email"=> $email,"password_error" => "Password is required"], "index.php");
}elseif (empty_input($confirm_password)){
    error_and_redirect("signup", ["username"=> $username,"email"=> $email,"confirm_password_error" => "Confirm password is required"], "index.php");
}