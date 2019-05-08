<?php

//include dirname(__DIR__) . '/Timeline.php';
//include dirname(__DIR__) . '/Controller/UserController.php';
//include dirname(__DIR__) . '/Service/Sessions.php';
//include dirname(__DIR__) . '/Model/Post.php';
//
//session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/Timeline/Autoload.php';

class PostController extends Timeline {

    private static $con;

    public function __construct() {
        $this->con = Database::Connect();
    }

    public static function init() {
        self::$con = Database::Connect();
    }

    public function createPost($post) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = mysqli_real_escape_string($this->con, $post['content']);

            $userId = Session::Get('user')->getId();
            $image = $post['file_path'];

            $stmt = $this->con->prepare("insert into post (id, content, image, userId) values(null, ?, ?, ?)");
            $stmt->bind_param("ssi", $content, $image, $userId);
            $stmt->execute();
            $stmt->close();

            self::redirect('../../index');
        }
    }

    public static function getPosts($order = "desc", $limit = 15) : array {
        $posts = [];

        $userId = Session::get('user')->getId();

        $stmt = self::$con->prepare("select * from post order by id {$order} limit ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post($row['id'], $row['content'], $row['userId'], $row['image'], $row['date']);
        }

        $stmt->close();

        return $posts;
    }

    public static function toggleLike($post) {
        $userId = Session::get('user')->getId();

        $stmt = self::$con->prepare(
            "update post_like
                    set status = case when status = 1 then 0 else 1 end
                    where postId = ? and 
                    userId = ?"
        );
        $stmt->bind_param("ii", $post, $userId);
        $stmt->execute();

        if ($stmt->affected_rows == 0) {
            self::addNewLike($post);
        } else {
            echo self::isLikedByMe($post) ? "1" : "0";
        }

        $stmt->close();
    }

    public static function addNewLike($post) {
        $userId = Session::get('user')->getId();

        $stmt = self::$con->prepare(
            "insert into post_like values(null, ?, ?, 1)"
        );
        $stmt->bind_param("ii", $userId, $post);
        $stmt->execute();

        echo "1";
        $stmt->close();
    }

    public static function getLikeCount($post) {
        $stmt = self::$con->prepare("select sum(status) as total from post_like where postId = ?");
        $stmt->bind_param("i",  $post);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        echo $row['total'] ? $row['total'] : "0";

        $stmt->close();
    }

    public static function isLikedByMe($post) : bool {
        $userId = Session::get('user')->getId();
        $stmt = self::$con->prepare("select status from post_like where postId = ? and userId = ?");
        $stmt->bind_param("ii",  $post, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $row = $result->fetch_assoc();
            return $row['status'] == "1" ? true : false;
        } else {
            $stmt->close();
            return false;
        }

    }
}

PostController::init();

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $post = new PostController();

    if (method_exists($post, $fnc)) {
        $post->$fnc($_POST);
    }
}