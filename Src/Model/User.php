<?php

class User {

    private $id;

    private $username;
    private $password;

    private $name;
    private $image;
    private $bio;

    public function __construct($id, $username, $name, $image = "", $bio = "") {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->image = $image;
        $this->bio = $bio;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getImageUrl() : string {
        return $this->image;
    }

    public function getBio() : string {
        return $this->bio;
    }
}