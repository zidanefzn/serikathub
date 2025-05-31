$(function() {
    // Federation Handler
    $('.addBtn.federation').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Federation/addFederation');
        $('#nama, #alamat, #no_pencatatan, #konfederasi_id, #keterangan, #kota_id').val('');
    });

    $('.showEditModal.federation').on('click', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Federation/editFederation');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/serikathub/public/Federation/getedit',
            data: {id : id}, 
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#no_pencatatan').val(data.no_pencatatan);
                $('#konfederasi_id').val(data.konfederasi_id);
                $('#keterangan').val(data.keterangan);
                $('#kota_id').val(data.kota_id);
                $('#id').val(data.id);
            }
        });
    });

    // FederationLeader Handler
    $('.addBtn.fed-leader').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/FederationLeader/addFederationLeader');
        $('#nama, #jabatan, #no_telp').val('');
    });

    $('.showEditModal.fed-leader').on('click', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/FederationLeader/editFederationLeader');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/serikathub/public/FederationLeader/getedit',
            data: {id: id}, 
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.pf_nama || data.nama);
                $('#jabatan').val(data.pf_jabatan || data.jabatan);
                $('#no_telp').val(data.pf_no_telp || data.no_telp);
                $('#id').val(data.pf_id || data.id);
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", status, error);
            }
        });
    });
});