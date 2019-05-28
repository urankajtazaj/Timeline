
function addFollowingEvents() {
    $(".btn-follow").each(function (i, el) {
        checkFollowerStatus($(el).data("id"), $(el));
    })
}


function handleFollow(id, btn) {

    btn.text("Following...");
    btn.prop("disabled", true);

    $.ajax({
        method: "POST",
        url: "Src/Service/HandleFollow.php",
        data: {
            "userId": id
        },
        success: function (response) {
            console.log(response);
            if (btn.hasClass("btn")) {
                btn.removeClass("btn-primary");
                btn.addClass("btn-danger");
                btn.prop("disabled", false);
            }
            btn.text("Unfollow");
            addFollowingEvents();
        }
    })
}

function handleUnfollow(id, btn) {

    btn.text("Unfollowing...");
    btn.prop("disabled", true);

    $.ajax({
        method: "POST",
        url: "Src/Service/HandleUnfollow.php",
        data: {
            "userId": id
        },
        success: function (response) {
            if (response) {
                if (btn.hasClass("btn")) {
                    btn.removeClass("btn-danger");
                    btn.addClass("btn-primary");
                    btn.prop("disabled", false);
                }
                btn.text("Follow");
                addFollowingEvents();
            }
        }
    })
}

function checkFollowerStatus(id, btn) {
    $.ajax({
        method: "POST",
        url: "Src/Service/HandleFollowStatus.php",
        data: {
            "userId": id
        },
        success: function (response) {
            if (response == 1) {
                if (btn.hasClass("btn")) {
                    btn.removeClass("btn-primary");
                    btn.addClass("btn-danger");
                }
                btn.text("Unfollow");
            } else {
                if (btn.hasClass("btn")) {
                    btn.removeClass("btn-danger");
                    btn.addClass("btn-primary");
                }
                btn.text("Follow");
            }

            btn.unbind("click");

            btn.on("click", function (e) {
                if (response == 1) {
                    handleUnfollow(id, btn);
                } else {
                    handleFollow(id, btn);
                }
            })
        }
    })
}

addFollowingEvents();
