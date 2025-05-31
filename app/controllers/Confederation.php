<?php

class Confederation extends Controller {
    public function index() {
        $data['judul'] = 'Daftar Konfederasi';
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $this->view('templates/header', $data);
        $this->view('confederation/index', $data);
        $this->view('templates/footer');
    }

    public function addConfederation() {
        if (empty($_POST['nama']) || empty($_POST['kota_id'])) {
            Flasher::setFlash('Nama dan Kota wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        }

        if( $this->model('ConfederationModel')->addDataConfederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        }
    }

    public function deleteConfederation($id) {
        $result = $this->model('ConfederationModel')->deleteDataConfederation($id);
        
        if ($result > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        }
    }

    public function getedit() {
        echo json_encode($this->model('ConfederationModel')->getConfederationById($_POST['id']));
    }

    public function editConfederation() {
        if( $this->model('ConfederationModel')->editDataConfederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Confederation');
            exit;
        }
    }

    public function generateCsv() {
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_konfederasi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Konfederasi', 'Alamat', 'No. Pencatatan', 'Jumlah Anggota', 'Keterangan']);

        $no = 1;
        foreach ($data['confed'] as $confed) {
            fputcsv($output, [
                $no++, 
                $confed['nama'], 
                $confed['alamat'], 
                $confed['no_pencatatan'], 
                $confed['total_anggota'], 
                $confed['keterangan']
            ]);
        }

        fclose($output);
        exit;
    }
}