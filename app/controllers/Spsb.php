<?php

class Spsb extends Controller {
    public function index() {
        $data['judul'] = 'Daftar SP/SB';
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();
        $data['fed'] = $this->model('FederationModel')->getAllFederation();
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $this->view('templates/header', $data);
        $this->view('spsb/index', $data);
        $this->view('templates/footer');
    }

    public function addSpsb() {
        if (empty($_POST['nama']) || empty($_POST['kota_id'])) {
            Flasher::setFlash('Nama dan Kota wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        }

        if( $this->model('SpsbModel')->addDataSpsb($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        }
    }

    public function deleteSpsb($id) {
        if( $this->model('SpsbModel')->deleteDataSpsb($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        }
    }

    public function getedit() {
        echo json_encode($this->model('SpsbModel')->getSpsbById($_POST['id']));
    }

    public function editSpsb() {
        if( $this->model('SpsbModel')->editDataSpsb($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Spsb');
            exit;
        }
    }

    public function generateCsv() {
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_spsb.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'SP/SB', 'Alamat', 'No. Pencatatan', 'Afiliasi', '', 'Jumlah Anggota', 'Keterangan']);
        fputcsv($output, ['', '', '', '', 'Federasi (F)', 'Konfederasi (K)', '', '']);

        $no = 1;
        foreach ($data['spsb'] as $spsb) {
            fputcsv($output, [
                $no++, 
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