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

    // Create a new user
    public static function createUser($post, $file, $redirect = true) {
        $username = mysqli_real_escape_string(self::$con, trim($post['_username']));
        $password = mysqli_real_escape_string(self::$con, trim($post['password']));
        $name = mysqli_real_escape_string(self::$con, trim($post['_name']));
        $newImageName = substr($file['image'], 0, 4) != "http" ? self::uploadImage($file['image'], $name, false) : $file['image'];
        $image = mysqli_real_escape_string(self::$con, $newImageName);
        $bio = mysqli_real_escape_string(self::$con, trim($post['_bio']));

        $invalid = false;
        $invalid_msg = "";

        if (strlen($username) < 3) {
            $invalid = true;
            $invalid_msg .= "Username should be longer than 3 characters<br/>";
        }

        if (strlen($name) < 3) {
            $invalid = true;
            $invalid_msg .= "Name should be longer than 3 characters<br/>";
        }

        if ($invalid) {
            self::redirect("register", "message={$invalid_msg}&_username={$username}&_name={$name}&_bio={$bio}");
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        self::$con->query("insert into user values(null, '{$username}', '{$password}', '{$name}', '{$newImageName}', '{$bio}')");

        if ($redirect) {
            self::redirect("login");
        }
    }

    // Update user data from a post request
    public static function updateUser($post, $file) {

        $imageUrl = substr($post['file_path_profile'], 0, 3) == "://" ?
            "https" . $post['file_path_profile'] :
            $post['file_path_profile'];

        $name = mysqli_real_escape_string(self::$con, trim($post['name']));
        $newImageName = $file['image_profile']['error'] == 0 ? self::uploadImage($file['image_profile'], $name, false) : $imageUrl;
        $image = mysqli_real_escape_string(self::$con, $newImageName);
        $bio = mysqli_real_escape_string(self::$con, trim($post['bio']));

        $userId = Session::Get('user')->getId();

        self::$con->query("update user set image = '{$image}', name = '{$name}', bio = '{$bio}' where id = {$userId}");

        $updatedUser = new User($userId, Session::Get('user')->getUsername(), Session::Get('user')->getPassword(), $name, $image, $bio);

        Session::Add('user', $updatedUser);

        self::redirect("index");
    }

    // Upload an image form a new post or from the user profile
    public static function uploadImage($file, $folderName = null, $echo = true) {

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
            mkdir("../../" . $path, 0775, true);
        }

        move_uploaded_file($file['tmp_name'], "../../" . $path . $filename);

        if ($echo) {
            echo $path . $filename;
        } else {
            return $path . $filename;
        }
    }

    // Get a user by id
    public static function getById($id, $file = null) {
        $result = self::$con->query("select * from user where user.id = {$id}");

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

    public static function getPopular() {
        $users = [];

        $result = self::$con->query("select distinct user.*, count(follows.userId) as followers from user, follows where user.id = follows.followerId group by user.id order by followers desc limit 8");

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $users[] = new User(
                    $data['id'],
                    $data['username'],
                    "secret",
                    $data['name'],
                    $data['image'],
                    $data['bio']
                );
            }
            return $users;
        } else {
            return null;
        }
    }

    public static function getByUsername($username, $file = null, $redirect = true) {
        $username = trim($username);
        $result = self::$con->query("select * from user where user.username = '{$username}' limit 1");

        $data = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $user = new User(
                $data['id'],
                $data['username'],
                $data['password'],
                $data['name'],
                $data['image'],
                $data['bio']
            );
            return $user;
        } else if ($redirect) {
            self::redirect("login", 'message=invalid&_username=' . $username);
        }
    }

    public static function getPosts($userId, $file = null) {
        $result = self::$con->query("select * from post where post.userId = {$userId}");

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

    public static function downloadPosts() {
        $file = fopen($_SERVER['DOCUMENT_ROOT'] . "/Timeline/export/" . date_format(new DateTime(), "Posts - Y-m-d H-i-s") . ".csv", "w");

        $posts = self::getPosts(Session::Get('user')->getId());

        fwrite($file, "User,\tPost,\tImage\r\n");
        foreach ($posts as $post) {
            $line = $post->getUser()->getName() . ", " . $post->getContent() . ", " . $post->getImage() . "\r\n";
            fwrite($file, $line);
        }
        fclose($file);
        echo "<h1 class='display-4' style='text-align: center; padding-top: 50px;'>File has been saved to the <code>export</code> folder</h1>";
        echo "<a href='#' style='display: block; text-align: center' onclick='window.close();return false;'>Close Tab</a>";
    }

    public static function follow($id) {
        $userId = Session::Get('user')->getId();

        self::$con->query("insert into follows values(null, {$userId}, {$id})");

        if (self::$con->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function unfollow($id) {
        $userId = Session::Get('user')->getId();

        self::$con->query("delete from follows where userId = {$userId} and followerId = {$id}");

        if (self::$con->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function followStatus($id) {
        $userId = Session::Get('user')->getId();

        if ($id == $userId) {
            return true;
        }

        $result = self::$con->query("select count(id) as total from follows where followerId = {$id} and userId = {$userId} limit 1");

        if ($result->fetch_assoc()['total'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function searchUserByName($name, $file = null) {

        $users = [];

        $name = "%" . trim($name) . "%";
        $result = self::$con->query("select * from user where name like '{$name}'");

        while ($row = $result->fetch_assoc()) {
            $users[] = new User(
                $row['id'],
                $row['username'],
                "secret",
                $row['name'],
                $row['image'],
                $row['bio']
            );
        }

        return $users;
    }

    public static function getFollowing($id) {
        $result = self::$con->query("select count(user.id) as total from user, follows where follows.userId = {$id} and user.id = follows.followerId");
        return $result->fetch_assoc()['total'];
    }

    public static function getFollowers($id) {
        $result = self::$con->query("select count(follows.userId) as total from user, follows where follows.followerId = {$id} and user.id = follows.userId");
        return $result->fetch_assoc()['total'];
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