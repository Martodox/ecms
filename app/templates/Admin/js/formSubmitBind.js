


$.fn.bindSubmit = function() {

    $(this).on("click", function() {
        formSubmit(this);
    })
}

$.fn.delPictureBind = function() {

    $(this).on("click", function() {
        delPicture(this);
    })
}