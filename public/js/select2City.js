$('#formModal').on('shown.bs.modal', function () {
    $('.js-example-basic-single').val($('#kota_id').val()).trigger('change');
});