<?php
$errors=[];
session_status();
myRequire("constant\constant.php");

function show_errors(): void
{
    global $errors;
    if(!empty($errors))
    {
        echo "<ul class='errors'>";
        foreach($errors as $error)
        {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}

function error_and_redirect($error_type,$errors, $url): void
{
//    $_SESSION['errors'] = [];
    unset($_SESSION["errors"][$error_type]);
    $_SESSION["errors"][$error_type] = $errors;
    header("Location:../$url");
    exit();
}

function clear_errors(): void
{
    global $errors;
    $errors = [];
}
//error_and_redirect("signup_error",["username" => "Username already exists"], "signup.php");