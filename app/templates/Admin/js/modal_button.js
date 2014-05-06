$(document).ready(function() {



});

$('body').on('hidden.bs.modal', '.modal', function() {
    $(this).removeData('bs.modal');
});

$('.removecontent').on('click', function() {
    var modal = $('#myModal');
    modal.find('.modal-title').html('');
    modal.find('.modal-body').html('');
    modal.find('.modal-footer').html('');
});