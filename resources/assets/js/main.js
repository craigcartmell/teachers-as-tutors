$(function () {
    $('.delete-record').on('click', function () {
        return confirm('Are you sure you wish to delete this record?');
    });

    $('select[name=parent_id]').on('change', function () {
        var parent_id = parseInt($(this).val());

        if (parent_id > 0) {
            $('input[name=uri], input[name=hero_image_uri], textarea[name=hero_text]').attr('disabled', 'disabled');
        } else {
            $('input[name=uri], input[name=hero_image_uri], textarea[name=hero_text]').removeAttr('disabled');
        }
    });

    $('select[name=parent_id]').change();
});