<?php 

class Post implements JsonSerializable {
    
    private $id;
    private $content;
    private $date;
    private $userId;
    private $image;
    private $formatedDate;
    private $isLiked;
    private $likeCount;
    private $user;
    private $replyCount = 0;

    public function __construct($id, $content, $userId, $image, $date) {
        $this->id = $id;
        $this->content = $content;
        $this->userId = $userId;
        $this->image = $image;
        $this->date = $date;
        $this->formatedDate = Timeline::getTimeAgo($this->date);
        $this->isLiked = PostController::isLikedByMe($this->id);
        $this->likeCount = PostController::getLikeCount($this->id);
        $this->user = UserController::getById($this->userId);
        $this->replyCount = PostController::getRepliesCount($this->id);
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getUser() {
        return $this->user;
    }

    public function getDate() {
        return date_format(date_create($this->date), "d/m/Y (H:i)");
    }

    public function getFormatedDate() {
        return $this->formatedDate;
    }

    public function getLikeCount() {
        return $this->likeCount;
    }

    public function isLiked(){
        return $this->isLiked;
    }

    public function getReplyCount() {
        return $this->replyCount;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}