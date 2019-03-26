<?php

require "Autoload.php";

$user = new UserController();
echo $user->path("index");
echo $user->getById(4)->getName();

?>