<?php
include 'includes/header.php';
$posts = PostController::getPosts();
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-3 sidebar">
            <?php include 'includes/Sidebar.php' ?>
        </div>
        <div class="col-5 pl-0">
            <div class="card">
                <div class="card-body p-0">
                    <form method="post" action="<?= Timeline::goToFunction('post', 'createPost') ?>">
                        <div class="form-group">
                            <textarea required class="form-control full-width new-status" name="content" id="content" rows="3" placeholder="#Say something nice"></textarea>
                        </div>
                        <div class="btn btn-image ml-3 mt-2" title="Upload image"><i class="far fa-image"></i></div>
                        <button type="submit" class="btn btn-primary btn-circle float-right mb-3 mr-3"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            <?php

            foreach ($posts as $post) {
                ?>
                <div class="card post">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic small d-inline-block">
                            <?php if ($post->getUser()->getImage()) { ?>
                            <img src="<?= "uploads/" . $post->getUser()->getImage() ?>" alt="">
                            <?php } ?>
                        </div>
                        <span class="d-inline ml-3">
                            <b class="mr-1"><?= $post->getUser()->getName() ?></b>
                            -
                            <small class="ml-1 text-muted">
                                <?= $post->getFormatedDate() ?>
                            </small>
                        </span>
                    </div>
                    <div class="post-content">
                        <p>
                            <?= $post->getContent() ?>
                        </p>
<!--                        <img src="uploads/profile2.jpg" alt="">-->
                    </div>
                    </div>
                    <div class="post-footer text-right text-muted">
                        <span class="=" id="comment-count-<?= $post->getId() ?>"><i class="far fa-comment"></i><span class="btn-sm">3</span></span>
                        <span onclick="handleLike(1, 1, 1, '<?= Timeline::goToFunction("Like", "handleLike") ?>')" class="btn btn-like ml-4"><i class="far fa-heart"></i><span class="btn-sm">122</span></span>

                    </div>
                </div>
                <?php
            }

            ?>
        </div>
        <div class="col-md-3 pl-0">
            <div class="card">
                <div class="card-body">
                    <div class="profile-pic ml-auto mr-auto">
                        <img src="<?= "uploads/" . Session::Get('user')->getImage() ?>" alt="<?= Session::Get('user')->getName() ?>">
                    </div>
                    <br>
                    <h3 class="text-center"><?= Session::Get('user')->getName() ?></h3>
                    <hr>
                    <br>
                    <?php
                        $myPosts = UserController::getPosts(Session::Get('user')->getId());

                        if (sizeof($myPosts) > 0) {
                            ?>
                            <p class="text-muted">My latest posts</p>
                            <?php
                            foreach ($posts as $post) {
                                ?>
                                <small class="d-block"><?= $post->getContent() ?></small>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
