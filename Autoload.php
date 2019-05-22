<?php
/**
 * User: urank
 * Date: 3/26/2019
 * Time: 7:24 AM
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Service/Sessions.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Timeline.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/includes/Database.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Model/User.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Model/Upvoter.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Model/Post.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Controller/LoginController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Controller/PostController.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/Timeline/Src/Controller/UserController.php";
