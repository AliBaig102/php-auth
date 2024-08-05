<?php
require_once dirname(__DIR__)."/constant/constant.php";
function generate_token_and_code_expiration($email,$file):Array
{
    global $application_url;
//    generate 7 digit code
    $token=sprintf("%07d",mt_rand(1,9999999));
    date_default_timezone_set("Asia/Karachi");
    $code_expiration=date("Y-m-d H:i:s", strtotime("+10 minutes"));
    $url=$application_url."/$file?verification_email=$email&verification_code=$token";
    return [$token,$url,$code_expiration];
}
function secure_password($password):string
{
return password_hash($password,PASSWORD_DEFAULT);
}

function login_user($data): bool
{
    $_SESSION["user"] = $data;
    return true;
}