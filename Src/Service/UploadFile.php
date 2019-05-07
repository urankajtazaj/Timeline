<?php

session_start();
include_once 'Sessions.php';
include_once '../Model/User.php';

if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    $now = new DateTime();
    $year = date_format($now, 'Y');
    $month = date_format($now, 'm');
    $day = date_format($now, 'd');

    $time = date_format($now, 'H:i:s');

    $dateDirs = '/' . $year . '/' . $month . '/' . $day . '/';

    $user = Session::Get('user')->getName();

    $filename = md5($time) . '-' . $_FILES['file']['name'];
    $path = 'uploads/' .  $user . $dateDirs;

    if (!is_dir("../../" . $path)) {
        mkdir("../../" . $path, 0777, true);
    }

    move_uploaded_file($_FILES['file']['tmp_name'], "../../" . $path . $filename);

    echo $path . $filename;
}