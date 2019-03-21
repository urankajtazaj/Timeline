<?php 

namespace Timeline\Post;

class Post {
    
    private $id;
    private $content;

    private $userId;

    public function __construct($id, $content, $userId) {
        $this->id = $id;
        $this->content = $content;
        $this->userId = $userId;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function getUserId() : int {
        return $this->userId;
    }

}