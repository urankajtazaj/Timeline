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

    public static function validateUrl($text) : string {
        $pattern = "/^(http:\\/\\/www\.|https:\\/\\/www\.|http:\\/\\/|https:\\/\\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\\/.*)?$/";
        $words = explode(" ", $text);

        $finalHtml = "<p>";

        foreach ($words as $word) {
            if (preg_match($pattern, $word)) {
                $finalHtml .= "<a target=\"_blank\" href=\"" . (substr($word, 0, 4) == "http" ? $word : "http://" . $word) . "\">" . $word . " </a>";
            } else {
                $finalHtml .= nl2br(stripcslashes($word)) . " ";
            }
        }

        $finalHtml .= "</p>";

        return $finalHtml;
    }

    public static function getTimeAgo($date) {

        $date = new DateTime($date);

        $now = new DateTime();
        $diff = $now->diff($date);

        if ($diff->d == 1) {
            return "Yesterday at " . date_format($date, "H:i");
        } else if ($diff->d == 0) {

            if ($diff->i == 0) {
                return "Just now";
            }

            if ($diff->h < 1) {
                return $diff->format("%i") . " minutes ago";
            }
            return "Today at " . date_format($date, "H:i");
        } else {
            return  $date->format('d/m/Y');
        }
    }

}