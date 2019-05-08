<?php
include 'includes/header.php';
$posts = PostController::getPosts();

include 'includes/PostModal.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-3 col-12 pr-1 sidebar">
            <div class="position-sticky" style="top: 0">
                <?php include 'includes/Sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-6 col-12 pl-1 pr-1 position-relative">
            <div class="card">
                <div class="card-body p-0">
                    <form method="post" enctype="multipart/form-data" action="<?= Timeline::goToFunction('post', 'createPost') ?>">
                        <div class="form-group">
                            <textarea required class="form-control full-width new-status" name="content" id="content" rows="3" placeholder="#Say something nice"></textarea>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="btn btn-image ml-3" title="Upload image">
                                    <input accept=".png, .jpg, .jpeg" type="file" name="image" id="image">
                                    <input type="hidden" name="file_path" id="file_path">
                                    <img src="assets/icons/placeholder.png" id="image_thumb" alt="">
                                </div>
                                <small class="reset-pic text-muted ml-3" id="reset_thumb">Reset image</small>
                            </div>
                            <div class="col-6 text-right">
                                <button type="submit" class="btn btn-primary btn-circle float-right mr-3"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="card position-sticky" style="z-index: 100; width: 100%">
                <div class="card-body">
                    <h5 class="mb-0 pb-0"><b>All Posts</b></h5>
                </div>
            </div>
            <?php
            foreach ($posts as $post) {
                ?>
                <div class="card post">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic small d-inline-flex">
                            <?php if ($post->getUser()->getImage()) { ?>
                            <img class="pic" src="<?= "uploads/" . $post->getUser()->getImage() ?>" alt="<?= $post->getUser()->getName() ?>">
                            <?php } ?>
                        </div>
                        <span class="d-inline ml-3">
                            <b class="mr-1 user"><?= $post->getUser()->getName() ?></b>
                            -
                            <small class="ml-1 text-muted time">
                                <?= $post->getFormatedDate() ?>
                            </small>
                        </span>
                    </div>
                    <div class="post-content" data-toggle="modal" data-target=".postModal">
                        <p>
                            <?= $post->getContent() ?>
                        </p>
                        <?php if ($post->getImage()) { ?>
                            <img src="<?= $post->getImage() ?>" alt="">
                        <?php } ?>
                    </div>
                    </div>
                    <div class="post-footer text-right text-muted">
                        <span class="=" id="comment-count-<?= $post->getId() ?>"><i class="far fa-comment"></i><span class="btn-sm comment-count">2</span></span>
                        <span onclick="handleLike(<?= $post->getId() ?>, this)" class="btn btn-like <?= $post->isLiked() ? "liked" : "" ?> ml-4"><i class="far fa-heart"></i><span class="btn-sm count"><?= $post->getLikeCount() ?></span></span>
                    </div>
                </div>
                <?php
            }

            ?>
        </div>
        <div class="col-md-3 col-12 pl-1 position-relative">
            <div class="position-sticky" style="top: 0">
                <div class="card">
                    <div class="card-header">
                        My Latest Posts
                    </div>
                    <div class="list-group">
                        <?php
                            $posts = UserController::getPosts(Session::Get('user')->getId());
                            if (sizeof($posts) > 0) {
                                foreach ($posts as $post) { ?>
                                    <a href="#" class="list-group-item list-group-item-action"><?= $post->getContent() ?></a>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
