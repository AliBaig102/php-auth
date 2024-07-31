<?php
$errors=[];

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
//    convert array to string
    $errors = http_build_query($errors);

    header("Location: ../$url" . "?" . $error_type . "&" . $errors);
    exit();
}

function clear_errors(): void
{
    global $errors;
    $errors = [];
}
//error_and_redirect("signup_error",["username" => "Username already exists"], "signup.php");