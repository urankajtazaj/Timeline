<?php


class LikeController
{

    public function handleLike($get) {
        $user_id = $get['user_id'];
        $post_id = $get['post_id'];
        $status = $get['status'];

        echo $user_id;
    }
}

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $like = new LikeController();

    if (method_exists($like, $fnc)) {
        $like->$fnc($_GET);
    }
}