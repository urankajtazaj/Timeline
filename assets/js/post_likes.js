function handleLike(post_id, user_id, status, link) {
    $.ajax({
        url: link,
        method: "GET",
        data: {
            "post_id": post_id,
            "user_id": user_id,
            "status": status
        },
        success: function (response) {
            alert(response);
        },
        error: function (a, b, c) {
            console.log(a);
            console.log(b);
            console.log(c);
        }
    })
}