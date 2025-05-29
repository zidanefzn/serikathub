$('#formModal').on('shown.bs.modal', function () {
    $('.js-example-basic-single').select2({
        placeholder: 'Pilih Kota',
        dropdownParent: '#formModal'
    });
});