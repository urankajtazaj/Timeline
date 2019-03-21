<?php

namespace Timeline\Repository\Database;

use Timeline\User;
use Timeline\Post;
use Timeline\Like;

class Database {

    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "timeline";
    private $con;

    public static function Connect() {
        return new mysqli($server, $user, $password, $database);
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