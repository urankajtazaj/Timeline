<?php
/**
 * Created by PhpStorm.
 * User: urank
 * Date: 3/26/2019
 * Time: 7:24 AM
 */

//if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
//}

require "Src/Service/Sessions.php";
require "Src/Timeline.php";
require "includes/Database.php";
//require "Src/Controller/LoginController.php";
//require "Src/Controller/PostController.php";
//require "Src/Controller/UserController.php";
require "Src/Model/User.php";
require "Src/Model/Post.php";
require "Src/Model/Like.php";
