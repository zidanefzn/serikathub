$('#formModal').on('shown.bs.modal', function () {
    $('.js-example-basic-single.federasi').select2({
        dropdownParent: '#formModal'
    });
    
    $('.js-example-basic-single.federasi').val($('#federasi_id').val()).trigger('change');
});