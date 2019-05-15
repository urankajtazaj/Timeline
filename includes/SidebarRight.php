<div class="card">
    <div class="card-header">
        Snapshot
    </div>
    <div class="card-body">
        <?php
        $posts = UserController::getPosts(Session::Get('user')->getId());
        $following = UserController::getFollowing(Session::Get('user')->getId());
        $followers = UserController::getFollowers(Session::Get('user')->getId());
        $popular = UserController::getPopular();
        ?>
        <p class="lead"><?= sizeof($posts) ?> Posts</p>
        <p class="lead"><?= $following ?> Following</p>
        <p class="lead"><?= $followers ?> Followers</p>
        <hr>
        <h5>Popular users</h5><br>
        <?php
            foreach ($popular as $user) {
                ?>
                <div class="d-flex align-items-start justify-content-between">
                    <p class="mb-0"><?= $user->getName() ?><br><small class="text-muted"><?= $user->getFollowers() ?> Follower<?= $user->getFollowers() > 1 || $user->getFollowers() == 0 ? 's' : '' ?></small></p>
                    <a href="#!" class="btn btn-sm btn-follow" style="margin-right: -15px;" data-id="<?= $user->getId() ?>"></a>
                </div>
                <br>
                <?php
            }
        ?>
    </div>
</div>