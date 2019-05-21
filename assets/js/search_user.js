var form = $("#searchForm");
var center = $("#center");

form.on("submit", function (e) {
    e.preventDefault();
    let query = $(this).find("input").val().trim();

    $.ajax({
        url: "Src/Service/HandleSearch.php",
        method: "GET",
        data: {
            "q": query
        },
        success: function (response) {
            center.html('');
            let users = JSON.parse(response);

            center.append(
                '<div class="card">' +
                '<div class="card-body"><h4 class="mb-0">' + users.length + ' search results for "' + query + '"</h4></div>' +
                '</div>');

            for (index in users) {
                let user = users[index];
                console.log(user);
                let card =
                `<div class="card post">
                   <div class="card-body">
                       <div class="d-flex align-items-center">
                           <div class="profile-pic small d-inline-flex">
                               <img class="pic" src="${user.image ? user.image : "uploads/avatar.png"}" alt="${user.name}">
                           </div>
                           <span class="d-inline ml-3">
                               <b class="mr-1 user">${user.name}</b> - <small class="text-muted pl-1">${user.followers} Follower${user.followers > 1 || user.followers == 0 ? 's' : ''}</small><br>
                               <small class="text-muted">${user.bio}</small>
                           </span>
                           <a href="#!" id="follow-btn-${user.id}" class="btn btn-primary ml-auto btn-follow" data-id="${user.id}">Follow</a>
                       </div>
                   </div>
                </div>`;

                center.append(card);
            }

            addFollowingEvents();

        }
    })

    return false;
})

function handleSearch() {

    console.log($(this).find("input"));


}
