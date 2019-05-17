<?php

include $_SERVER['DOCUMENT_ROOT'] . '/Timeline/Autoload.php';

class PostController extends Timeline {

    private static $con;

    public function __construct() {
        self::$con = Database::Connect();
    }

    public static function init() {
        self::$con = Database::Connect();
    }

    // Get a single post
    public static function getPost($id) {
        $userId = Session::Get('user')->getId();

        $stmt = self::$con->prepare("select * from post where id = ? limit 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $p = $result->fetch_assoc();
        return new Post(
            $p['id'],
            $p['content'],
            $p['userId'],
            $p['image'],
            $p['date']
        );
    }

    // Create a new post
    public static function createPost($post, $redirect = true, $jsonify = false) {
        $content = mysqli_real_escape_string(self::$con, $post['content']);

        $userId = Session::Get('user')->getId();
        $image = $post['file_path'];

        $stmt = self::$con->prepare("insert into post (id, content, image, userId) values(null, ?, ?, ?)");
        $stmt->bind_param("ssi", $content, $image, $userId);
        $stmt->execute();
        $stmt->close();

        if ($redirect) {
            self::redirect('../../index');
        }

        if ($jsonify) {
            return json_encode(self::getPost(self::$con->insert_id));
        }
    }

    // Create a new comment on a post
    public static function createComment($post) {
        $comment = mysqli_real_escape_string(self::$con, $post['comment']);
        $postId = mysqli_real_escape_string(self::$con, $post['postId']);

        $userId = Session::Get('user')->getId();

        $stmt = self::$con->prepare("insert into answer values (null, ?, ?, ?, now())");
        $stmt->bind_param("iis", $postId, $userId, $comment);
        $stmt->execute();
        $stmt->close();

        return json_encode([
            "user" => Session::Get('user'),
            "comment" => $comment
        ]);
    }

    // Get all replies for a single post
    public static function getReplies($post) {
        $postId = mysqli_real_escape_string(self::$con, $post['postId']);

        $stmt = self::$con->prepare("select * from answer, user where answer.post_id = ? and answer.user_id = user.id order by answer.date desc");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $replies = [];

        while ($r = $result->fetch_assoc()) {
            $replies[] = [
                "image" => $r["image"],
                "name" => $r["name"],
                "comment" => stripslashes($r["comment"]),
                "bio" => $r["bio"],
                "date" => Timeline::getTimeAgo($r["date"]),
                "myReply" => Session::Get('user')->getId() == $r["id"] ? true : false
            ];
        }

        return json_encode($replies);
    }

    // Get replies count of a single post
    public static function getRepliesCount($post_id) {
        $stmt = self::$con->prepare("select count(id) as total from answer where answer.post_id = ? order by answer.date desc");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc()['total'];
    }

    // Get all post made from the users that you follow
    public static function getPosts($order = "desc", $limit = 15) : array {
        $posts = [];

        $userId = Session::get('user')->getId();

        $stmt = self::$con->prepare("
                select DISTINCT post.* from post, follows
                where post.userId = follows.followerId and follows.userId = ?
                or post.userId = ? order by post.date desc limit ?");
        $stmt->bind_param("iii", $userId, $userId, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post(
                        $row['id'],
                        $row['content'],
                        $row['userId'],
                        $row['image'],
                        $row['date']
                    );
        }

        $stmt->close();

        return $posts;
    }

    // Toggle like of a post
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

    // Add a new like to a post
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

    // Get like count of a single post
    public static function getLikeCount($post) {
        $stmt = self::$con->prepare("select sum(status) as total from post_like where postId = ?");
        $stmt->bind_param("i",  $post);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['total'] ? $row['total'] : "0";
    }

    // Check if the post is liked by the current user
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