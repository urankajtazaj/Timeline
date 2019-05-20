<?php
/**
 * User: urank
 * Date: 3/25/2019
 * Time: 7:25 PM
 */

class Timeline {

    public static function path($route) {
        return strtolower($route) . ".php";
    }

    // Return a string of the full path of the given controller name
    public static function controllerPath($route) {
        return "Src/Controller/" . ucfirst($route) . "Controller.php";
    }

    // Redirect to another php file
    public static function redirect($route, $extra = '') {
        header("Location: ../../" . strtolower($route) . ".php" . (!empty($extra) ? "?" . $extra : ''));
        exit();
    }

    // Redirect to another php file (absolute path)
    public static function redirectAbs($route, $extra = '') {
        header("Location: " . strtolower($route) . ".php" . (!empty($extra) ? "?" . $extra : ''));
        exit();
    }

    // Go to a specific function of a controller
    public static function goToFunction($controller, $method) {
        return "Src/Controller/" . ucfirst($controller) . "Controller.php?action=" . $method;
    }

    // Checks every word of the post if it's a url
    public static function validateUrl($text) : string {
        $pattern = "/^(http:\\/\\/www\.|https:\\/\\/www\.|http:\\/\\/|https:\\/\\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\\/.*)?$/";
        $mentionPattern = "/^([\\n]+)?[#|@][\w\d]+$/";
        $words = explode(" ", $text);

        $finalHtml = "<p>";

        foreach ($words as $word) {
            $word = trim($word);
            $nlstr = nl2br(stripcslashes($word));
            $url = str_replace('\n', '', $word);
            if (preg_match($pattern, $url)) {
                $finalHtml .= "<a target=\"_blank\" href=\"" . (substr($url, 0, 4) == "http" ? $url : "http://" . $url) . "\">" . $nlstr . " </a>";
            } else if (preg_match($mentionPattern, $word)) {
                $finalHtml .= "<a href='#!'>{$nlstr}</a> ";
            } else {
                $finalHtml .= $nlstr . " ";
            }
        }

        $finalHtml .= "</p>";

        return $finalHtml;
    }

    // Converts time to a human readable format
    public static function getTimeAgo($date) {

        $fullDate = new DateTime($date);

        $datetime = new DateTime($fullDate->format("Y-m-d"));
        $now = new DateTime();

        $diff = $now->diff($datetime, true);

        if ($diff->d == 1) {
            return "Yesterday at " . $fullDate->format("H:i");
        } else if ($diff->d == 0) {

            if ($now->diff($fullDate)->i == 0) {
                return "Just now";
            }

            if ($now->diff($fullDate)->h < 1) {
                return $now->diff($fullDate)->format("%i") . " minutes ago";
            }
            return "Today at " . $fullDate->format("H:i");
        } else {
            return  $fullDate->format('d/m/Y');
        }
    }

}
