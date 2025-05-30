<?php

class Dashboard extends Controller {
    public function index() {
        $data['judul'] = 'Dashboard';
        $data['total_confed'] = $this->model('DashboardModel')->getTotalConfederation();
        $data['total_fed'] = $this->model('DashboardModel')->getTotalFederation();
        $data['total_spsb'] = $this->model('DashboardModel')->getTotalSpsb();
        $data['province'] = $this->model('ProvinceModel')->getAllProvince();
        $data['spsb_provinsi'] = $this->model('DashboardModel')->getSpsbSummaryByProvince();
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }

    public function generateCsv() {
        $data['spsb_provinsi'] = $this->model('DashboardModel')->getSpsbSummaryByProvince();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data_per_provinsi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Provinsi', 'Jumlah Konfederasi', 'Jumlah Federasi','Jumlah SP/SB', 'Jumlah Anggota']);

        $no = 1;
        foreach ($data['spsb_provinsi'] as $spsbProvince) {
            fputcsv($output, [
                $no++, 
                $spsbProvince['provinsi_nama'], 
                $spsbProvince['jumlah_konfederasi'], 
                $spsbProvince['jumlah_federasi'], 
                $spsbProvince['jumlah_spsb'], 
                $spsbProvince['total_anggota']
            ]);
        }

        fclose($output);
        exit;
    }
}