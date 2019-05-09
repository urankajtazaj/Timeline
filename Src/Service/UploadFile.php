<?php

session_start();
include_once 'Sessions.php';
include_once 'Src/Controller/UserController.php';

UserController::uploadImage($_FILES['file']);
