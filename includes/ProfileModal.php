<div class="modal fade profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit profile</h4>
            </div>
            <form enctype="multipart/form-data" method="post" id="profileForm" action="<?= Timeline::controllerPath("user") . "?action=updateUser" ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Change image</label>
                        <input type="file" class="form-control" name="image_profile" id="image_profile" />
                        <input type="hidden" name="file_path" id="file_path" value="<?= Session::Get('user')->getImage() ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input required type="text" name="name" id="name" class="form-control" value="<?= Session::Get('user')->getName() ?>">
                    </div>
                    <div class="form-group">
                        <label for="bio">Position <small class="text-muted">(Optional)</small></label>
                        <input type="text" name="bio" id="bio" class="form-control" value="<?= Session::Get('user')->getBio() ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <br>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>