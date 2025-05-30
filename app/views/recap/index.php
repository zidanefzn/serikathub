<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <h4 class="mb-4">Rekapitulasi SP/SB</h4>
                        <div class="dropdown" id="csv-dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-file-csv"></i> CSV
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="<?= BASEURL; ?>/Recap/generateCsv">Nasional</a></li>
                                <?php foreach ($data['province'] as $province) : ?>
                                    <li><a class="dropdown-item" href="<?= BASEURL; ?>/Recap/generateCsvProvinsi/<?= $province['id']; ?>"><?= $province['nama']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
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
                                <th class="text-center align-middle" rowspan="2">Provinsi</th>
                                <th class="text-center align-middle" rowspan="2">Kota</th>
                                <th class="text-center align-middle" rowspan="2">SP/SB</th>
                                <th class="text-center align-middle" rowspan="2">Alamat</th>
                                <th class="text-center align-middle" rowspan="2">No. Pencatatan</th>
                                <th class="text-center align-middle" colspan="2">Afiliasi</th>
                                <th class="text-center align-middle" rowspan="2">Jumlah Anggota</th>
                                <th class="text-center align-middle" rowspan="2">Keterangan</th>
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
                                <td><?= $spsb['provinsi_nama']; ?></td>
                                <td><?= $spsb['kota_nama']; ?></td>
                                <td><?= $spsb['nama']; ?></td>
                                <td><?= $spsb['alamat']; ?></td>
                                <td><?= $spsb['no_pencatatan']; ?></td>
                                <td><?= $spsb['federasi_nama']; ?></td>
                                <td><?= $spsb['konfederasi_nama']; ?></td>
                                <td class="text-center"><?= $spsb['jumlah_anggota']; ?></td>
                                <td><?= $spsb['keterangan']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>