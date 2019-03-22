<?php

spl_autoload_register(function ($class) {
    require "../Model/" . $class . ".php";
});

require "../../includes/Database.php";
require "../Model/User.php";

class UserController {

    private $con;

    public function __construct() {
        $this->con = Database::Connect();
    }

    public function createUser($username, $password, $name, $image = "", $bio = "") : self {
        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->con->prepare("insert into user values(null, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $name, $image, $bio);
        $stmt->execute();
        $stmt->close();

        return $this;
    }

    public function getUser($id) : User {
        $stmt = $this->con->prepare("select * from user where user.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $data = $result->fetch_assoc();

        return new User(
            $data['id'],
            $data['username'],
            $data['name'],
            $data['image'],
            $data['bio']
        );
    }

    public function getUsers() : array {
        /**
         * TODO: returns a list of users
         */
    }

}
?>