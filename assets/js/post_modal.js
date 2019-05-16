function activateModal() {
    var post = $(".card.post");
    var modal = $(".postModal");
    var replies = modal.find("#replies");
    var user = modal.find("#user");
    var time = modal.find("#time");
    var pic = modal.find("#pic");
    var image = modal.find(".post-content > img");
    var content = modal.find(".post-content > p");
    var likeCount = modal.find(".post-content .like-count");
    var commentCount = modal.find(".post-content .comment-count");
    var likeBtn = modal.find(".post-content .btn-like");
    var postId = modal.find("#post_id");
    var username = modal.find("#username");

    post.each(function (i, el) {
        el = $(el);

        el.find(".card-body").on("click", function () {
            image.attr('src', '');
            content.html(el.find("p").html());
            user.text(el.find(".user").text());
            time.html(el.find(".time").html());
            likeCount.text(el.find(".count").text());
            commentCount.text(el.find(".comment-count").text());
            pic.attr('src', el.find(".pic").attr('src'));
            image.attr('src', $(this).find(".post-content img").attr('src'));
            postId.val(el.find("#post_id").val());
            username.text(el.find("#uname").text());
            getReplies(replies, postId.val());

            likeBtn.on("click", function (e) {
                handleLike(postId.val(), likeBtn);
            });

            addFollowingEvents();

            if (el.find(".btn-like").hasClass("liked")) {
                likeBtn.addClass("liked");
            } else {
                likeBtn.removeClass("liked");
            }

        })
    });
}

function getReplies(container, post_id) {
    container.html('');
    $.ajax({
        method: "POST",
        url: "Src/Service/GetReplies.php",
        data: {
            "post_id": post_id
        },
        success: function (response) {
            let comments = JSON.parse(response);

            for (let i = 0; i < comments.length; i++) {
                let comment = comments[i];

                container.append(
                    `<div class="card post pb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="profile-pic small d-inline-flex">
                                    <img class="pic" src="${comment.image}" alt="${comment.name}">
                                </div>
                                <span class="d-inline ml-3">
                                    <b class="mr-1 user">${comment.name}</b> - <small class="ml-1 text-muted" id="time">${comment.date}</small><br>
                                    <small class="${comment.bio != '' ? 'text-muted d-inline-block pb-2' : '' }">${comment.bio}</small>
                                </span>
                            </div>
                            <div class="post-content" data-toggle="modal" data-target=".postModal">
                                <p>
                                    ${comment.comment}
                                </p>
                            </div>
                        </div>
                    </div>`);
            }
        }
    })
}

activateModal();