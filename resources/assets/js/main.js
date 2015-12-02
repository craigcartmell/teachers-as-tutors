var App = App || {};

$(function () {
    window.siteUrl = $('body').data('site-url');

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });

    $('.delete-record').on('click', function () {
        return confirm('Are you sure you wish to delete this record?');
    });

    $('select[name=parent_id]').on('change', function () {
        var parent_id = parseInt($(this).val());

        if (parent_id > 0) {
            $('input[name=uri], textarea[name=hero_text]').attr('disabled', 'disabled');
        } else {
            $('input[name=uri], textarea[name=hero_text]').removeAttr('disabled');
        }
    });

    $('select[name=parent_id]').change();

    function preload(arrayOfImages) {
        $(arrayOfImages).each(function(){
            $('<img/>')[0].src = this;
        });
    }

    preload([
        window.siteUrl + '/img/heroes/hero_home_hand_writing.jpg'
    ]);
});