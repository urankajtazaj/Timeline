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
                            <img class="pic" src="<?= !empty($post->getUser()->getImage()) ? $post->getUser()->getImage() : 'uploads/avatar.png' ?>" alt="<?= $post->getUser()->getName() ?>">
                        </div>
                        <span class="d-block full-width ml-3">
                            <b class="mr-1 user"><?= $post->getUser()->getName() ?></b> <small id="uname" class="text-muted">@<?= $post->getUser()->getUsername() ?></small>
                            -
                            <small class="ml-1 text-muted time">
                                <?php if ($post->getUser()->getId() != Session::Get('user')->getId()) { ?>
                                    <span class="btn btn-sm btn-danger btn-follow float-right" style="cursor: pointer" data-id="<?= $post->getUser()->getId() ?>">Unfollow</span>
                                <?php } ?>
                                <?= $post->getFormatedDate() ?><br>
                                <?php if (!empty($post->getUser()->getBio())) { ?>
                                    <span class="d-inline-block pb-2"><?= $post->getUser()->getBio() ?></span>
                                <?php } ?>
                            </small>
                        </span>
                    </div>
                    <div class="post-content" data-toggle="modal" data-target=".postModal">
                        <?= Timeline::validateUrl($post->getContent()) ?>
                        <?php if ($post->getImage()) { ?>
                            <img src="<?= $post->getImage() ?>" alt="">
                        <?php } ?>
                        <input type="hidden" name="post_id" id="post_id" value="<?= $post->getId() ?>" >
                    </div>
                </div>
                <div class="post-footer text-right text-muted">
                    <span class="=" id="comment-count-<?= $post->getId() ?>"><i class="far fa-comment"></i><span class="btn-sm comment-count"><?= $post->getReplyCount() ?></span></span>
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
