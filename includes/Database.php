<?php

// namespace Includes\Database;

// function __autoload($class) {
//     require "../Model/" . $class . ".php";
// }

// use Src\Model\User;
// use Src\Model\Post;
// use Src\Model\Like;

class Database {

    private static $server = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $database = "timeline";

    public static function Connect() {
        return new mysqli(self::$server, self::$username, self::$password, self::$database);
    }

    public function addLike(Post $post, User $user) {
        $like = new Like($post, $user);
        /**
         * TODO: Add like to the database
         * [insert into like values ...]
         */
    }
}


?>