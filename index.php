<?php include 'includes/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Index</h2>
            <hr>
            <pre>
                <?= var_dump(Session::Get('user')) ?>
            </pre>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>
