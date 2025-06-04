<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <h4 class="mb-4">Rekapitulasi SP/SB</h4>
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
                                <td class="text-center align-middle"><?= $spsb['provinsi_nama']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['kota_nama']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['nama']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['alamat']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['no_pencatatan']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['federasi_nama']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['konfederasi_nama']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['jumlah_anggota']; ?></td>
                                <td class="text-center align-middle"><?= $spsb['keterangan']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>