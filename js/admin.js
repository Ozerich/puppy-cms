function isNum(n) {
    return parseFloat(n) != NaN && !isNaN(n);
}

jQuery.fn.check_empty = function (only_num) {
    if (only_num == null)
        only_num = false;

    var result = true;
    $(this).each(function () {

        var error = false;

        if ($(this).val() == '' || (only_num && !isNum($(this).val()))) {
            result = false;
            $(this).addClass('error');
        }
        else
            $(this).removeClass('error');
    });
    return result;
}

jQuery.fn.reset = function () {
    $(this).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
    return this;
}

jQuery.fn.disable_form = function () {
    $(this).find('input, select, textarea').attr('disabled', 'disabled');
}

jQuery.fn.enable_form = function () {
    $(this).find('input, select, textarea').removeAttr('disabled');
}


function BindCommissionEvents() {
    $('#commission-list .delete-commission').click(function () {
        var id = $(this).parents('tr').remove().find('.commission_id').val();
        $.ajax({
            url:'admin/cities/delete_commission/' + id
        });
        return false;
    });
}

function BindOrganizationEvents() {
    $('#organization-list .delete-organization').click(function () {
        var id = $(this).parents('tr').remove().find('.organization_id').val();
        $.ajax({
            url:'admin/animals/delete_organization/' + id
        });
        return false;
    });
}

$(document).ready(function () {

    $('.toggle_submenu').click(function () {
        $(this).parents('li').find('.submenu').toggle();
        $(this).html($(this).html() == '+' ? '—' : '+');
        return false;
    });

    $('#newcommission-submit').click(function () {
        if ($('.newcommission-block').find('input[type=text]').check_empty(true)) {
            var form = $('.newcommission-block');
            var data = $(form).find('*').serialize();
            $(form).disable_form();
            $.ajax({
                url:'admin/cities/new_commission/' + $('#city_id').val(),
                data:data,
                type:'post',
                success:function (data) {
                    $('#commission_list-wr').empty().html(data);
                    BindCommissionEvents();
                },
                complete:function () {
                    $(form).reset().enable_form();
                }
            });
        }
        return false;
    });
    BindCommissionEvents();

    $('#neworganization-submit').click(function () {
        if ($('.neworganization-block').find('input[type=text]').check_empty()) {
            var form = $('.neworganization-block');
            var data = $(form).find('*').serialize();
            $(form).disable_form();
            $.ajax({
                url:'admin/animals/new_organization/' + $('#animal_id').val(),
                data:data,
                type:'post',
                success:function (data) {
                    $('#organization_list-wr').empty().html(data);
                    BindOrganizationEvents();
                },
                complete:function () {
                    $(form).reset().enable_form();
                }
            });
        }
        return false;
    });
    BindOrganizationEvents();


    $('#useradd-submit').click(function () {
        if (!$('#userdata-page').find('#login, #password, #email, #password2').check_empty())
            return false;

        if ($('#userdata-page #password').val() != $('#userdata-page #password2').val()) {
            $('#userdata-page #password2').addClass('error');
            return false;
        }
        else $('#userdata-page #password2').removeClass('error');

        return true;
    });
});