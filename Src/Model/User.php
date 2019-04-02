<?php

class User {

    private $id;

    private $username;
    private $password;

    private $name;
    private $image;
    private $bio;

    private $friends = [];

    public function __construct($id, $username, $password, $name, $image = "", $bio = "") {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->image = $image;
        $this->bio = $bio;
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

    public function getFriends(): array {
        return $this->friends;
    }

    public function setFriends(array $friends) {
        $this->friends = $friends;
    }
}