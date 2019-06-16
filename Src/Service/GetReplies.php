<?php

require_once '../Controller/PostController.php';

$post['postId'] = $_POST['post_id'];

echo PostController::getReplies($post, true);
