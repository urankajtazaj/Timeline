<?php
include_once 'includes/header.php';
$post_title = "";
$user = Session::Get('user');

if (isset($_GET['user'])) {
    $username = trim($_GET['user']);

    $user = UserController::getByUsername($username);
    $id = $user->getId();
    $name = $user->getName();
    $posts = UserController::getPosts($id);

    $post_title = "<h5 class='mb-0'>" . ucwords($name) . "'s activity</h5>";
} else {
    $posts = PostController::getPosts();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-3 col-12 pr-1 pl-1 mb-3 sidebar text-center">
            <div class="position-sticky" style="top: 0">
                <?php include 'includes/SidebarLeft.php' ?>
            </div>
        </div>
        <div class="col-md-6 col-12 pl-1 pr-1 position-relative" id="center" style="top: 20">
            <?php include 'includes/CreatePost.php'; ?>
            <?php include 'includes/MainContent.php'; ?>
        </div>
        <div class="col-md-3 col-12 pl-1 position-relative">
            <div class="position-sticky" style="top: 0">
                <?php include 'includes/SidebarRight.php'; ?>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php include 'includes/scripts.php' ?>
