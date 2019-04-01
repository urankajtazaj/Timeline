<?php
include 'includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <br>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= Timeline::goToFunction('post', 'createPost') ?>">
                        <div class="form-group">
                            <textarea class="form-control full-width" name="content" id="content" cols="60" rows="5" placeholder="Say something nice"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Create post</button>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
            <?php


            $posts = PostController::getPosts();

            foreach ($posts as $post) {
//                echo $post->getContent();
                ?>
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted">
                            <?= $post->getUser()->getName() ?>
                        </p>
                        <p class="lead">
                            <?= $post->getContent() ?>
                        </p>
                        <small>
                            <?= $post->getDate() ?>
                        </small>
                    </div>
                </div> <br>
                <?php
            }

            ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
