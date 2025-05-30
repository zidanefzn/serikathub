<?php

class Recap extends Controller {
    public function index() {
        $data['judul'] = 'Rekapitulasi SP/SB';
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();
        $data['fed'] = $this->model('FederationModel')->getAllFederation();
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $data['province'] = $this->model('ProvinceModel')->getAllProvince();
        $this->view('templates/header', $data);
        $this->view('recap/index', $data);
        $this->view('templates/footer');
    }

    public function generateCsv() {
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="rekapitulasi_nasional_spsb.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Provinsi', 'Kabupaten/Kota', 'SP/SB', 'Alamat', 'No. Pencatatan', 'Afiliasi', '', 'Jumlah Anggota', 'Keterangan']);
        fputcsv($output, ['', '', '', '', '', '', 'Federasi (F)', 'Konfederasi (K)', '', '']);

        $no = 1;
        foreach ($data['spsb'] as $spsb) {
            fputcsv($output, [
                $no++, 
                $spsb['provinsi_nama'], 
                $spsb['kota_nama'], 
                $spsb['nama'], 
                $spsb['alamat'], 
                $spsb['no_pencatatan'], 
                $spsb['federasi_nama'],
                $spsb['konfederasi_nama'],
                $spsb['jumlah_anggota'], 
                $spsb['keterangan']
            ]);
        }

        fclose($output);
        exit;
    }

    public function generateCsvProvinsi($provinsi_id) {
        // Ambil data berdasarkan provinsi_id
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb($provinsi_id);

        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename=\"rekapitulasi_spsb_provinsi_{$provinsi_id}.csv\"");

        $output = fopen('php://output', 'w');
        fputcsv($output, ['No', 'Provinsi', 'Kabupaten/Kota', 'SP/SB', 'Alamat', 'No. Pencatatan', 'Afiliasi', '', 'Jumlah Anggota', 'Keterangan']);
        fputcsv($output, ['', '', '', '', '', '', 'Federasi (F)', 'Konfederasi (K)', '', '']);
        
        $no = 1;
        foreach ($data['spsb'] as $spsb) {
            fputcsv($output, [
                $no++,
                $spsb['provinsi_nama'],
                $spsb['kota_nama'],
                $spsb['nama'],
                $spsb['alamat'],
                $spsb['no_pencatatan'],
                $spsb['federasi_nama'],
                $spsb['konfederasi_nama'],
                $spsb['jumlah_anggota'],
                $spsb['keterangan']
            ]);
        }

        fclose($output);
        exit;
    }
}