<?php

require_once '../Controller/UserController.php';

if (isset($_GET)) {
    $query = htmlspecialchars($_GET['q']);
    echo json_encode(UserController::searchUserByName($query));
}