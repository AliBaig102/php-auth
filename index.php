<?php
session_start();
require_once "utils/functions.php";
require_once "utils/auth-functions.php";
// autoload.php @generated by Composer
//require __DIR__ . '/vendor/autoload.php';
//use Dotenv\Dotenv;
//
//$dotenv = Dotenv::createImmutable(__DIR__);
//$dotenv->load();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <title>Authentication System : Home Page</title>
</head>
<body>
<?php
require_once 'partials/nav.php';
?>
<main>
    <div class="heading">

        <h1>
            Welcome to Authentication System
        </h1>
        <h2>
            Welcome <?= $_SESSION["user"]["name"] ?? "Guest"; ?>
        </h2>
    </div>
    <?php
    require_once 'partials/login-popup.php';
    require_once 'partials/signup-popup.php';
    require_once 'partials/forgot-password-popup.php';
    require_once 'partials/email-verification-popup.php';
//    require_once 'partials/regenerate-verification-popup.php';
    ?>
</main>
<?php
require_once 'partials/footer.php';

if (isset($_SESSION["toast"]["success"])) {
    $success_message = $_SESSION["toast"]["success"] ?? "";
    echo '<script>
        Toastify({
            text: "' . $success_message . '",
            duration: 5000,
            offset: {
                y: 30,
            },
            position: "right", // `left`, `center` or `right`
            gravity: "right", // `top` or `bottom`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#65B741",
                color: "#222",
                borderBottom: "3px solid #387F39",
                padding: "10px 20px",
                boxShadow: "0 0 5px #387F39",
            },
            onClick: function(){} // Callback after click
        }).showToast();
    </script>';
    unset($_SESSION["toast"]["success"]);
}else if (isset($_SESSION["toast"]["error"])) {
    $error_message = $_SESSION["toast"]["error"] ?? "";
    echo '<script>
        Toastify({
            text: "' . $error_message . '",
            duration: 5000,
            offset: {
                y: 30,
            },
            position: "right", // `left`, `center` or `right`
            gravity: "right", // `top` or `bottom`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#FF6969",
                color: "#222",
                borderBottom: "3px solid #FF6969",
                padding: "10px 20px",
                boxShadow: "0 0 5px #FF6969",
            },
            onClick: function(){} // Callback after click
        }).showToast();
    </script>';
    unset($_SESSION["toast"]["error"]);
}
?>
</body>
</html>