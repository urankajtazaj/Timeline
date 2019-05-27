<?php

$imageUrl = Session::Get('user')->getImage();

if (substr($imageUrl, 0, 5) == "https") {
    $imageUrl = substr($imageUrl, 5, strlen($imageUrl));
}

?>

<div class="modal fade profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Edit profile
            </div>
            <form class="mb-0" enctype="multipart/form-data" method="post" id="profileForm" action="<?= Timeline::controllerPath("user") . "?action=updateUser" ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Change image</label>
                        <input type="file" class="form-control" name="image_profile" id="image_profile" />
                        <input type="hidden" name="file_path_profile" id="file_path_profile" value="<?= $imageUrl ?>">
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>