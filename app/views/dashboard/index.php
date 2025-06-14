<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Konfederasi</p>
                    <h6 class="mb-0"><?= $data['total_confed']['total_konfederasi'] ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-people-group fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Federasi</p>
                    <h6 class="mb-0"><?= $data['total_fed']['total_federasi'] ?></h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-user-group fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">SP/SB</p>
                    <h6 class="mb-0"><?= $data['total_spsb']['total_spsb'] ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6 vw-100">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-between align-items-center">
                        <h4 class="mb-4">Konfederasi, Federasi, dan SP/SB Setiap Provinsi</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Provinsi</th>
                                <th class="text-center align-middle">Jumlah Konfederasi</th>
                                <th class="text-center align-middle">Jumlah Federasi</th>
                                <th class="text-center align-middle">Jumlah SP/SB</th>
                                <th class="text-center align-middle">Jumlah Anggota</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($data['spsb_provinsi'] as $spsbProvince) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $no++ ?></td>
                                <td class="text-center align-middle"><?= $spsbProvince['provinsi_nama']; ?></td>
                                <td class="text-center align-middle"><?= $spsbProvince['jumlah_konfederasi']; ?></td>
                                <td class="text-center align-middle"><?= $spsbProvince['jumlah_federasi']; ?></td>
                                <td class="text-center align-middle"><?= $spsbProvince['jumlah_spsb']; ?></td>
                                <td class="text-center align-middle"><?= $spsbProvince['total_anggota']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>