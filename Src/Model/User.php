<?php

class User implements JsonSerializable {

    private $id;

    private $username;
    private $password;

    private $name;
    private $image;
    private $bio;

    private $following = [];
    private $followers = [];

    public function __construct($id, $username, $password, $name, $image = "", $bio = "") {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->image = $image;
        $this->bio = $bio;
        $this->followers = UserController::getFollowers($this->id);
        $this->following = UserController::getFollowing($this->id);
    }

    public function getId() : int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFollowing() {
        return $this->following;
    }

    public function getFollowers() {
        return $this->followers;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}