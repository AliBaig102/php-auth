<?php
require_once dirname(__DIR__) . "/constant/constant.php";
global $db_host, $db_user, $db_pass, $db_name;
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}