<?php
    include_once 'includes/header.php';

    $fb_login = new Facebook\Facebook([
        'app_id' => '2040535216240224', // Replace {app-id} with your app id
        'app_secret' => 'a859caed0cf83cc96ad880d0a8832668',
        'default_graph_version' => 'v3.2',
    ]);

    $helper = $fb_login->getRedirectLoginHelper();

    $permissions = ['public_profile']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('https://rabbit-llc.com/Timeline/fb-callback.php', $permissions);
?>

<div class="container">
    <br><br>
    <h1 class="logo text-center">Timeline</h1>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= Timeline::controllerPath("login") . "?action=login" ?>">
                        <div class="form-group">
                            <label for="username" class="text-muted">Username</label>
                            <input type="text" required value="<?= isset($_GET['_username']) ? $_GET['_username'] : '' ?>" name="username" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-muted">Password</label>
                            <input type="password" required name="password" class="form-control" id="password">
                        </div>
                        <small class="d-block text-center">
                            <a href="register.php">Don't have an account? Register now!</a>
                        </small>
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
                                </div>
                                <div class="col-6">
                                    <a href="<?= htmlspecialchars($loginUrl) ?>" class="btn btn-primary" style="width: 100%">
                                        <img src="assets/icons/facebook.svg" width="25" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="fb-root"></div>
                        <p class="text-danger text-center">
                            <?= isset($_GET['message']) ? 'Username or password is incorrect' : '' ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
