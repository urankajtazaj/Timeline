<?php


class LikeController
{

    public function handleLike($get) {
        $user_id = $get['user_id'];
        $post_id = $get['post_id'];
        $status = $get['status'];

        return "like/disliked";

    }
}

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $like = new LikeController();

    if (method_exists($like, $fnc)) {
        $like->$fnc($_GET);
    }
}