<?php

require_once '../Controller/PostController.php';

$post['content'] = $_POST['content'];
$post['file_path'] = $_POST['file_path'];

echo PostController::createPost($post, false, true);
