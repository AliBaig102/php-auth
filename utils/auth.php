<?php
require_once dirname(__DIR__)."/database/connection.php";

function is_user_registered($email):bool
{
    global $connection;
    $sql="SELECT * FROM auth WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);
   mysqli_stmt_bind_param($stmt,"s", $email);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   if (mysqli_num_rows($result) > 0) {
       return true;
   } else {
       return false;
   }
}
function register_user($username, $email, $password,$verification_code,$code_expiration):bool
{
    global $connection;
    $sql="INSERT INTO auth (name, email, password,verification_code,code_expiration) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt,"sssss", $username, $email, $password, $verification_code, $code_expiration);
    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function check_email_verification($email): bool
{
    global $connection;
    $sql = "SELECT is_verified FROM auth WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);

    if (!mysqli_stmt_execute($stmt)) {
        return false;
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        mysqli_stmt_close($stmt);
        if ($row['is_verified'] === 1) {
            return true;
        } else {
            return false;
        }
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

function is_verification_code_expired($email): string
{
    global $connection;
    date_default_timezone_set("Asia/Karachi");
    $current_time = date("Y-m-d H:i:s");
    $sql = "SELECT code_expiration FROM auth WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    if (!mysqli_stmt_execute($stmt)) {
        return true;
    }
    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        mysqli_stmt_close($stmt);
        if ($row['code_expiration'] < $current_time) {
            return true;
        } else {
            return false;
        }
    } else {
        mysqli_stmt_close($stmt);
        return true;
    }
}

function verify_email($email, $verification_code): bool
{
    global $connection;
    $sql = "UPDATE auth SET is_verified = 1 WHERE email = ? AND verification_code = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $verification_code);
    if (!mysqli_stmt_execute($stmt)) {
        return false;
    }
    mysqli_stmt_close($stmt);
    return true;
}
function get_user_data($username_or_email): false|array
{
    global $connection;

    $sql = "SELECT * FROM auth WHERE name = ? OR email = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        return false; // Handle error
    }

    mysqli_stmt_bind_param($stmt, "ss", $username_or_email, $username_or_email); // Bind both parameters

    if (!mysqli_stmt_execute($stmt)) {
        return false; // Handle error
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}
function check_verification_code($email, $verification_code): bool
{
    global $connection;
    $sql = "SELECT verification_code FROM auth WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    if (!mysqli_stmt_execute($stmt)) {
        return false;
    }
    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        mysqli_stmt_close($stmt);
        if ($row['verification_code'] === $verification_code) {
            return true;
        } else {
            return false;
        }
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}