$(document).ready(function() {


    $(document).on('click', '.changeorder', function(e) {
        e.preventDefault();
        var btn = $(this);
        var link = btn.attr('href');
        var row = $(this).parents("tr:first");

        if (btn.hasClass('categoryDown')) {
            row.insertAfter(row.next());
            if (!row.next().is('tr')) {
                var btns = row.find('.order-change').html();
                var newbtns = row.prev().find('.order-change').html();
                row.find('.order-change').html(newbtns);
                row.prev().find('.order-change').html(btns);

            }
        } else {
            row.insertBefore(row.prev());
            if (!row.prev().is('tr')) {
                var btns = row.find('.order-change').html();
                var newbtns = row.next().find('.order-change').html();
                row.find('.order-change').html(newbtns);
                row.next().find('.order-change').html(btns);
            }
        }



    })

    $('.changeVisibility').on('click', function(e) {
        e.preventDefault();
        var btn = $(this);
        var link = btn.attr('href');

        var row = btn.closest('tr').remove();

        $.ajax({
            type: "POST",
            url: link,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            success: function(msg) {
                msg = JSON.parse(msg);
                var span = btn.parent();
                span = $(span);
                console.log(span);
                if (msg.status == 1) {
                    span.removeClass("label-danger").addClass("label-success");
                } else {
                    span.removeClass("label-success").addClass("label-danger");
                }
                span.attr("data-original-title", msg.tooltip);
                btn.html(msg.button);
                $('.csrftoken').val(msg.token);
            }

        });
    })




})