<div class="card">
    <div class="card-header">
        Snapshot
    </div>
    <div class="card-body">
        <?php
        $posts = UserController::getPosts(Session::Get('user')->getId());
        $following = UserController::getFollowing(Session::Get('user')->getId());
        $followers = UserController::getFollowers(Session::Get('user')->getId());
        ?>
        <p class="lead"><?= sizeof($posts) ?> Posts</p>
        <p class="lead"><?= $following ?> Following</p>
        <p class="lead"><?= $followers ?> Followers</p>
    </div>
</div>