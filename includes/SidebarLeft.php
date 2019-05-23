<div class="card" style="top: 20; margin-bottom: 8px;">
    <div class="card-header">
        <h1 class="logo text-center mb-0">
            <a href="index.php">
                timeline
            </a>
        </h1>
    </div>
    <div class="card-body">
        <div class="profile-pic ml-auto mr-auto">
            <img src="<?= Session::Get('user')->getImage() ? Session::Get('user')->getImage() : 'uploads/avatar.png' ?>" alt="<?= Session::Get('user')->getName() ?>">
        </div>
        <br>
        <h3 class="text-center"><?= Session::Get('user')->getName() ?></h3>
        <small class="text-muted d-block text-center"><?= Session::Get('user')->getBio() ?></small>
        <div class="text-center">
            <br>
            <span>
                <a title="Edit profile" class="btn" href="#" data-toggle="modal" data-target=".profileModal"><i class="fas fa-cog"></i></a>
                <a title="Logout" class="btn text-danger" href="<?= Timeline::goToFunction('login', 'logout') ?>"><i class="fas fa-power-off"></i></a>
            </span>
        </div>
    </div>
</div>
<br>
<div class="card text-left">
    <div class="card-header">
        Search users
    </div>
    <div class="card-body">
        <form class="mb-0" id="searchForm" method="get">
            <div class="mb-0 form-group">
                <input type="text" name="q" class="form-control" />
            </div>
        </form>
    </div>
</div>
<br><br>
<div class="text-center">
    <a id="gh" href="https://github.com/urankajtazaj/Timeline" title="Timeline on Github" target="_blank"><img src="assets/icons/github.svg" width="25" alt=""></a>
</div>
