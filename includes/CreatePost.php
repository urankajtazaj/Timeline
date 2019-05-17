<div class="card">
    <div class="card-body p-0">
        <form method="post" id="post-new" enctype="multipart/form-data" action="<?= Timeline::goToFunction('post', 'createPost') ?>">
            <div class="form-group">
                <textarea class="form-control full-width new-status" name="content" id="content" rows="8" placeholder="#How is the day going?"></textarea>
            </div>
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="btn btn-image ml-3" title="Upload image">
                        <input accept=".png, .jpg, .jpeg, .jfif" type="file" name="image" id="image">
                        <input type="hidden" name="file_path" id="file_path">
                        <img src="assets/icons/placeholder.png" id="image_thumb" alt="">
                    </div>
                    <small class="reset-pic text-muted ml-3" id="reset_thumb">Reset image</small>
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-primary btn-circle float-right mr-3"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>