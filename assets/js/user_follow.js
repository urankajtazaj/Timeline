
function addFollowingEvents() {
    $(".btn-follow").each(function (i, el) {
        checkFollowerStatus($(el).data("id"), $(el));
    })
}


function handleFollow(id, btn) {
    $.ajax({
        method: "POST",
        url: "Src/Service/HandleFollow.php",
        data: {
            "userId": id
        },
        success: function (response) {
            btn.removeClass("btn-primary");
            btn.addClass("btn-danger");
            btn.text("Unfollow");
            addFollowingEvents();
        }
    })
}

function handleUnfollow(id, btn) {
    $.ajax({
        method: "POST",
        url: "Src/Service/HandleUnfollow.php",
        data: {
            "userId": id
        },
        success: function (response) {
            if (response) {
                btn.removeClass("btn-danger");
                btn.addClass("btn-primary");
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

            console.log(response);

            if (response == 1) {
                btn.removeClass("btn-primary");
                btn.addClass("btn-danger");
                btn.text("Unfollow");
            } else {
                btn.removeClass("btn-danger");
                btn.addClass("btn-primary");
                btn.text("Follow");
            }

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