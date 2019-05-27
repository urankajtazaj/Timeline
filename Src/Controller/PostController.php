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

        $result = self::$con->query("select * from post where id = {$id} limit 1");

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

        self::$con->query("insert into post (id, content, image, userId) values(null, '{$content}', '{$image}', {$userId})");

        if ($redirect) {
            self::redirect('index');
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

        self::$con->query("insert into answer values (null, {$postId}, {$userId}, '{$comment}', now())");

        return json_encode([
            "user" => Session::Get('user'),
            "comment" => $comment
        ]);
    }

    // Get all replies for a single post
    public static function getReplies($post) {
        $postId = mysqli_real_escape_string(self::$con, $post['postId']);

        $result = self::$con->query("select * from answer, user where answer.post_id = {$postId} and answer.user_id = user.id order by answer.date desc");

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
        $result = self::$con->query("select count(id) as total from answer where answer.post_id = {$post_id} order by answer.date desc");
        return $result->fetch_assoc()['total'];
    }

    // Get all post made from the users that you follow
    public static function getPosts($order = "desc", $limit = 15) {
        $posts = [];

        $userId = Session::get('user')->getId();

        $result = self::$con->query("
                select DISTINCT post.* from post, follows
                where post.userId = follows.followerId and follows.userId = {$userId}
                or post.userId = {$userId} order by post.date desc limit {$limit}");

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post(
                        $row['id'],
                        $row['content'],
                        $row['userId'],
                        $row['image'],
                        $row['date']
                    );
        }

        return $posts;
    }

    // Toggle like of a post
    public static function toggleLike($post) {
        $userId = Session::get('user')->getId();

        self::$con->query(
            "update post_like
                    set status = case when status = 1 then 0 else 1 end
                    where postId = {$post} and 
                    userId = {$userId}"
        );

        if (self::$con->affected_rows == 0) {
            self::addNewLike($post);
        } else {
            echo self::isLikedByMe($post) ? "1" : "0";
        }
    }

    // Get a list of upvoters
    public static function getUpvoters($postId) {
        $upvoters = [];
        $result = self::$con->query("select user.* from user, post_like where user.id = post_like.userId and status = 1 and post_like.postId = {$postId} limit 4");

        while ($data = $result->fetch_assoc()) {
            $upvoters[] = new Upvoter(
                $data['id'],
                $data['username'],
                "secret",
                $data['name'],
                $data['image'],
                $data['bio']
            );
        }

        return $upvoters;
    }

    // Add a new like to a post
    public static function addNewLike($post) {
        $userId = Session::get('user')->getId();

        self::$con->query(
            "insert into post_like values(null, {$userId}, {$post}, 1)"
        );

        echo "1";
    }

    // Get like count of a single post
    public static function getLikeCount($post) {
        $result = self::$con->query("select sum(status) as total from post_like where postId = {$post}");

        $row = $result->fetch_assoc();

        return $row['total'] ? $row['total'] : "0";
    }

    // Check if the post is liked by the current user
    public static function isLikedByMe($post) {
        $userId = Session::get('user')->getId();
        $result = self::$con->query("select status from post_like where postId = {$post} and userId = {$userId}");

        if (self::$con->affected_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['status'] == "1" ? true : false;
        }

        return false;
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