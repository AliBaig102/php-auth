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
