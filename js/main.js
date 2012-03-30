function validateEmail(email) {

    if (email.length < 5)
        return false;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    return reg.test(email);
}

function validateDate(date) {

    if (date.length != 10)
        return false;
    var reg = /^\d\d\.\d\d\.\d\d\d\d$/;
    return reg.test(date);
}

function CheckItemErrors(is_edit) {
    var error_block = $('.error-block ul').empty();

    if ($('#plant_name').val().length == 0)
        $(error_block).append('<li>Название питомника не заполнено</li>');
    else if ($('#plant_name').val().length <= 5)
        $(error_block).append('<li>Название питомника заполнено не корректно</li>');

    if ($('#birthday').val().length == 0)
        $(error_block).append('<li>Дата рождения не выбрана</li>');
    else if (!validateDate($('#birthday').val()))
        $(error_block).append('<li>Дата рождения не корректна</li>');

    $('.main-params:visible input[type=text]').each(function () {
        if ($(this).val() == '')
            $(error_block).append('<li>Поле "' + $(this).prev().html() + '" не заполнено</li>');
    });

    if ($('#main_image').val() == '' && !is_edit)
        $(error_block).append('<li>Основная фотография не выбрана</li>');

    if ($('#price').val() == '')
        $(error_block).append('<li>Не указана цена</li>');
    else if ($('#price').val() == '0')
        $(error_block).append('<li>Цена должна быть больше нуля</li>');
    else if (isNaN(parseInt($('#item_price').val())))
        $(error_block).append('<li>Цена должна быть целым числом</li>');

    if ($('.error-block ul li').size() == 0)
        if ($('.agreement-checkbox:visible input:checked').size() != 2)
            $(error_block).append('<li>Вы не приняли условия соглашени</li>');

    if ($('.error-block ul li').size() > 0) {
        $('.error-block').show();
        return false;
    }

    $('.error-block').hide();
    return true;
}


function FinishUploadFiles(errors, is_edit) {

    $('#file_loader').hide();

    if (errors == true) {
        var error_block = $('.error-block').show().find('ul').empty().append('<li>Ошибка загрузки файлов</li>');
        $('.item_submit').show();
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
        url: is_edit ? 'edit/' + $('#item_id').val() : 'profile/add_item',
        data:data,
        type:'post',
        success:function (data) {
            document.location = 'profile';
        },
        error:function () {
            $('#new_item_submit').show();
        },
        complete:function () {
            $('#data_loader').hide();
        }
    });

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
    $('.birthday-param input').datepicker({
        changeMonth:true,
        changeYear:true
    }).datepicker("option", "showAnim", "blind").datepicker("option", "dateFormat", 'dd.mm.yy').val(val);

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
        }).change();

    $('#new-item #item_price').keyup(
        function () {
            $('#price-loader').css('display', 'inline-block');
            $('.price-commission .value').hide();
            $.post('profile/calc_price', 'price=' + $(this).val(), function (price) {
                $('#addprice_value').html(price);
                $('#price-loader').hide();
                $('.price-commission .value').show();
            });
        }).keyup();

    $('#new_item_submit, #edit_item_submit').click(function () {

        var is_edit = $(this).attr('id') == 'edit_item_submit';
        if(!CheckItemErrors(is_edit))
        return false;
        $(this).hide();

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
            FinishUploadFiles(0, is_edit);

        var loaded_count = 0;
        var errors = false;
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
                        if (jqXHR.responseText == 'error')
                            errors = true;
                        else {
                            data = jQuery.parseJSON(jqXHR.responseText);
                            $('#' + data.id + '_filename').val(data.filename);
                        }

                        loaded_count++;
                        if (loaded_count == good_count)
                            FinishUploadFiles(errors, is_edit);
                    }
                });
        }

        return false;
    });
});