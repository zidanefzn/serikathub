$('#formModal').on('shown.bs.modal', function () {
    $('.js-example-basic-single.kota').select2({
        placeholder: 'Pilih Kabupaten/Kota',
        dropdownParent: '#formModal'
    });
    
    $('.js-example-basic-single.kota').val($('#kota_id').val()).trigger('change');
});