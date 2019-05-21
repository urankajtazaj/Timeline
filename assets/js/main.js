var image_input = $("input#image");
var file_path = $("input#file_path");
var image_thumb = $("img#image_thumb");
var reset_thumb = $("#reset_thumb");

image_input.on("change", function(e) {
    handleUpload();
})

reset_thumb.on("click", function () {
    resetThumbnail();
})

function resetThumbnail() {
    image_input.val('');
    image_thumb.attr('src', 'assets/icons/placeholder.png');
    image_thumb.attr('alt', '');
    file_path.val('');
}

function handleUpload() {
    let file_data = image_input.prop('files')[0];
    let form_data = new FormData();
    form_data.append('file', file_data);

    $.ajax({
        url: 'Src/Service/UploadFile.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response){
            let respArr = response.split("/");
            let name = respArr[respArr.length - 1];

            file_path.val(response);
            image_thumb.attr("alt", name);
            image_thumb.attr("src", response);
            console.log(response);
        }
    });
}
