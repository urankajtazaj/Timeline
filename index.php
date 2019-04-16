<?php
include 'includes/header.php';
?>

<br>

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body p-0">
                    <form method="post" action="<?= Timeline::goToFunction('post', 'createPost') ?>">
                        <div class="form-group">
                            <textarea required class="form-control full-width new-status" name="content" id="content" rows="2" placeholder="#Say something nice"></textarea>
                        </div>
                        <button type="submit" class="corner btn btn-primary btn-circle ml-auto"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            <br><br>
            <?php


            $posts = PostController::getPosts();

            foreach ($posts as $post) {
                ?>
                <div class="card post">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="profile-pic small d-inline-block">
                                <img src="<?= "uploads/" . $post->getUser()->getImage() ?>" alt="">
                            </div>
                            <span class="d-inline ml-3">
                                <b><?= $post->getUser()->getName() ?></b>
                            </span>
                        </div>
                        <br>
                        <p class="lead ml-3">
                            <?= $post->getContent() ?>
                        </p>
                    </div>
                    <div class="post-footer text-right text-muted">
                        <small class="float-left mt-2"><?= $post->getFormatedDate() ?></small>
                        <span onclick="handleLike(1, 1, 1)" class="btn btn-like"><i class="fas fa-heart"></i></span>
                        <span class="btn btn-sm">122</span>
                    </div>
                </div>
                <?php
            }

            ?>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="profile-pic ml-auto mr-auto">
                        <img src="<?= "uploads/" . Session::Get('user')->getImage() ?>" alt="">
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
