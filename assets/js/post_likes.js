function handleLike(post_id, btn) {
    $.ajax({
        url: "Src/Service/HandleLike.php",
        method: "GET",
        data: {
            "post_id": post_id
        },
        success: function (response) {
            if (response == 1) {
                $(btn).addClass("liked");
                $(btn).find(".count").text(parseInt($(btn).find(".count").text()) + 1);
            } else {
                $(btn).removeClass("liked");
                $(btn).find(".count").text(parseInt($(btn).find(".count").text()) - 1);
            }
        }
    })
}
