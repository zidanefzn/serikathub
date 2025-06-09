$('#formModal').on('shown.bs.modal', function () {
    $('.js-example-basic-single.konfederasi').select2({
        dropdownParent: '#formModal'
    });
    
    $('.js-example-basic-single.konfederasi').val($('#konfederasi_id').val()).trigger('change');
});