<?php
/**
 * Created by PhpStorm.
 * User: urank
 * Date: 3/25/2019
 * Time: 7:25 PM
 */

class Timeline {

    public static function path($route) {
        return strtolower($route) . ".php";
    }

    public static function controllerPath($route) {
        return "Src/Controller/" . strtolower($route) . "Controller.php";
    }

    public static function redirect($route, $extra = '') {
        header("Location: " . strtolower($route) . ".php" . (!empty($extra) ? "?" . $extra : ''));
        exit();
    }

    public static function goToFunction($controller, $method) {
        return "Src/Controller/" . ucfirst($controller) . "Controller.php?action=" . $method;
    }

}