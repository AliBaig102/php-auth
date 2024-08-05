<?php
require_once dirname(__DIR__) . "/database/connection.php";
require_once dirname(__DIR__) . "/utils/functions.php";
require_once dirname(__DIR__) . "/utils/errors.php";
require_once dirname(__DIR__) . "/utils/auth.php";
require_once dirname(__DIR__) . "/utils/mail.php";
require_once dirname(__DIR__) . "/utils/auth-functions.php";
session_start();

print_pre($_POST);
$username = secure_input($_POST['username']);
$email = secure_input($_POST['email']);
$password = secure_input($_POST['password']);
$confirm_password = secure_input($_POST['confirm_password']);

if (empty_input($username)) {
    error_and_redirect("signup", ["username_error" => "Username is required"], "index.php");
} elseif (empty_input($email)) {
    error_and_redirect("signup", ["username" => $username, "email_error" => "Email is required"], "index.php");
} elseif (empty_input($password)) {
    error_and_redirect("signup", ["username" => $username, "email" => $email, "password_error" => "Password is required"], "index.php");
} elseif (empty_input($confirm_password)) {
    error_and_redirect("signup", ["username" => $username, "email" => $email, "confirm_password_error" => "Confirm password is required"], "index.php");
} elseif ($password != $confirm_password) {
    error_and_redirect("signup", ["username" => $username, "email" => $email, "confirm_password_error" => "Passwords do not match"], "index.php");
} elseif (is_user_registered($email)) {
    error_and_redirect("signup", ["username" => $username, "email" => $email, "confirm_password_error" => "User already exists"], "index.php");
} else {
    global $application_name;
    $password=secure_password($password);
    [$token,$url,$code_expiration]=generate_token_and_code_expiration($email,"index.php");
        $email_template = emailTemplate("Aptech",$application_name,"Please verify your email","Please click on the link below to verify your email",$token,$url,"Verify Email");
    if (register_user($username, $email, $password,$token,$code_expiration)) {
        if (sendEmail($email, "Please verify your email", $email_template)) {
            success_and_redirect("signup", ["email" => $email], "index.php");
        }else{
            echo "Email not sent";
        }
    }else{
        error_and_redirect("signup", ["username" => $username, "email" => $email, "confirm_password_error" => "User already exists"], "index.php");
    }
}