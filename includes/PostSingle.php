<div id="post-list">
    <div class="card post">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="profile-pic small d-inline-flex">
                    <img class="pic"
                         src="<?= !empty($post->getUser()->getImage()) ? $post->getUser()->getImage() : 'uploads/avatar.png' ?>"
                         alt="<?= $post->getUser()->getName() ?>">
                </div>
                <span class="d-block full-width ml-3">
                            <a class="text-dark" href="index.php?user=<?= $post->getUser()->getUsername() ?>">
                                <b class="mr-1 user"><?= $post->getUser()->getName() ?></b>
                            </a>
                            -
                            <small class="ml-1 text-muted time">
                                <?php if ($post->getUser()->getId() != Session::Get('user')->getId()) { ?>
                                    <span class="btn btn-sm btn-danger btn-follow float-right" style="cursor: pointer"
                                          data-id="<?= $post->getUser()->getId() ?>">Unfollow</span>
                                <?php } ?>
                                <?= $post->getFormatedDate() ?><br>
                                <?php if (!empty($post->getUser()->getBio())) { ?>
                                    <span class="d-inline-block pb-2"><?= $post->getUser()->getBio() ?></span>
                                <?php } ?>
                            </small>
                        </span>
            </div>
            <div class="post-content">
                <?= Timeline::validateUrl($post->getContent()) ?>
                <?php if ($post->getImage()) { ?>
                    <img src="<?= $post->getImage() ?>" alt="">
                <?php } ?>
                <input type="hidden" name="post_id" id="post_id" value="<?= $post->getId() ?>">
            </div>
        </div>
        <div class="post-footer text-right text-muted">
            <?php
            $likeCount = $post->getLikeCount();
            ?>
            <span id="comment-count-<?= $post->getId() ?>"><i class="far fa-comment"></i>
                        <span class="btn-sm comment-count"><?= $post->getReplyCount() ?></span>
                    </span>
            <span onclick="handleLike(<?= $post->getId() ?>, this)"
                  class="btn-like <?= $post->isLiked() ? "liked" : "" ?> ml-4"><i class="far fa-heart"></i><span
                        class="btn-sm count"><?= $likeCount ?></span></span>
        </div>
        <br>
        <form action="" id="comment_form" class="full-width pl-3 pr-3">
            <div class="d-flex align-items-center">
                <div class="profile-pic small d-inline-flex">
                    <img src="<?= Session::Get('user')->getImage() ?>">
                </div>
                <input type="hidden" name="user" id="user_id" value="<?= Session::Get('user')->getId() ?>">
                <input type="hidden" name="post" id="post_id" value="">
                <input required type="text" id="comment_new" name="comment_new" class="form-control ml-3 mr-3"
                       placeholder="Say something nice">
                <button type="submit" class="btn btn-primary">Reply</button>
            </div>
        </form>
        <div id="replies">
            <?php foreach ($replies as $reply) { ?>
                <div class="card condensed pb-0">
                    <div class="card-body pb-2 pt-2">
                        <div class="d-flex align-items-center">
                            <div class="profile-pic small d-inline-flex">
                                <img class="pic" src="<?= $reply['image'] ?>" alt="<?= $reply['name'] ?>">
                            </div>
                            <span class="d-inline ml-3">
                                    <b style="<?= $reply['myReply'] ? 'color: rgb(29, 161, 242)' : '' ?>"
                                       class="mr-1 user"><?= $reply['name'] ?></b> - <small class="ml-1 text-muted"
                                                                                          id="time"><?= $reply['date'] ?></small><br>
                                    <small class="<?= $reply['bio'] != '' ? 'text-muted d-inline-block pb-2' : '' ?>"><?= $reply['bio'] ?></small>
                                </span>
                        </div>
                        <div class="post-content" data-toggle="modal" data-target=".postModal">
                            <p>
                                <?= $reply['comment'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
