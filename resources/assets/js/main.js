$(function () {
    $('.delete-record').on('click', function () {
        return confirm('Are you sure you wish to delete this record?');
    });
});