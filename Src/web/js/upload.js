$(document).ready(function () {
    "use strict";
    $(".upload-form").on('submit', (function (e) {
        e.preventDefault();
        let form = $(this);
        let err = form.parent().find('.err');
        let preview = form.find('.preview');
        let inputId = form.data('inputId');
        let input = $(inputId);
        $.ajax({
            url: "/card-pair/upload",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                //$("#preview").fadeOut();
                err.fadeOut();
            },
            success: function (data) {
                if (data == 'invalid') {
                    // invalid file format.
                    err.html("Invalid File !").fadeIn();
                } else {
                    let img = $('<img>');
                    let src = '/uploads/' + data;
                    img.attr('src', src);
                    preview.html(img).fadeIn();
                    input.val(data);
                    //$("#form")[0].reset();
                }
            },
            error: function (e) {
                err.html(e).fadeIn();
            }
        });
    }));
});