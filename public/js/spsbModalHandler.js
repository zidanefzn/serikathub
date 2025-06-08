$(function() {
    // Spsb Handler
    $('.addBtn.spsb').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Spsb/addSpsb');
        $('#nama, #alamat, #no_pencatatan, #federasi_id, #konfederasi_id, #jumlah_anggota #keterangan, #kota_id').val('');
    });

    $('#example').on('click', '.showEditModal.spsb', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Spsb/editSpsb');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/serikathub/public/Spsb/getedit',
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

    // SpsbLeader Handler
    $('.addBtn.spsb-leader').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/SpsbLeader/addSpsbLeader');
        $('#nama, #jabatan, #no_telp').val('');
    });

    $('#example').on('click', '.showEditModal.spsb-leader', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/SpsbLeader/editSpsbLeader');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/serikathub/public/SpsbLeader/getedit',
            data: {id: id}, 
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.ps_nama || data.nama);
                $('#jabatan').val(data.ps_jabatan || data.jabatan);
                $('#no_telp').val(data.ps_no_telp || data.no_telp);
                $('#id').val(data.ps_id || data.id);
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", status, error);
            }
        });
    });

    // Spsb Delete Handler
    const deleteSpsbModal = document.getElementById('deleteSpsbModal');
    const deleteSpsbBtn = document.getElementById('deleteSpsbBtn');

    if (deleteSpsbModal) {
        deleteSpsbModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const baseurl = 'http://localhost/serikathub/public';
            deleteSpsbBtn.href = baseurl + '/Spsb/deleteSpsb/' + id;
        });
    }

    // SpsbLeader Delete Handler
    const deleteSpsbLeadModal = document.getElementById('deleteSpsbLeadModal');
    const deleteSpsbLeadBtn = document.getElementById('deleteSpsbLeadBtn');

    if (deleteSpsbLeadModal) {
        deleteSpsbLeadModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const baseurl = 'http://localhost/serikathub/public';
            deleteSpsbLeadBtn.href = baseurl + '/SpsbLeader/deleteSpsbLeader/' + id;
        });
    }
});