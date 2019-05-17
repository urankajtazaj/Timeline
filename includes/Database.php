<?php
class Database {

    private static $server = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $database = "timeline";

    public static function Connect() {
        return new mysqli(self::$server, self::$username, self::$password, self::$database);
    }
}
