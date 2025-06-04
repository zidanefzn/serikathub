<?php

class ConfederationAffiliate extends Controller {
    public function details($id) {
        $data['judul'] = 'Daftar Afiliasi';
        $data['confed_affiliate'] = $this->model('ConfederationAffiliateModel')->getConfederationAffiliateById($id);
        $data['konfederasi_id'] = $id;
        $this->view('templates/header', $data);
        $this->view('confederation/affiliate', $data);
        $this->view('templates/footer');
    }

    public function deleteConfederationAffiliate($id) {
        if( $this->model('ConfederationAffiliateModel')->deleteDataConfederationAffiliate($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/ConfederationAffiliate/details/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/ConfederationAffiliate/details/' . $id);
            exit;
        }
    }

    public function generateCsv($id) {
        $data['confed_affiliate'] = $this->model('ConfederationAffiliateModel')->getConfederationAffiliateById($id);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_afiliasi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Federasi', 'Alamat', 'No. Pencatatan', 'Keterangan']);

        $no = 1;
        foreach ($data['confed_affiliate'] as $confedAff) {
            fputcsv($output, [
                $no++, 
                $confedAff['federasi_nama'],
                $confedAff['federasi_alamat'],
                $confedAff['federasi_no_pencatatan'],
                $confedAff['federasi_keterangan']
            ]);
        }

        fclose($output);
        exit;
    }
}