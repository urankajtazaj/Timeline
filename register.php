<?php
include 'includes/header.php';
?>

<div class="container">
    <br><br>
    <h1 class="logo text-center">Timeline</h1>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= Timeline::controllerPath("user") . "?action=createUser" ?>">
                        <div class="form-group">
                            <label for="username" class="text-muted">Username</label>
                            <input type="text" required value="<?= isset($_GET['_username']) ? $_GET['_username'] : '' ?>" name="username" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-muted">Password</label>
                            <input type="password" required name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="name" class="text-muted">Full name</label>
                            <input type="text" required name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="image" class="text-muted">Profile pic (Optional)</label>
                            <input type="file" accept=".png,.jpg,.jpeg" name="image" class="form-control" id="image">
                        </div>
                        <div class="form-group">
                            <label for="bio" class="text-muted">Bio (Optional)</label>
                            <textarea rows="4" class="form-control" name="bio" id="bio"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary full-width">Register now</button>
                        </div>
<!--                        <p class="text-danger text-center">-->
<!--                            --><?//= isset($_GET['message']) ? 'Username or password is incorrect' : '' ?>
<!--                        </p>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
