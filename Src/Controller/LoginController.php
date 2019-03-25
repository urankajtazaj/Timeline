<?php
/**
 * Created by PhpStorm.
 * User: u.kajtazaj
 * Date: 3/25/2019
 * Time: 8:56 AM
 */

spl_autoload_register(function ($class) {
    require "../Model/" . $class . ".php";
});

require "../../includes/Database.php";
require "../Model/User.php";
require "../Service/Sessions.php";

class LoginController
{
    private $failMessage = "Username or password is incorrect";
    private $con;

    public function __construct() {
        $this->con = Database::Connect();
    }

    public function login() {
        $username = mysqli_real_escape_string($this->con, $_POST['username']);
        $password = $_POST['password'];

        $user = User::getByUsername($username);

        if ($user) {
            if (password_verify($password, $user->getPassword())) {
                /**
                 * TODO: Redirect to home
                 * User logged in
                 */
                Session::Add('user', $user);
            } else {
                /**
                 * TODO: Password is incorrect
                 */
                echo $this->failMessage;
            }
        } else {
            echo $this->failMessage;
        }
    }

}