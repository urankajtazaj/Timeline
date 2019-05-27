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

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getBio() {
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

    public function setName($name) {
        $this->name = $name;
    }

    public function setImage(string $image) {
        $this->image = $image;
    }

    public function setBio(string $bio) {
        $this->bio = $bio;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}