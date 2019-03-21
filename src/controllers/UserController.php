<?php 

namespace Timeline\Controller\UserController;

use Timeline\Model\User;
use Timeline\Model\Post;
use Timeline\Repository\Database;
use Timeline\Service\Session;

class UserController {

    private $con;

    public function __construct() {
        $this->con = Database::Connect();
    }

    public function createUser($username, $password, $name, $image = "", $bio = "") {
        /**
         * TODO: Add a user to the database
         * [insert into user ...]
         */
    }

    public function getUser($id) : User {
        /**
         * TODO: returns a user
         * [select * from user where id = $id]
         */
    }

    public function getUsers() : array {
        /**
         * TODO: returns a list of users
         */
    }

}