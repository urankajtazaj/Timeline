<?php

session_start();
include_once 'Sessions.php';
include_once '../Controller/UserController.php';

UserController::uploadImage($_FILES['file']);
