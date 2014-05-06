function formSubmit(button) {


    var valid = $('#userData').simpleValidator({
        all: true
    });
    valid = valid.valid;

    if (!valid) {
        return;
    }

    var button = $(button);
    var patch = button.attr('data-id');
    var input = $('.form-modal').find('input');
    var select = $('.form-modal').find('select');



    var array = [];

    input.each(function(index) {
        var obj = new Object();
        obj[$(this).attr('name')] = $(this).val();
        array.push(obj);

    });


    select.each(function(index) {
        var obj = new Object();
        obj[$(this).attr('name')] = $(this).val();
        array.push(obj);

    });
    array = JSON.stringify(array);
    $.ajax({
        type: "POST",
        data: "data=" + array,
        url: patch,
        contentType: "application/x-www-form-urlencoded;charset=UTF-8",
        beforeSend: function(a) {
            button.addClass('disabled');
        },
        success: function(msg) {
            console.log(msg);
            msg = JSON.parse(msg);

            button.removeClass('disabled');
            if (msg.error) {
                $("#notify-here").notify("Błąd, spróbuj jeszcze raz.");

            } else {
                $("#notify-here").notify("Sukces", "success");
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }

            button.removeClass('disabled');
            $('#csrftoken').val(msg.token);
        }

    });




}


function delPicture(button) {

    var button = $(button);
    var patch = button.attr('data-id');

    var array = [];
    var input = $('.form-modal').find('input');
    input.each(function(index) {
        var obj = new Object();
        obj[$(this).attr('name')] = $(this).val();
        array.push(obj);

    });
    array = JSON.stringify(array);

    $.ajax({
        type: "POST",
        data: "data=" + array,
        url: patch,
        contentType: "application/x-www-form-urlencoded;charset=UTF-8",
        beforeSend: function(a) {
            button.addClass('disabled');
        },
        success: function(msg) {
            msg = JSON.parse(msg);

            $("#picture-" + msg.pictureid).remove();
            $("#myModal").modal('hide');

            button.removeClass('disabled');
            $('#csrftoken').val(msg.token);
        }

    });


}
