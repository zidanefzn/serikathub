<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between align-items-center">
                            <h4 class="mb-4">Daftar Afiliasi</h4>
                        </div>
                    </div>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>

                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Federasi</th>
                                <th class="text-center align-middle">Alamat</th>
                                <th class="text-center align-middle">No. Pencatatan</th>
                                <th class="text-center align-middle">Keterangan</th>
                                <th class="text-center align-middle">Jumlah Anggota</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data['confed_affiliate'] as $confedAff) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="text-center align-middle"><?= $confedAff['nama']; ?></td>
                                <td class="text-center align-middle"><?= $confedAff['alamat']; ?></td>
                                <td class="text-center align-middle"><?= $confedAff['no_pencatatan']; ?></td>
                                <td class="text-center align-middle"><?= $confedAff['total_anggota']; ?></td>
                                <td class="text-center align-middle"><?= $confedAff['keterangan']; ?></td>
                                <td class="text-center align-middle"><a href="" class="link-danger" data-bs-toggle="modal" data-bs-target="#deleteConfedAffModal" data-id="<?= $confedAff['id'] ?>"><i class="fa-solid fa-trash fs-3"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="modal fade" id="deleteConfedAffModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Hapus Federasi Afiliasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus federasi afiliasi?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a href="" id="deleteConfedAffBtn" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
