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
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="<?= Timeline::controllerPath("user") . "?action=createUser" ?>">
                        <div class="form-group">
                            <label for="username" class="text-muted">Username</label>
                            <input type="text" required value="<?= isset($_GET['_username']) ? $_GET['_username'] : '' ?>" name="_username" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-muted">Password</label>
                            <input type="password" required name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="name" class="text-muted">Full name</label>
                            <input type="text" value="<?= isset($_GET['_name']) ? $_GET['_name'] : '' ?>" required name="_name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-muted">Email</label>
                            <input type="email" value="<?= isset($_GET['_email']) ? $_GET['_email'] : '' ?>" required name="_email" class="form-control" id="email">
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="form-group">
                            <label for="bio" class="text-muted">Short Description <small>(Optional)</small></label>
                            <input type="text" value="<?= isset($_GET['_bio']) ? $_GET['_bio'] : '' ?>" class="form-control" name="_bio" id="bio" />
                        </div>
                        <div class="form-group">
                            <label for="image" class="text-muted">Profile pic <small>(Optional)</small></label>
                            <input type="file" accept=".png,.jpg,.jpeg" name="image" id="image">
                        </div>
                        <small class="d-block text-center">
                            <a href="login.php">Already have an account? Login now!</a>
                        </small>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary full-width">Register now</button>
                        </div>
                        <small class="text-danger text-center d-block">
                            <?php if (isset($_GET['message'])) {
                                echo $_GET['message'];
                            } ?>
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
