<?php
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

        $emailPattern = "/^[\w\._]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";

        $username = mysqli_real_escape_string(self::$con, trim($post['_username']));
        $password = mysqli_real_escape_string(self::$con, trim($post['password']));
        $email = mysqli_real_escape_string(self::$con, trim($post['_email']));
        $name = mysqli_real_escape_string(self::$con, trim($post['_name']));
        $newImageName = !is_array($file['image'])
            ? (substr($file['image'], 0, 4) != "http" ? self::uploadImage($file['image'], $name, false) : $file['image'])
            : ($file['image']['error'] == 0 ? self::uploadImage($file['image'], $name, false) : '');
        $image = mysqli_real_escape_string(self::$con, $newImageName);
        $bio = mysqli_real_escape_string(self::$con, trim($post['_bio']));

        $invalid = false;
        $invalid_msg = "";

        if (!preg_match($emailPattern, $email)) {
            $invalid = true;
            $invalid_msg .= "Email is not valid<br/>";
        }

        if (strlen($username) < 3) {
            $invalid = true;
            $invalid_msg .= "Username should be longer than 3 characters<br/>";
        }

        if (strlen($name) < 3) {
            $invalid = true;
            $invalid_msg .= "Name should be longer than 3 characters<br/>";
        }

        if ($invalid) {
            self::redirect("register", "message={$invalid_msg}&_username={$username}&_name={$name}&_bio={$bio}&_email={$email}");
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = self::$con->prepare("insert into user values(null, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $name, $newImageName, $bio, $email);
        $stmt->execute();
        $stmt->close();

        Timeline::sendEmail($email, $name);

        if ($redirect) {
            Session::Add('user', new User(self::$con->insert_id, $username, "secret", $name, $email, $image, $bio));
            self::redirect("index");
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

        $stmt = self::$con->prepare("update user set image = ?, name = ?, bio = ? where id = ?");
        $stmt->bind_param("sssi", $image, $name, $bio, $userId);
        $stmt->execute();
        $stmt->close();

        $updatedUser = new User($userId, Session::Get('user')->getUsername(), Session::Get('user')->getPassword(), $name, Session::Get('user')->getEmail(), $image, $bio);

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
        $stmt = self::$con->prepare("select * from user where user.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result->fetch_assoc();

        $stmt->close();

        if ($result->num_rows > 0) {
            return new User(
                $data['id'],
                $data['username'],
                $data['password'],
                $data['name'],
                $data['email'],
                $data['image'],
                $data['bio']
            );
        } else {
            return null;
        }
    }

    public static function getPopular($limit = 5) {
        $users = [];

        $stmt = self::$con->prepare("select distinct user.*, count(follows.userId) as followers from user, follows where user.id = follows.followerId group by user.id order by followers desc limit ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $users[] = new User(
                    $data['id'],
                    $data['username'],
                    "secret",
                    $data['name'],
                    $data['email'],
                    $data['image'],
                    $data['bio']
                );
            }
            $stmt->close();
            return $users;
        } else {
            $stmt->close();
            return null;
        }
    }

    public static function getByUsername($username, $file = null, $redirect = true) {
        $username = trim($username);
        $stmt = self::$con->prepare("select * from user where user.username = ? limit 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result->fetch_assoc();

        $stmt->close();

        if ($result->num_rows > 0) {
            $user = new User(
                $data['id'],
                $data['username'],
                $data['password'],
                $data['name'],
                $data['email'],
                $data['image'],
                $data['bio']
            );
            return $user;
        } else if ($redirect) {
            self::redirect("login", 'message=invalid&_username=' . $username);
        }
    }

    public static function getPosts($userId, $file = null, $orderBy = "id", $order = "DESC") {
        $stmt = self::$con->prepare("select * from post where post.userId = ? order by {$orderBy} {$order}");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

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

        $stmt->close();
        return $posts;
    }

    public static function follow($id) {
        $userId = Session::Get('user')->getId();

        $stmt = self::$con->prepare("insert into follows values(null, ?, ?)");
        $stmt->bind_param("ii", $userId, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public static function unfollow($id) {
        $userId = Session::Get('user')->getId();

        $stmt = self::$con->prepare("delete from follows where userId = ? and followerId = ?");
        $stmt->bind_param("ii", $userId, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
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

        if ($result->fetch_assoc()['total'] > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public static function searchUserByName($name, $file = null) {

        $users = [];

        $name = "%" . trim($name) . "%";
        $stmt = self::$con->prepare("select * from user where name like ? or username like ? or bio like ?");
        $stmt->bind_param("sss", $name, $name, $name);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $users[] = new User(
                $row['id'],
                $row['username'],
                "secret",
                $row['name'],
                $row['email'],
                $row['image'],
                $row['bio']
            );
        }

        $stmt->close();
        return $users;
    }

    public static function getFollowing($id) {
        $stmt = self::$con->prepare("select count(user.id) as total from user, follows where follows.userId = ? and user.id = follows.followerId");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['total'];
    }

    public static function getFollowers($id) {
        $stmt = self::$con->prepare("select count(follows.userId) as total from user, follows where follows.followerId = ? and user.id = follows.userId");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['total'];
    }


    // Create a file and make it downloadable
    public static function downloadPosts() {
        $dirpath = "../../export/" . Session::Get('user')->getId() . "/";
        $filename = $dirpath . "Posts-" . date_format(new DateTime(), "Y-m-d-H-i-s") . ".csv";

        if (!is_dir($dirpath)) {
            mkdir($dirpath, 0775, true);
        }

        $file = fopen($filename, "w");

        $posts = self::getPosts(Session::Get('user')->getId());

        fwrite($file, "User, Post, Image\r\n");
        foreach ($posts as $post) {
            $line = $post->getUser()->getName() . ", " . str_replace(",", "", $post->getContent()) . ", " . $post->getImage() . "\r\n";
            fwrite($file, $line);
        }
        fclose($file);
        echo "<h1 class='display-4' style='text-align: center; padding-top: 50px;'>File has been saved successfully</h1>";
        echo "<a href='{$filename}' download style='display: block; text-align: center'>Download file</a>";
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