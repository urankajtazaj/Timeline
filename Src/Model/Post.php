<?php 

class Post {
    
    private $id;
    private $content;
    private $date;
    private $userId;
    private $image;

    public function __construct($id, $content, $userId, $image, $date) {
        $this->id = $id;
        $this->content = $content;
        $this->userId = $userId;
        $this->image = $image;
        $this->date = $date;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getUserId() : int {
        return $this->userId;
    }

    public function getUser() : User {
        $user = UserController::getById($this->userId);
        return $user;
    }

    public function getDate() {
        return date_format(date_create($this->date), "d/m/Y (H:i)");
    }

    public function getFormatedDate() {
        return Timeline::getTimeAgo($this->date);
    }

    public function getLikeCount() {
        PostController::getLikeCount($this->id);
    }

    public function isLiked(){
        return PostController::isLikedByMe($this->id);
    }

}