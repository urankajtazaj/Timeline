<br>
<div class="card position-sticky" style="z-index: 100; width: 100%">
    <div class="card-body">
        <h5 class="mb-0 pb-0"><b>All Posts</b></h5>
    </div>
</div>
<div id="post-list">
    <?php
    if (sizeof($posts) > 0) {
        foreach ($posts as $post) {
            ?>
            <div class="card post">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic small d-inline-flex">
                            <?php if ($post->getUser()->getImage()) { ?>
                                <img class="pic" src="<?= $post->getUser()->getImage() ?>" alt="<?= $post->getUser()->getName() ?>">
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
    } else { ?>
        <div class="card">
            <div class="card-body">
                <p class="lead text-center">No posts in your feed<br><small class="text-muted">Start by following someone</small></p>
            </div>
        </div>
    <?php } ?>
</div>
