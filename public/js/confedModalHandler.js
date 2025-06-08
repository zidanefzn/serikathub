$(function() {
    // Confederation Handler
    $('.addBtn.confederation').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Confederation/addConfederation');
        $('#nama, #alamat, #no_pencatatan, #keterangan, #kota_id').val('');
    });

    $('#example').on('click', '.showEditModal.confederation', function() {
        $('#modalTitle').html('Edit Data');
        $('.modal-footer button[type=submit]').html('Edit Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/Confederation/editConfederation');

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
                $('#keterangan').val(data.keterangan);
                $('#kota_id').val(data.kota_id);
                $('#id').val(data.id);
            }
        });
    });

    // ConfederationLeader Handler
    $('.addBtn.leader').on('click', function() {
        $('#modalTitle').html('Tambah Data');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('.modal-body form').attr('action', 'http://localhost/serikathub/public/ConfederationLeader/addConfederationLeader');
        $('#nama, #jabatan, #no_telp').val('');
    });

    $('#example').on('click', '.showEditModal.leader', function() {
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

    // Confederation Delete Handler
    const deleteConfedModal = document.getElementById('deleteConfedModal');
    const deleteConfedBtn = document.getElementById('deleteConfedBtn');

    if (deleteConfedModal) {
        deleteConfedModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const baseurl = 'http://localhost/serikathub/public';
            deleteConfedBtn.href = baseurl + '/Confederation/deleteConfederation/' + id;
        });
    }

    // ConfederationLeader Delete Handler
    const deleteConfedLeadModal = document.getElementById('deleteConfedLeadModal');
    const deleteConfedLeadBtn = document.getElementById('deleteConfedLeadBtn');

    if (deleteConfedLeadModal) {
        deleteConfedLeadModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const baseurl = 'http://localhost/serikathub/public';
            deleteConfedLeadBtn.href = baseurl + '/ConfederationLeader/deleteConfederationLeader/' + id;
        });
    }

    // ConfederationAffiliate Delete Handler
    const deleteConfedAffModal = document.getElementById('deleteConfedAffModal');
    const deleteConfedAffBtn = document.getElementById('deleteConfedAffBtn');

    if (deleteConfedAffModal) {
        deleteConfedAffModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const baseurl = 'http://localhost/serikathub/public';
            deleteConfedAffBtn.href = baseurl + '/ConfederationAffiliate/deleteConfederationAffiliate/' + id;
        });
    }
});