function activateModal() {
    var post = $(".card.post");
    var modal = $(".postModal");
    var user = modal.find("#user");
    var time = modal.find("#time");
    var pic = modal.find("#pic");
    var image = modal.find(".post-content > img");
    var content = modal.find(".post-content > p");
    var likeCount = modal.find(".post-content .like-count");
    var commentCount = modal.find(".post-content .comment-count");
    var likeBtn = modal.find(".post-content .btn-like");

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

            if (el.find(".btn-like").hasClass("liked")) {
                likeBtn.addClass("liked");
            } else {
                likeBtn.removeClass("liked");
            }

        })
    });
}

activateModal();