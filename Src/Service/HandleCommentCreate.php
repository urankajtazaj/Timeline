<?php

require_once '../Controller/PostController.php';

$post['comment'] = $_POST['comment'];
$post['postId'] = $_POST['postId'];

echo PostController::createComment($post);
