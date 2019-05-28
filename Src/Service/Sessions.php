<?php 

/**
 * Note: 
 * User session = user
 */

class Session
{
    public static function Add($key, $value) {
        if ($key == 'user') {
            $_SESSION[$key] = serialize($value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public static function Get($key) {
        if ($key == 'user') {
            return unserialize($_SESSION[$key]);
        } else {
            return $_SESSION[$key];
        }
    }

    public static function DestroySession($key) {
        $_SESSION[$key] = null;
        session_unset($_SESSION[$key]);
    }


    /*
     * COOKIES ****************************************
     */


    public static function AddCookie($key, $value) {
        if ($key == 'user') {
            $value = serialize($value);
        }
        setcookie($key, $value, time() + (86400 * 30), "/"); // Expires in 1 day
    }

    public static function GetCookie($key) {
        if ($key == 'user') {
            return unserialize($_COOKIE[$key]);
        } else {
            return $_COOKIE[$key];
        }
    }

    public static function DestroyCookie($key) {
        unset($_COOKIE[$key]);
        setcookie($key, "", time() - 3600, "/"); // Expired 1 hour ago
    }

}