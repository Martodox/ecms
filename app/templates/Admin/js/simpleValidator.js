//     simpleValidator.js 1.0


$.fn.simpleValidator = function(data) {

    var settings = $.extend({
        all: false,
        valid: true,
    }, data);
    function email(val) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(val);
    }

    function id(val) {
        var expr = /^\d+$/;
        return expr.test(val);
    }


    function phone(obj) {
        var val = $(obj).val();
        var valid = range($(obj).attr('data-validate-range'), val);
        if (valid) {
            var expr = /^(#?\d{9})|(#?\d{4}(\s|-)\d{4}(\s|-)\d{3})|(\d{4}(\s|-)\d{5})$/;
            valid = expr.test(val);
        }
        return valid;
    }


    function postcode(obj) {
        var val = $(obj).val();
        var valid = range($(obj).attr('data-validate-range'), val);
        if (valid) {
            var expr = /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/;
            valid = expr.test(val);
        }
        return valid;
    }

    function numeric(obj) {

        var val = $(obj).val();
        var valid = range($(obj).attr('data-validate-range'), val);

        if (valid) {
            var expr = /^\d+$/;
            valid = expr.test(val);
        }

        return valid;
    }

    function noEmpty(obj) {

        var val = $(obj).val();
        var valid = range($(obj).attr('data-validate-range'), val);

        if (valid) {
            if (val) {
                return true;
            }
        }
        return false;
    }

    function range(range, val) {
        if (range) {
            range = range.split('|');
            if (val.length >= range[0] && val.length < range[1]) {
                return true
            }
            return false;
        }

        return true;
    }




    function clientEmail(val, cb) {
        var valid = true;
        valid = email(val);

        if (!valid) {
            cb(false);
            return false;
        }
        var token = $('#csrftoken').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: rootpatch + 'admin/edytuj-konto/sprawdz-adres-w-bazie',
            data: {email: val, csrftoken: token},
            success: function(response) {

                if (response.result == 'ok')
                    valid = true;
                else {
                    valid = false;
                }
                $('#csrftoken').val(response.token);
                cb(valid);
            }
        });
    }

    function EmailAjax(val, prev) {
        if (prev) {
            if (val === prev) {
                return true;
            }
        }
        var valid = false;
        clientEmail(val, function(res) {
            valid = res;
        });
        return valid;
    }


    function matchCheck(obj, match) {
        var value = $(obj).val();
        var matchObj = $('#' + match);
        var matchrange = range(matchObj.attr('data-validate-range'), matchObj.val());
        var valrange = range($(obj).attr('data-validate-range'), value);
        var error = false;

        if (!matchrange || !valrange) {
            error = true;
        }

        if (matchObj.val() !== value) {
            error = true;
        }

        if (!matchObj.val()) {
            error = true;
        }

        if (!value) {
            error = true;
        }

        if (error) {
            $(obj).removeClass('correct');
            $(obj).addClass('error');
            $(matchObj).removeClass('correct');
            $(matchObj).addClass('error');
            settings.valid = false;
        } else {
            $(matchObj).removeClass('error');
            $(matchObj).addClass('correct');
        }

    }



    function validateField() {


        var type = $(this).attr('data-validate');
        var value = $(this).val();
        var valid = true;
        switch (type) {
            case 'id':
                valid = id(value);
                break;
            case 'email':
                valid = email(value);
                break;
            case 'email-ajax':
                var prev = $(this).attr('data-validate-value');
                valid = EmailAjax(value, prev);
                break;
            case 'false':
                valid = true;
                break;
            case 'post-code':
                valid = postcode(this);
                break;
            case 'phone':
                valid = phone(this);
                break;
            case 'numeric':
                valid = numeric(this);
                break;
            default:
                valid = noEmpty(this);
        }

        var match = $(this).attr('data-validate-match');
        if (!valid) {
            $(this).removeClass('correct');
            $(this).addClass('error');
            var alert = $(this).attr('data-validate-alert');
            var label = $('label[for=' + $(this).attr('id') + ']').text();
            if (alert !== 'false' && !settings.all) {
                //alertify.log("Something is wrong with <b>" + label + "</b> field. Please correct it.", "error", 5000);
            }
            if (match) {
                matchCheck(this, match);
            }

            settings.valid = false;
        } else {

            if (match) {
                matchCheck(this, match);
            }
            $(this).removeClass('error');
            $(this).addClass('correct');
        }

    }




    if (settings.all) {
        $(this).find('input').removeClass('error');
        $(this).find('input').removeClass('correct');
        $(this).find('input').each(validateField);

    } else {
        $(this).find('input').on("blur", validateField);
    }
    return settings;
}