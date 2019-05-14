var container = $("#post-list");
var form = $("#post-new");

form.on("submit", function (e) {
    e.preventDefault();

    let content = $("textarea#content");
    let image = $("input#file_path");

    $.ajax({
        method: "POST",
        url: "Src/Service/HandlePostCreate.php",
        data: {
            "content": content.val(),
            "file_path": image.val()
        },
        success: function (response) {
            content.val('');
            image.val('');
            resetThumbnail();
            prependPost(JSON.parse(response));
        }
    });

})


function prependPost(post) {
    let card =
    `<div class="card post">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="profile-pic small d-inline-flex">
                    <img class="pic" src="${post.user.image}" alt="${post.user.name}">
                </div>
                <span class="d-block full-width ml-3">
<!--                    <span class="btn btn-sm btn-danger btn-follow float-right" style="cursor: pointer" data-id="${post.user.id}">Unfollow</span>-->
                    <b class="mr-1 user">${post.user.name}</b>
                    -
                    <small class="ml-1 text-muted time">
                        ${post.formatedDate} <br>
                        <span class="d-inline-block ${post.user.bio != '' ? 'pb-2' : ''}">${post.user.bio}</span>
                    </small>
                </span>
            </div>
            <div class="post-content" data-toggle="modal" data-target=".postModal">
                <p>
                    ${post.content}
                </p>
                <img src="${post.image}" alt="">
                <input type="hidden" name="post_id" id="post_id" value="${post.id}" >
            </div>
        </div>
        <div class="post-footer text-right text-muted">
            <span><i class="far fa-comment"></i><span class="btn-sm comment-count">0</span></span>
            <span onclick="handleLike(${post.id}, this)" class="btn btn-like ${post.isLiked ? 'liked' : ''} ml-4"><i class="far fa-heart"></i><span class="btn-sm count">${post.likeCount}</span></span>
        </div>
    </div>`;

    container.prepend(card);
    activateModal();
}