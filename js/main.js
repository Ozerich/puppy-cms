function validateEmail(email) {

    if (email.length < 5)
        return false;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    return reg.test(email);
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
});