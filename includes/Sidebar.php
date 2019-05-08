<div class="card">
    <div class="card-body">
        <div class="profile-pic ml-auto mr-auto">
            <img src="<?= "uploads/" . Session::Get('user')->getImage() ?>" alt="<?= Session::Get('user')->getName() ?>">
        </div>
        <br>
        <h3 class="text-center"><?= Session::Get('user')->getName() ?></h3>
        <hr>
        <form action="">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Search for people" />
            </div>
        </form>
        <hr>
        <a class="btn btn-danger full-width" href="<?= Timeline::goToFunction('login', 'logout') ?>">Logout</a>
    </div>
</div>