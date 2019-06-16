<?php
require "Autoload.php";

$basename = basename($_SERVER['PHP_SELF']);
$redirect = false;

if (isset($_COOKIE['user'])) {
    Session::Add('user', Session::GetCookie('user'));
}

if ($basename != 'login.php' && $basename != 'register.php' && !isset($_SESSION['user']) && $basename != 'fb-callback.php' ) {
    $redirect = true;
}

if ($redirect) {
    Timeline::redirectAbs("login");
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Timeline</title>
</head>
<body>
<?php
if (isset($_SESSION['user'])) {
//    include 'includes/PostModal.php';
    include 'includes/ProfileModal.php';
}
?>
