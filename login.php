<?php
    include 'includes/header.php';
?>

<div class="container">
    <br><br>
    <h1 class="logo text-center">Timeline</h1>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
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
                            <button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
                        </div>
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
