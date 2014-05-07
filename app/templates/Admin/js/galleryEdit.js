$(document).ready(function() {


    $(document).on('click', '.changeorder', function(e) {
        e.preventDefault();
        var btn = $(this);

        var row = $(this).parents("tr:first");
        var id = btn.closest('td').attr('data-id');
        var link = rootpatch + "admin/admin-gallery/"
        if (btn.hasClass('categoryDown')) {
            row.insertAfter(row.next());
            link += "category-down/";
            var btns = row.find('.order-change').html();
            var newbtns = row.prev().find('.order-change').html();
            row.find('.order-change').html(newbtns);
            row.prev().find('.order-change').html(btns);


        } else {
            row.insertBefore(row.prev());
            link += "category-up/";
            var btns = row.find('.order-change').html();
            var newbtns = row.next().find('.order-change').html();
            row.find('.order-change').html(newbtns);
            row.next().find('.order-change').html(btns);

        }

        $.ajax({
            type: "POST",
            data: "data=" + JSON.stringify(id),
            url: link,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            success: function(msg) {
                msg = JSON.parse(msg);
                $('.csrftoken').val(msg.token);
            }

        });

    })

    $('.changeVisibility').on('click', function(e) {
        e.preventDefault();
        var btn = $(this);
        var link = btn.attr('href');



        $.ajax({
            type: "POST",
            url: link,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            success: function(msg) {
                msg = JSON.parse(msg);
                var span = btn.parent();
                span = $(span);

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