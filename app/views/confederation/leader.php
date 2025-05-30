<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between align-items-center">
                            <h4 class="mb-4">Daftar Pimpinan Konfederasi</h4>
                            <a href="<?= BASEURL; ?>/ConfederationLeader/generateCsv/<?= $data['konfederasi_id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-file-csv"></i> CSV</a>
                        </div>
                    </div>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>

                    <table id="example" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">No. Telp</th>
                                <th class="text-center" colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data['confed_leader'] as $confedLeader) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $confedLeader['pk_nama']; ?></td>
                                <td><?= $confedLeader['pk_jabatan']; ?></td>
                                <td><?= $confedLeader['pk_no_telp']; ?></td>
                                <td><a href="<?= BASEURL; ?>/ConfederationLeader/editConfederationLeader/<?= $confedLeader['pk_id']; ?>" class="link-secondary showEditModal leader" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $confedLeader['pk_id'] ?>"><i class="fa-solid fa-pen-to-square fs-3"></i></a></td>
                                <td><a href="<?= BASEURL; ?>/ConfederationLeader/deleteConfederationLeader/<?= $confedLeader['pk_id']; ?>" class="link-danger"><i class="fa-solid fa-trash fs-3"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="button" class="addBtn leader btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Data</button>

                    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content bg-light">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Tambah Pimpinan Konfederasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= BASEURL; ?>/ConfederationLeader/addConfederationLeader" method="post">
                                    <input type="hidden" id="konfederasi_id" name="konfederasi_id" value="<?= $data['konfederasi_id']; ?>">
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group mb-4">
                                        <label for="nama" class="mb-1">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="jabatan" class="mb-1">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="no_telp" class="mb-1">No. Telp</label>
                                        <input type="number" class="form-control" id="no_telp" name="no_telp">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
