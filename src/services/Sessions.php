<?php 

/**
 * Note: 
 * User session = user
 */

namespace Timeline\Service\Session;

use Timeline\Model\User;

class Session {
    public static function Add($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function Get($key) {
        return $_SESSION[$key];
    }

    public static function GetUser() : User {
        return $_SESSION['user'];
    }
}