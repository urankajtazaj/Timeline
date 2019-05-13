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

    post.each(function (i, el) {
        el = $(el);

        el.find(".card-body").on("click", function (e) {
            image.attr('src', '');
            content.text(el.find("p").text());
            user.text(el.find(".user").text());
            time.text(el.find(".time").text());
            likeCount.text(el.find(".count").text());
            commentCount.text(el.find(".comment-count").text());
            pic.attr('src', el.find(".pic").attr('src'));
            image.attr('src', $(this).find(".post-content img").attr('src'));
            postId.val(el.find("#post_id").val());
            getReplies(replies, postId.val());

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
            let comment = JSON.parse(response);

            for (let i = 0; i < comment.length; i++) {
                container.append(
                    `<div class="card post pb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="profile-pic small d-inline-flex">
                                    <img class="pic" src="${comment[i].image}" alt="${comment[i].name}">
                                </div>
                                <span class="d-inline ml-3">
                                    <b class="mr-1 user">${comment[i].name}</b>
                                </span>
                            </div>
                            <div class="post-content" data-toggle="modal" data-target=".postModal">
                                <p>
                                    ${comment[i].comment}
                                </p>
                            </div>
                        </div>
                    </div>`);
            }
        },
        error: function (a, b, c) {
            console.log(a, b, c)
        }
    })
}

activateModal();