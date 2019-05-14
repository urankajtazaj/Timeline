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

    public static function createUser($post, $file, $redirect = true) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = mysqli_real_escape_string(self::$con, $post['username']);
            $password = mysqli_real_escape_string(self::$con, $post['password']);
            $name = mysqli_real_escape_string(self::$con, $post['name']);
            $newImageName = self::uploadImage($file['image'], $name, false);
            $image = mysqli_real_escape_string(self::$con, $newImageName);
            $bio = mysqli_real_escape_string(self::$con, $post['bio']);

            $password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = self::$con->prepare("insert into user values(null, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $password, $name, $image, $bio);
            $stmt->execute();
            $stmt->close();

            if ($redirect) {
                self::redirect("../../login");
            }
        }
    }

    public static function uploadImage($file, $folderName = null, $echo = true) {
        if ( 0 < $file['error'] ) {
            echo 'Error: ' . $file['error'] . '<br>';
        }
        else {
            $now = new DateTime();
            $year = date_format($now, 'Y');
            $month = date_format($now, 'm');
            $day = date_format($now, 'd');

            $time = date_format($now, 'H:i:s');

            $dateDirs = '/' . $year . '/' . $month . '/' . $day . '/';

            if (!$folderName) {
                $user = Session::Get('user')->getName();
            } else {
                $user = $folderName;
            }

            $filename = md5($time) . '-' . $file['name'];
            $path = 'uploads/' . $user . $dateDirs;

            if (!is_dir("../../" . $path)) {
                mkdir("../../" . $path, 0777, true);
            }

            move_uploaded_file($file['tmp_name'], "../../" . $path . $filename);

            if ($echo) {
                echo $path . $filename;
            } else {
                return $path . $filename;
            }
        }
    }

    public static function getById($id, $file = null) : User {
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

    public static function getByUsername($username, $file = null) : User {
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

    public static function getPosts($userId, $file = null) {
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

    public static function follow($id) {
        $userId = Session::Get('user')->getId();

        $stmt = self::$con->prepare("insert into follows values(null, ?, ?)");
        $stmt->bind_param("ii",$userId, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    public static function unfollow($id) {
        $userId = Session::Get('user')->getId();

        $stmt = self::$con->prepare("delete from follows where userId = ? and followerId = ?");
        $stmt->bind_param("ii",$userId, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    public static function followStatus($id) {
        $userId = Session::Get('user')->getId();

        if ($id == $userId) {
            return true;
        }

        $stmt = self::$con->prepare("select count(id) as total from follows where followerId = ? and userId = ? limit 1");
        $stmt->bind_param("ii", $id, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->fetch_assoc()['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function searchUserByName($name, $file = null) {
        $name = "%{$name}%";
        $stmt = self::$con->prepare("select * from user where name like ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $users;
    }

}

UserController::init();

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $user = new UserController();

    if (method_exists($user, $fnc)) {
        $user->$fnc($_POST, $_FILES);
    }
}