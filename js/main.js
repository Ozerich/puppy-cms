jQuery.fn.setdatepicker = function () {
    var val = $(this).val();
    $(this).datepicker({
        changeMonth:true,
        changeYear:true
    }).datepicker("option", "showAnim", "blind").datepicker("option", "dateFormat", 'dd.mm.yy').val(val);
    return $(this);
}

function str_replace(search, replace, subject) {
    return subject.split(search).join(replace);
}

function validateEmail(email) {

    if (email.length < 5)
        return false;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    return reg.test(email);
}

function isNumber(n) {
    n = str_replace(',', '.', n);
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function validateDate(date) {

    if (date.length != 10)
        return false;
    var reg = /^\d\d\.\d\d\.\d\d\d\d$/;
    return reg.test(date);
}

function update_list_events() {
    $('#item_list .edit-open').click(function () {
        $(this).parents('.item-block').next('.item-admin').toggle().find('.submit-area span').hide();
        return false;
    });

    $('.publish-till').setdatepicker();

    $('.item-admin .item-status').change(function () {
        var block = $(this).parents('.item-admin');
        $(block).find('.status-params').hide();
        $('#' + $(this).attr('id') + '_' + $(this).val()).show();
    });

    $('.status-filter a').click(function () {
        $('#filter_type').val($(this).attr('filter'));
        $('#admin_filter_form').submit();
        return false;
    });
}


function update_item(event, item_id) {
    var block = $(event.target).parents('.item-admin');
    var error = $(block).find('.error').hide();
    $(block).find('.success').hide();
    if ($(block).find('.publish-till').is(':visible') && $(block).find('.publish-till').val().length != 10)
        $(error).css('display', 'inline-block');

    if ($(error).is(':visible'))
        return false;

    $(block).find('.loading').show();
    $(event.target).hide();

    $.post('admin_item/' + item_id, $(block).find('form').serialize(), function (data) {
        $(block).find('.loading').hide();
        $(block).find('.success').css('display', 'inline-block');
        $(event.target).show();
    });

    return false;
}

function CheckItemErrors(is_edit) {
    var error_block = $('.error-block ul').empty();

    if ($('#birthday').val().length == 0)
        $(error_block).append('<li>Дата рождения не выбрана</li>');
    else if (!validateDate($('#birthday').val()))
        $(error_block).append('<li>Дата рождения не корректна</li>');

    $('.main-params:visible input[type=text]').each(function () {
        if ($(this).val() == '')
            $(error_block).append('<li>Поле "' + $(this).prev().html() + '" не заполнено</li>');
    });

    $('#mother input[type=text]:visible').each(function () {
        if ($(this).val() == '') {
            $(error_block).append('<li>Не все поля у мамы заполнены</li>');
            return false;
        }
    });


    $('#father input[type=text]:visible').each(function () {
        if ($(this).val() == '') {
            $(error_block).append('<li>Не все поля у папы заполнены</li>');
            return false;
        }
    });

    if ($('#main_image').val() == '' && !is_edit)
        $(error_block).append('<li>Основная фотография не выбрана</li>');

    if ($('#price').val() == '')
        $(error_block).append('<li>Не указана цена</li>');
    else if ($('#price').val() == '0')
        $(error_block).append('<li>Цена должна быть больше нуля</li>');
    else if (isNaN(parseInt($('#item_price').val())))
        $(error_block).append('<li>Цена должна быть целым числом</li>');

    if ($(".main-params .param.weight:visible").length && !isNumber($('.main-params .param.weight:visible input').val()))
        $(error_block).append('<li>Вес должен быть числом</li>');
    if ($(".main-params .param.height:visible").length && !isNumber($('.main-params .param.height:visible input').val()))
        $(error_block).append('<li>Рост должен быть числом</li>');

    if ($('.error-block ul li').size() == 0)
        if ($('.agreement-checkbox:visible').size() == 2 && $('.agreement-checkbox:visible input:checked').size() != 2)
            $(error_block).append('<li>Вы не приняли условия соглашени</li>');

    if ($('.error-block ul li').size() > 0) {
        $('.error-block').show();
        return false;
    }

    $('.error-block').hide();
    return true;
}


function FinishUploadFiles(errors, is_edit, is_save) {

    $('#file_loader').hide();

    if (errors != '') {
        var error_block = $('.error-block').show().find('ul').empty().append('<li>Ошибка загрузки файлов: ' + errors + '</li>');
        $('.item-submit').show();
        return false;
    }

    $('#data_loader').show();

    var data = '';

    data += $('.top-info *').serialize() + '&' + $('.parents *').serialize() + '&' + $('.bottom-params *').serialize() +
        '&' + $('.param.another *').serialize() + '&' + $('.param.price *').serialize() + '&' + $('.images *').serialize() +
        '&' + $('.agreement:visible *').serialize() + '&' + $('.main-params:visible *').serialize();

    data += '&organization=' + $('.organization-block:visible input[type=radio]:checked').val();

    data += '&documents=';
    var doc_count = 0;
    $('.documents:visible input[type=checkbox]:checked').each(function () {
        data += (doc_count == 0 ? '' : ',') + $(this).val();
        doc_count++;
    });

    $.ajax({
        url:is_edit ? 'edit/' + $('#item_id').val() : 'profile/add_item',
        data:data + '&is_save=' + (is_save ? 1 : 0),
        type:'post',
        success:function (data) {
            document.location = 'view/' + data;
        },
        error:function () {
            $('#new_item_submit').show();
            $('#edit_item_submit').show();
        },
        complete:function () {
            $('#data_loader').hide();
            $('#new_item_submit').show();
            $('#edit_item_submit').show();
        }
    });

}

function update_user_items_events() {
    $('#admin_user .user-items tr.item-line').click(function () {
        if ($(this).hasClass('active')) {
            $('#admin_user .user-items tr.item-line').removeClass('active');
            $('#admin_user .user-items tr.item-admin').hide();
        }
        else {
            $('#admin_user .user-items tr.item-line').removeClass('active');
            $('#admin_user .user-items tr.item-admin').hide();
            $(this).next().toggle();
            $(this).toggleClass('active');
        }
    });

    $('.publish-till').setdatepicker();

    $('#admin_user .user-items .item-status').change(function () {
        var block = $(this).parents('.item-admin');
        $(block).find('.status-params').hide();
        $('#' + $(this).attr('id') + '_' + $(this).val()).show();
    });

    $('#admin_user .user-items .save-item').click(function () {
        var block = $(this).parents('.item-admin');
        $(block).find('.loading').show();
        $(this).hide();
        $.post('user/update_item/' + $(block).find('.item_id').val(), $(block).find('*').serialize(), function (data) {
            $(block).find('.loading').hide();
            $(block).find('.save-item').show();
            $('#admin_user .user-items').html(data);
            update_user_items_events();
        });
        return false;
    });
}

function profile_change_status(event, item_id, status) {
    var action_block = $(event.target).parents('.action');
    $(event.target).hide();
    $(action_block).find('.result-status').show();
    $(action_block).find('.baloon').hide();

    $.post('profile/update_item/' + item_id, 'status=' + status, function (data) {

    });

    return false;
}

$(document).ready(function () {


    $('#open_register').click(function () {
        $(this).hide();
        $("#register-block").slideDown();
        return false;
    });

    $('#register_submit').click(function () {

        $('#register-block').find('textarea,input').removeClass('error');

        if (!validateEmail($('#register_email').val()))
            $('#register_email').addClass('error');

        $('#register_password, #register_name, #register_surname, #register_address, #register_phone').each(function () {
            if ($(this).val() == '')
                $(this).addClass('error');
        });

        if ($('#register_password').val() != $('#register_password2').val())
            $('#register_password2').addClass('error');


        return $('#register-block input.error').length == 0;
    });

    $('#edit_profile').click(function () {
        $(this).hide();
        $('#save_profile').show();

        $('#profile_data').find('input, select, textarea').show();
        $('#profile_data').find('span').hide();

        return false;
    });

    $('#save_profile').click(function () {

        $('#profile_data').find('input, textarea').removeClass('error');

        $('#person_name, #person_surname, #person_address, #person_phone').each(function () {
            if ($(this).val() == '')
                $(this).addClass('error');
        });

        if (!validateEmail($('#person_email').val()))
            $('#person_email').addClass('error');

        if ($('#profile_data input.error').length)
            return false;

        $('#profile_data').find('input, textarea, select').each(function () {
            $(this).parents('.profile-param').find('span').html($(this).get(0).tagName == 'SELECT' ? $(this).find('option:selected').html() : $(this).val());
        });

        $('#header_email').html($('#person_email').val());

        $(this).hide();
        $('#edit_profile').show();
        $('#profile_data').find('input, select, textarea').hide();
        $('#profile_data').find('span').show();

        $.post('profile/ajax_save', $('#profile_data').find('*').serialize());

        return false;
    });

    var val = $('.birthday-param input').val();
    $('.birthday-param input').setdatepicker().val(val);

    $('#new-item #kind').change(
        function () {
            var option = $(this).find('option:selected');
            $('.organization-block').hide();
            $('#organizationblock_' + $(option).attr('animal')).show();

            $('.documents').hide();
            $('#documents_' + $(option).attr('animal')).show();

            if ($(option).attr('is_weight') != 0)
                $('.parent .weight').show();
            else $('.parent .weight').hide();

            if ($(option).attr('is_height') != 0)
                $('.parent .height').show();
            else $('.parent .height').hide();

            $('.main-params').hide();
            $('#main_params_' + $(option).val()).show();

            $('.agreement').hide();
            $('#agreement1_' + $(option).val() + ', #agreement2_' + $(option).val()).show();

            $('.agreement-checkbox input[type=checkbox]').removeAttr('checked');
        }).change();

    $('#new-item #agreement_type').change(
        function () {
            var block = $(this).parents('.agreement');
            $(block).find('.agreement-content').hide();
            $(block).find('#agreement_' + $(this).val()).show();
            $('.agreement-checkbox input[type=checkbox]').removeAttr('checked');
            $('#new-item #item_price').keyup();
        }).change();

    $('#new-item #item_price').keyup(
        function () {
            if ($('#new-item #agreement_type').filter(':visible').find('option:selected').val() == 'free') {
                $('#price-loader').css('display', 'inline-block');
                $('.price-commission .value').hide();
                $.post('profile/calc_price', 'price=' + $(this).val(), function (price) {
                    $('#addprice_value').html(price);
                    $('#price-loader').hide();
                    $('.price-commission .value').show();
                });
            }
            else
                $('#addprice_value').html($('#new-item #item_price').val());
        });

    $('#new_item_submit, #edit_item_submit,#save_item_submit').click(function () {

        var is_edit = $(this).attr('id') != 'new_item_submit';
        var is_save = $(this).attr('id') == 'save_item_submit';
        if (!CheckItemErrors(is_edit))
            return false;
        $('#new_item_submit, #edit_item_submit,#save_item_submit').hide();


        $('#file_loader').show();

        var files = [];
        files.push({'id':'mother_image', 'name':'Фотография мамы'});
        files.push({'id':'father_image', 'name':'Фотография папы'});
        files.push({'id':'main_image', 'name':'Основная фотография'});
        var count = 1;
        $('#new-item .images .image').not('.mainimage').find('input[type=file]').each(function () {
            files.push({'id':$(this).attr('id'), 'name':'Фотография ' + count++});
        });

        var good_count = 0;
        for (var file_ind in files)
            if ($('#' + files[file_ind].id).val() != '')
                good_count++;

        if (good_count == 0)
            FinishUploadFiles('', is_edit, is_save);

        var loaded_count = 0;
        var errors = '';
        for (var file_ind in files) {
            var file = files[file_ind];
            if ($('#' + file.id).val() == '')
                continue;
            $.ajaxFileUpload(
                {
                    url:'profile/upload_image/' + file.id,
                    secureuri:false,
                    fileElementId:file.id,
                    async:false,
                    success:function (data, status) {
                        if (typeof(data.error) != 'undefined') {
                            if (data.error != '') {
                                alert(data.error);
                            }
                        }
                    },
                    complete:function (jqXHR, textStatus) {
                        data = jQuery.parseJSON(jqXHR.responseText);
                        if (data.error == 1)
                            errors = data.error_text;
                        else {
                            $('#' + data.id + '_filename').val(data.filename);
                        }
                        loaded_count++;
                        if (loaded_count == good_count)
                            FinishUploadFiles(errors, is_edit, is_save);
                    }
                });
        }

        return false;
    });

    update_list_events();

    if ($('#item_view .left-wrapper a[rel=photo]').size())
        $('#item_view .left-wrapper a[rel=photo]').colorbox({maxWidth:750, maxHeight:600});

    update_user_items_events();

    $('#item_list .read-more').click(function () {
        $(this).parents('p').find('.more-text').show();
        $(this).remove();
        return false;
    });

    $('.current-photo .deleteimage').click(function () {
        $(this).parents('.current-photo').remove();
        return false;
    });

    $('.item-admin .deleteitem').click(function () {
        $(this).hide();
        var block = $(this).parents('.item-admin');
        $(block).find('.deleted').show();
        $(block).find('.save-button').hide();
        $.get('profile/delete_item/' + $(block).find('.item-id').val());
        return false;
    });
});
