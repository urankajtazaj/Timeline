<?php 

/**
 * Note: 
 * User session = user
 */

include "../Model/User.php";

class Session
{
    public static function Add($key, $value)
    {
        if ($key == 'user') {
            $_SESSION[$key] = serialize($value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public static function Get($key)
    {
        if ($key == 'user') {
            return unserialize($_SESSION[$key]);
        } else {
            return $_SESSION[$key];
        }
    }

}