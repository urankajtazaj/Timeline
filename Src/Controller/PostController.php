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

            $stmt = $this->con->prepare("insert into post (id, content, userId) values(null, ?, ?)");
            $stmt->bind_param("si", $content, $userId);
            $stmt->execute();
            $stmt->close();

            self::redirect('../../index');
        }
    }

    public static function getPosts($order = "desc", $limit = 15) : array {
        $posts = [];

        $userId = Session::get('user')->getId();

        $stmt = self::$con->prepare("select * from post where userId = ? order by id {$order} limit ?");
        $stmt->bind_param("ii", $userId,  $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post($row['id'], $row['content'], $row['userId'], $row['date']);
        }

        $stmt->close();

        return $posts;
    }

    public static function getLikeCount($post) {
//        $content = mysqli_real_escape_string($this->con, $post['content']);
//
//        $userId = Session::Get('user')->getId();
//
//        $stmt = $this->con->prepare("insert into post (id, content, userId) values(null, ?, ?)");
//        $stmt->bind_param("si", $content, $userId);
//        $stmt->execute();
//        $stmt->close();
//
//        self::redirect('../../index');
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