<?php

spl_autoload_register(function ($class) {
    require "../Model/" . $class . ".php";
});

require "../../includes/Database.php";
require "../Model/User.php";

class UserController {

    private static $con;

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

    public static function getById($id) : User {
        $stmt = self::$con->prepare("select * from user where user.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $data = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            return new User(
                $data['id'],
                $data['username'],
                $data['password'],
                $data['name'],
                $data['image'],
                $data['bio']
            );
        } else {
            return null;
        }
    }

    public static function getByUsername($username) : User {
        $stmt = self::$con->prepare("select * from user where user.username = ? limit 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $data = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            return new User(
                $data['id'],
                $data['username'],
                $data['password'],
                $data['name'],
                $data['image'],
                $data['bio']
            );
        } else {
            return null;
        }

    }

    public function getUsers() : array {
        /**
         * TODO: returns a list of users
         */
    }

}
?>