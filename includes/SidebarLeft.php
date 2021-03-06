<div class="card" style="top: 20; margin-bottom: 8px;">
    <div class="card-header">
        <h1 class="logo text-center mb-0">
            <a href="index.php">
                Timeline
            </a>
        </h1>
    </div>
    <div class="card-body">
        <div class="profile-pic ml-auto mr-auto">
            <img src="<?= Session::Get('user')->getImage() ? $user->getImage() : 'uploads/avatar.png' ?>" alt="<?= $user->getName() ?>">
        </div>
        <br>
        <h3 class="text-center big-name"><?= $user->getName() ?></h3>
        <small class="text-muted d-block text-center"><?= $user->getBio() ?></small>
        <div class="text-center">
            <br>
            <span>
                <a title="Edit profile" class="btn p-2" href="#" data-toggle="modal" data-target=".profileModal"><i class="fas fa-cog"></i></a>
                <a title="Logout" class="btn text-danger p-2" href="<?= Timeline::goToFunction('login', 'logout') ?>"><i class="fas fa-power-off"></i></a>
            </span>
        </div>
    </div>
</div>
<br><br>
<div class="text-center">
    <a id="gh" href="https://github.com/urankajtazaj/Timeline" title="Timeline on Github" target="_blank"><img src="assets/icons/github.svg" width="25" alt=""></a>
</div>
