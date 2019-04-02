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
        return "Src/Controller/" . ucfirst($route) . "Controller.php";
    }

    public static function redirect($route, $extra = '') {
        header("Location: " . strtolower($route) . ".php" . (!empty($extra) ? "?" . $extra : ''));
        exit();
    }

    public static function goToFunction($controller, $method) {
        return "Src/Controller/" . ucfirst($controller) . "Controller.php?action=" . $method;
    }

    public static function getTimeAgo($date) {

        $date = new DateTime($date);

        $now = new DateTime();
        $diff = $now->diff($date);

        if ($diff->format("%d") == 1) {
            return "Yesterday at " . date_format($date, "H:i");
        } else if ($diff->format("%d") == 0) {
            if ($diff->format("%h") < 1) {
                return $diff->format("%i") . " minutes ago";
            }
            return "Today at " . date_format($date, "H:i");
        } else {
            return  $date->format('d/m/Y');
        }
    }

}