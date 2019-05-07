<?php

require_once '../Controller/PostController.php';

if (isset($_GET)) {
    $post = $_GET['post_id'];
    PostController::toggleLike($post);
}