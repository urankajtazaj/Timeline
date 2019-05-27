<div class="modal fade postModal" tabindex="-1" role="dialog" aria-labelledby="postDialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close d-block d-md-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-flex align-items-center">
                    <div class="profile-pic small d-inline-flex">
                        <img id="pic" src="" alt="">
                    </div>
                    <span class="d-block full-width ml-3">
                        <b class="mr-1" id="user"></b> <small id="username" class="text-muted"></small>
                        -
                        <small class="ml-1 text-muted" id="time"></small>
                    </span>
                </div>
                <div class="post-content">
                    <p class="lead"></p>
                    <img src="" class="d-none" />
                    <br><br>
                    <div class="post-footer text-right text-muted">
                        <span class=""><i class="far fa-comment"></i><span class="btn-sm comment-count">0</span></span>
                        <span class="btn btn-like ml-4"><i class="far fa-heart"></i><span class="btn-sm like-count count">0</span></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex-column pl-0 pr-0" style="align-items: unset">
                <form action="" id="comment_form" class="full-width pl-3 pr-3">
                    <div class="d-flex align-items-center">
                        <div class="profile-pic small d-inline-flex">
                            <img src="<?= Session::Get('user')->getImage() ?>">
                        </div>
                        <input type="hidden" name="user" id="user_id" value="<?= Session::Get('user')->getId() ?>">
                        <input type="hidden" name="post" id="post_id" value="">
                        <input required type="text" id="comment_new" name="comment_new" class="form-control ml-3 mr-3" placeholder="Say something nice">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </form>
                <div id="replies">

                </div>
            </div>
        </div>
    </div>
</div>