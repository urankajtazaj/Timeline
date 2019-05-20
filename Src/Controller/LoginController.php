<?php
/**
 * Created by PhpStorm.
 * User: u.kajtazaj
 * Date: 3/25/2019
 * Time: 8:56 AM
 */

//require '../Timeline.php';
//require '../Controller/UserController.php';
//require '../Service/Sessions.php';
//require '../../includes/Database.php';

include $_SERVER['DOCUMENT_ROOT'] . '/Timeline/Autoload.php';

class LoginController extends Timeline
{
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
                 * User logged in
                 */
                Session::Add('user', $user);
                $this::redirect("index");
            } else {
                /**
                 * Password is incorrect
                 */
                $this::redirect("login", 'message=invalid&_username=' . $username);
            }
        } else {
            /**
             * User not found
             */
            $this::redirect("login", 'message=invalid&_username=' . $username);
        }
    }

    public function logout() {
        $_SESSION['user'] = null;
        session_unset($_SESSION['user']);
        session_destroy($_SESSION['user']);

        self::redirect("login");
    }
}

if (isset($_GET['action'])) {
    $fnc = $_GET['action'];
    $login = new LoginController();

    if (method_exists($login, $fnc)) {
        $login->$fnc($_POST);
    }
}