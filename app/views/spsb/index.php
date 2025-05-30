<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                            <h2 class="mb-4">Daftar SP/SB</h2>
                            <div>
                                <a href="<?= BASEURL; ?>/Spsb/generateCsv" class="btn btn-secondary"><i class="fa-solid fa-file-csv"></i> CSV</a>
                            </div>
                        </div>
                    </div>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>

                    <table id="example" class="table table-bordered table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" rowspan="2">No</th>
                                <th class="text-center align-middle" rowspan="2">SP/SB</th>
                                <th class="text-center align-middle" rowspan="2">Alamat</th>
                                <th class="text-center align-middle" rowspan="2">No. Pencatatan</th>
                                <th class="text-center align-middle" colspan="2">Afiliasi</th>
                                <th class="text-center align-middle" rowspan="2">Jumlah Anggota</th>
                                <th class="text-center align-middle" rowspan="2">Pimpinan</th>
                                <th class="text-center align-middle" rowspan="2">Keterangan</th>
                                <th class="text-center align-middle" rowspan="2" colspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th class="text-center align-middle">Federasi (F)</th>
                                <th class="text-center align-middle">Konfederasi (K)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data['spsb'] as $spsb) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $spsb['nama']; ?></td>
                                <td><?= $spsb['alamat']; ?></td>
                                <td><?= $spsb['no_pencatatan']; ?></td>
                                <td><?= $spsb['federasi_nama']; ?></td>
                                <td><?= $spsb['konfederasi_nama']; ?></td>
                                <td class="text-center"><?= $spsb['jumlah_anggota']; ?></td>
                                <td><a href="<?= BASEURL; ?>/SpsbLeader/SpsbLeader/<?= $spsb['id']; ?>" class="btn btn-outline-secondary btn-sm">Detail</a></td>
                                <td><?= $spsb['keterangan']; ?></td>
                                <td><a href="<?= BASEURL; ?>/Spsb/editSpsb/<?= $spsb['id']; ?>" class="link-secondary showEditModal spsb" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $spsb['id'] ?>"><i class="fa-solid fa-pen-to-square fs-3"></i></a></td>
                                <td><a href="<?= BASEURL; ?>/Spsb/deleteSpsb/<?= $spsb['id']; ?>" class="link-danger"><i class="fa-solid fa-trash fs-3"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="button" class="addBtn spsb btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#formModal">Tambah Data</button>

                    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content bg-light">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Tambah SP/SB</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= BASEURL; ?>/Spsb/addSpsb" method="post">
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
                                        <label for="federasi_id" class="mb-1">Afiliasi Federasi</label>
                                        <select style="width:100%" class="form-select js-example-basic-single federasi" id="federasi_id" name="federasi_id">
                                            <option value="">Pilih Federasi</option>
                                            <?php foreach ($data['fed'] as $fed) : ?>
                                                <option value="<?= $fed['id']; ?>" <?= ($fed['id'] == $fed['id']) ? 'selected' : ''; ?>>
                                                    <?= $fed['nama']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="konfederasi_id" class="mb-1">Afiliasi Konfederasi</label>
                                        <select style="width:100%" class="form-select js-example-basic-single konfederasi" id="konfederasi_id" name="konfederasi_id">
                                            <option value="">Pilih Konfederasi</option>
                                            <?php foreach ($data['confed'] as $confed) : ?>
                                                <option value="<?= $confed['id']; ?>" <?= ($confed['id'] == $confed['id']) ? 'selected' : ''; ?>>
                                                    <?= $confed['nama']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="jumlah_anggota" class="mb-1">Jumlah Anggota</label>
                                        <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota">
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