<div id="post-list">
    <?php if (!empty($post_title)) { ?>
        <div class="card post">
            <div class="card-body">
                <?= $post_title ?>
            </div>
        </div>
    <?php
    }
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
                            <a class="text-dark" href="index.php?user=<?= $post->getUser()->getUsername() ?>">
                                <b class="mr-1 user"><?= $post->getUser()->getName() ?></b>
                            </a>
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
                    <a href="index.php?post=<?= $post->getId() ?>">
                        <div class="post-content">
                            <?= Timeline::validateUrl($post->getContent()) ?>
                            <?php if ($post->getImage()) { ?>
                                <img src="<?= $post->getImage() ?>" alt="">
                            <?php } ?>
                            <input type="hidden" name="post_id" id="post_id" value="<?= $post->getId() ?>" >
                        </div>
                    </a>
                </div>
                <div class="post-footer text-right text-muted">
                    <?php
                        $likeCount = $post->getLikeCount();
                        ?>
                    <span id="comment-count-<?= $post->getId() ?>"><i class="far fa-comment"></i>
                        <span class="btn-sm comment-count"><?= $post->getReplyCount() ?></span>
                    </span>
                    <span onclick="handleLike(<?= $post->getId() ?>, this)" class="btn-like <?= $post->isLiked() ? "liked" : "" ?> ml-4"><i class="far fa-heart"></i><span class="btn-sm count"><?= $likeCount ?></span></span>
                </div>
            </div>
            <?php
        }
    } else { ?>
        <div class="card" id="no-posts">
            <div class="card-body text-center">
                <p class="lead pt-3">Wow, such clean</p>
            </div>
        </div>
    <?php } ?>
</div>
