<?php

require "../Controller/UserController.php";

$user = new UserController();
echo $user->getUser(4)->getName();

?>