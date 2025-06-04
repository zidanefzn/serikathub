<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between align-items-center">
                            <h4 class="mb-4">Daftar Afiliasi</h4>
                            <a href="<?= BASEURL; ?>/ConfederationAffiliate/generateCsv/<?= $data['konfederasi_id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-file-csv"></i> CSV</a>
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
                                <td class="text-center align-middle"><a href="<?= BASEURL; ?>/ConfederationAffiliate/deleteConfederationAffiliate/<?= $confedAff['id']; ?>" class="link-danger"><i class="fa-solid fa-trash fs-3"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
