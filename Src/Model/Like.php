<?php 

namespace Timeline\Model\Like;

use Timeline\Model\User;
use Timeline\Model\Post;

class Like {

    private $id;
    private $user;
    private $post;

    private $status;

    public function __construct(User $user, Post $post, $status = 1, $id = 0) {
        $this->id = $id;
        $this->userId = $user->getId();
        $this->postId = $post->getId();
        $this->status = $status;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getUser() : User {
        return $this->user;
    }

    public function getPost() : Post {
        return $this->post;
    }

    public function getStatus() : ?int {
        return $this->status;
    }

}