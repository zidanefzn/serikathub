$(function() {
    // Handler untuk Confederation
    $('.addBtn.spsb').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Spsb/addSpsb');
        // Kosongkan form
        $('#nama, #alamat, #no_pencatatan, #federasi_id, #konfederasi_id, #jumlah_anggota #keterangan, #kota_id').val('');
    });

    $('.showEditModal.spsb').on('click', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Spsb/editSpsb');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/serikathub/public/Confederation/getedit',
            data: {id : id}, 
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#no_pencatatan').val(data.no_pencatatan);
                $('#federasi_id').val(data.federasi_id);
                $('#konfederasi_id').val(data.konfederasi_id);
                $('#jumlah_anggota').val(data.jumlah_anggota);
                $('#keterangan').val(data.keterangan);
                $('#kota_id').val(data.kota_id);
                $('#id').val(data.id);
            }
        });
    });

    // Handler untuk ConfederationLeader
    $('.addBtn.leader').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/ConfederationLeader/addConfederationLeader');
        // Kosongkan form
        $('#nama, #jabatan, #no_telp').val('');
    });

    $('.showEditModal.leader').on('click', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/ConfederationLeader/editConfederationLeader');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/serikathub/public/ConfederationLeader/getedit',
            data: {id: id}, 
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.pk_nama || data.nama);
                $('#jabatan').val(data.pk_jabatan || data.jabatan);
                $('#no_telp').val(data.pk_no_telp || data.no_telp);
                $('#id').val(data.pk_id || data.id);
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", status, error);
            }
        });
    });
});