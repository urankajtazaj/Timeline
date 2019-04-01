<?php 

//include 'Src/Controller/UserController.php';

class Post {
    
    private $id;
    private $content;
    private $date;
    private $userId;

    public function __construct($id, $content, $userId, $date) {
        $this->id = $id;
        $this->content = $content;
        $this->userId = $userId;
        $this->date = $date;
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

    public function getUser() : User {
        $user = UserController::getById($this->userId);
        return $user;
    }

    public function getDate() {
        return date_format(date_create($this->date), "d/m/Y (H:i)");
    }

}