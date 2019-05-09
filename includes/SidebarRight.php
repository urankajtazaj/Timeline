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
        } else { ?>
            <p class="lead list-group-item">You have made no posts</p>
        <?php } ?>
    </div>
</div>