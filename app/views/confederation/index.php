<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between align-items-center">
                            <h4 class="mb-4">Daftar Konfederasi</h4>
                            <a href="<?= BASEURL; ?>/Confederation/generateCsv" class="btn btn-secondary"><i class="fa-solid fa-file-csv"></i> CSV</a>
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
                                <th class="text-center align-middle">Konfederasi</th>
                                <th class="text-center align-middle">Alamat</th>
                                <th class="text-center align-middle">No. Pencatatan</th>
                                <th class="text-center align-middle">Jumlah Anggota</th>
                                <th class="text-center align-middle">Pimpinan</th>
                                <th class="text-center align-middle">Keterangan</th>
                                <th class="text-center align-middle" colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data['confed'] as $confed) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="text-center align-middle"><?= $confed['nama']; ?></td>
                                <td class="text-center align-middle"><?= $confed['alamat']; ?></td>
                                <td class="text-center align-middle"><?= $confed['no_pencatatan']; ?></td>
                                <td class="text-center align-middle"><?= $confed['total_anggota']; ?></td>
                                <td class="text-center align-middle"><a href="<?= BASEURL; ?>/ConfederationLeader/details/<?= $confed['id']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a></td>
                                <td class="text-center align-middle"><?= $confed['keterangan']; ?></td>
                                <td class="text-center align-middle"><a href="<?= BASEURL; ?>/Confederation/editConfederation/<?= $confed['id']; ?>" class="link-secondary showEditModal confederation" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $confed['id'] ?>"><i class="fa-solid fa-pen-to-square fs-3"></i></a></td>
                                <td class="text-center align-middle"><a href="<?= BASEURL; ?>/Confederation/deleteConfederation/<?= $confed['id']; ?>" class="link-danger" onclick="return confirm('Apakah anda yakin ingin menghapus konfederasi? Konfederasi mungkin masih memiliki afiliasi.');"><i class="fa-solid fa-trash fs-3"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="button" class="addBtn confederation btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Data</button>

                    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle">Tambah Konfederasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= BASEURL; ?>/Confederation/addConfederation" method="post">
                                        <input type="hidden" id="id" name="id">
                                        <div class="form-group mb-4">
                                            <label for="nama" class="mb-1">Nama *</label>
                                            <input type="text" class="form-control" id="nama" name="nama" require>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="alamat" class="mb-1">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="no_pencatatan" class="mb-1">No. Pencatatan</label>
                                            <input type="text" class="form-control" id="no_pencatatan" name="no_pencatatan">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="keterangan" class="mb-1">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" style="height: 100px;"></textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="kota_id" class="mb-1">Kabupaten/Kota *</label>
                                            <select style="width:100%" class="form-select js-example-basic-single kota" id="kota_id" name="kota_id">
                                                <option value="">Pilih Kota</option>
                                                <?php foreach ($data['city'] as $city) : ?>
                                                    <option value="<?= $city['id']; ?>" <?= ($city['id'] == $city['id']) ? 'selected' : ''; ?>>
                                                        <?= $city['nama']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
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