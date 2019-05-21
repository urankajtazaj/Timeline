var form = $("#comment_form");
var input = $("#comment_new");

form.on("submit", function (e) {
    e.preventDefault();

    let userId = form.find("#user_id");
    let postId = form.find("#post_id");

    $.ajax({
        method: "POST",
        url: "Src/Service/HandleCommentCreate.php",
        data: {
            "userId": userId.val(),
            "postId": postId.val(),
            "comment": input.val()
        },
        success: function (response) {
            input.val('');
            getReplies($("#replies"), postId.val());
        }
    });
})
