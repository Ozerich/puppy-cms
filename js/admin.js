$(document).ready(function () {

    $('.toggle_submenu').click(function () {
        $(this).parents('li').find('.submenu').toggle();
        $(this).html($(this).html() == '+' ? '—' : '+');
        return false;
    });

});