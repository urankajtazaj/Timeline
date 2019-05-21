<?php
$posts = UserController::getPosts(Session::Get('user')->getId());
$following = UserController::getFollowing(Session::Get('user')->getId());
$followers = UserController::getFollowers(Session::Get('user')->getId());
$popular = UserController::getPopular();
?>

<div class="card d-none d-md-block" style="top: 20; margin-bottom: 20px">
    <div class="card-header">
        Snapshot
    </div>
    <div class="card-body">
        <p class="lead"><?= sizeof($posts) ?> Posts</p>
        <p class="lead"><?= $following ?> Following</p>
        <p class="lead"><?= $followers ?> Followers</p>
    </div>
</div>
<br>
<div class="card d-none d-md-block">
    <div class="card-header">
        Popular users
    </div>
    <div class="card-body">
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