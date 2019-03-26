<?php
/**
 * Created by PhpStorm.
 * User: u.kajtazaj
 * Date: 3/25/2019
 * Time: 8:56 AM
 */

require '../Timeline.php';
require '../Controller/UserController.php';
require '../Service/Sessions.php';
//require '../../includes/Database.php';

session_start();

class LoginController extends Timeline
{
    private static $failMessage;
    private $con;

    public function __construct() {
        $this->con = Database::Connect();
    }

    public function login($post) {
        $username = mysqli_real_escape_string($this->con, $post['username']);
        $password = $post['password'];

        $user = UserController::getByUsername($username);

        if ($user) {
            if (password_verify($password, $user->getPassword())) {
                /**
                 * TODO: Redirect to home
                 * User logged in
                 */
                Session::Add('user', $user);
                $this->redirect("../../index");
            } else {
                /**
                 * Password is incorrect
                 */
                self::$failMessage = "Wrong user or password";
                $this->redirect("../../login", 'message=invalid&_username=' . $username);
            }
        } else {
            /**
             * User not found
             */
            self::$failMessage = "Wrong user or password";
            $this->redirect("../../login", 'message=invalid&_username=' . $username);
        }
    }

    public static function getError() {
        return self::$failMessage;
    }

}

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $login = new LoginController();

    if (method_exists($login, $fnc)) {
        $login->$fnc($_POST);
    }
}