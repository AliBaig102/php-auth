<?php

function print_pre($array):void
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function secure_input($input): string
{
    global $connection;
    $input = trim($input);
    $input = htmlspecialchars($input);
    return mysqli_real_escape_string($connection, $input);
}

function empty_input($input):bool
{
    if (empty($input)) return true;
    return false;
}

function validate_email($email): bool
{
    if (!filter_input($email,FILTER_VALIDATE_EMAIL)) return false;
    return  true;
}

function myRequire($path): void
{
    require dirname(__DIR__)."/$path";
}

function active_link($file_name):string
{
    $req_uri = parse_url($_SERVER['REQUEST_URI'])["path"];
    $array = explode("/", $req_uri);
    $req_uri=end($array);
    if ($file_name == $req_uri) return "active";
    return "";
}
function redirect($path): void
{
    global $application_url;
    echo "<script>window.location.href = '$application_url/$path'</script>";
}
function success_and_redirect($success_type, $success, $path): void
{
    unset($_SESSION["success"][$success_type]);
    $_SESSION["success"][$success_type] = $success;
    redirect($path);
}

function success_toast($message, $path): void
{
    $_SESSION["toast"]["success"] = $message;
    redirect($path);
}
function error_toast($message, $path): void
{
    $_SESSION["toast"]["error"] = $message;
    redirect($path);
}