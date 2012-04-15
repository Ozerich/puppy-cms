$(document).ready(function () {
    $('#filter #city').change(
        function () {
            var city = $(this).find('option:selected').html();

            if (city == 'Киев')
                $('#filter #price').removeAttr('disabled').html('<option value="0_inf">любая</option>' + ($('#filter #kind option:selected').attr('animal') == 2 ?
                    '<option value="0_2400">до 2400 грн</option>' : '') +
                    '<option value="2401_5000">до 5 000 грн</option><option value="5001_9000">до 9 000 грн</option>' +
                    '<option value="9001_">до 14 000 грн</option><option value="14000_inf">от 14 000 грн</option>');
            else if (city == 'Минск')
                $('#filter #price').removeAttr('disabled').html('<option value="0_inf">любая</option>' + ($('#filter #kind option:selected').attr('animal') == 2 ?
                    '<option value="0_300">до 300$</option>' : '') +
                    '<option value="301_500">до 500$</option><option value="501_700">до 700$</option>' +
                    '<option value="701_1000">до 1000$</option><option value="1001_inf">от 1000$</option>');
            else
                $('#filter #price').removeAttr('disabled').html('<option value="0_inf">любая</option><option value="0_40000">до 40 000 руб</option>' +
                    '<option value="40001_70000">до 70 000 руб</option><option value="70001_inf">от 70 000 руб</option>');


        }).change();

    $('#filter #kind').change(
        function () {
            var kind = $(this).find('option:selected');

            if ($(kind).attr('has_weight') == '1')
                $('#filter #weight').removeAttr('disabled').html('<option value="0_inf">любой</option><option value="0_1.6">до 1.6 кг</option>' +
                    '<option value="1.61_2">1.6 - 2 кг</option><option value="2_inf">2 кг и более</option>');
            else
                $('#filter #weight').html('').attr('disabled', 'disabled');

            if ($(kind).attr('has_height') == '1')
                $('#filter #height').removeAttr('disabled').html('<option value="0_inf">любой</option><option value="0_20">до 20 см</option><option value="21_50">20 - 50 см</option>' +
                    '<option value="51_70">50 - 70 см</option><option value="71_inf">70 см и более</option>');
            else
                $('#filter #height').html('').attr('disabled', 'disabled');

            $('#filter #city').change();
        }).change();

    $('#filter #filter_submit').click(function () {
        $(this).hide();
        $('#filter #filter_loading').show();

        var data = $('#filter form').serialize();

        $.post('filter', data, function (html) {
            data = jQuery.parseJSON(html);
            $('#content').html(data.data);
            $('#filter_phone').html(data.phone);
            update_list_events();
            $('#filter #filter_submit').show();
            $('#filter #filter_loading').hide();
        });

        return false;
    });
});