<?php

//spl_autoload_register(function ($class) {
//    require "../Model/" . $class . ".php";
//});

//require 'includes/Database.php';
//require 'Src/Model/User.php';

include $_SERVER['DOCUMENT_ROOT'] . '/Timeline/Autoload.php';

class UserController extends Timeline {

    private static $con;

    static function init() {
        self::$con = Database::Connect();
    }

    public function __construct() {
        self::$con = Database::Connect();
    }

    public static function createUser($post) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = mysqli_real_escape_string(self::$con, $post['username']);
            $password = mysqli_real_escape_string(self::$con, $post['password']);
            $name = mysqli_real_escape_string(self::$con, $post['name']);
            $image = mysqli_real_escape_string(self::$con, $post['image']);
            $bio = mysqli_real_escape_string(self::$con, $post['bio']);

            $password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = self::$con->prepare("insert into user values(null, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $password, $name, $image, $bio);
            $stmt->execute();
            $stmt->close();
        }
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
            self::redirect("../../login", 'message=invalid&_username=' . $username);
        }
    }

    public static function getPosts($userId) {
        $stmt = self::$con->prepare("select * from post where post.userId = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $posts = [];

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post(
                $row['id'],
                $row['content'],
                $userId,
                $row['image'],
                $row['date']
            );
        }

        return $posts;
    }

    public static function addFriend() {

    }

}

UserController::init();

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $user = new UserController();

    if (method_exists($user, $fnc)) {
        $user->$fnc($_POST);
    }
}