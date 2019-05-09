<?php
include 'includes/header.php';
$posts = PostController::getPosts();

include 'includes/PostModal.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-3 col-12 pr-1 sidebar">
            <div class="position-sticky" style="top: 0">
                <?php include 'includes/SidebarLeft.php' ?>
            </div>
        </div>
        <div class="col-md-6 col-12 pl-1 pr-1 position-relative" id="center">
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

<?php include 'includes/footer.php' ?>
