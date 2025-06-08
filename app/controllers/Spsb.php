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

}