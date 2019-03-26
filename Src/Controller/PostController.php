<?php 

//namespace Timeline\Controller\PostController;


class PostController {

    private $con;

    public function __construct() {
        $this->con = Database::Connect();
    }

    public function createPost() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = mysqli_real_escape_string($this->con, $_POST['content']);

            $stmt = $this->con->prepare("insert into post values(null, ?, ?)");
            $stmt->bind_param("si", $content, Session::Get('user')->getId());
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getPosts($order = "desc", $limit = 15) : array {
        $posts = [];

        $stmt = $this->con->prepare("select * from post where post.userId = ? order by post.id ? limit ?");
        $stmt->bind_param("isi", Session::get('user')->getId(), $order, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post($row['id'], $row['content'], $row['userId']);
        }

        $stmt->close();

        return $posts;
    }

}