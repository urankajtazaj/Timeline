<?php
/**
 * Created by PhpStorm.
 * User: urank
 * Date: 3/25/2019
 * Time: 7:25 PM
 */

class Timeline {

    public function path($route) {
        return $_SERVER['SERVER_NAME'] . "/" . $route . ".php";
    }

    public function redirect($route) {
        header("Location: " . $_SERVER['SERVER_NAME'] . "/" . strtolower($route) . ".php");
        exit();
    }

}