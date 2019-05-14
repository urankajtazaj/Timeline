<?php

require_once '../Controller/UserController.php';

if (isset($_POST)) {
    $id = $_POST['userId'];
    echo UserController::follow($id);
}