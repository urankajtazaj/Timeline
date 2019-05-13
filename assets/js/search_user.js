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
                '<div class="card-body"><h4>' + users.length + ' search results for "' + query + '"</h4></div>' +
                '</div>');

            for (index in users) {
                let user = users[index];
                let card =
                '<div class="card">' +
                '   <div class="card-body">' +
                '       <div class="d-flex align-items-center">' +
                '           <div class="profile-pic small d-inline-flex">' +
                '               <img class="pic" src="' + user.image + '" alt="' + user.name + '">' +
                '           </div>' +
                '           <span class="d-inline ml-3">' +
                '               <b class="mr-1 user">' + user.name + '</b>' +
                '           </span>' +
                '           <a href="#" class="btn btn-primary ml-auto">Follow</a>' +
                '       </div>' +
                '   </div>' +
                '</div>';

                center.append(card);
            }
        },
        error: function (a, b, c) {
            console.log(a);
            console.log(b);
            console.log(c);
        }
    })

    return false;
})

function handleSearch() {

    console.log($(this).find("input"));


}