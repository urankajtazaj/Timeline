<div class="card">
    <div class="card-body">
        <h1 class="logo text-center">
            <a href="index.php">
                timeline
            </a>
        </h1>
        <hr>
        <br>
        <div class="profile-pic ml-auto mr-auto">
            <img src="<?= Session::Get('user')->getImage() ? Session::Get('user')->getImage() : 'uploads/avatar.png' ?>" alt="<?= Session::Get('user')->getName() ?>">
        </div>
        <br>
        <h3 class="text-center"><?= Session::Get('user')->getName() ?></h3>
        <small class="text-muted d-block text-center"><?= Session::Get('user')->getBio() ?></small>
        <hr>
        <form id="searchForm" method="get">
            <div class="form-group">
                <input type="text" name="q" class="form-control" placeholder="Search for people" />
            </div>
        </form>
        <hr>
        <a class="btn btn-danger full-width" href="<?= Timeline::goToFunction('login', 'logout') ?>">Logout</a>
    </div>
</div>