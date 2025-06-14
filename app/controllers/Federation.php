<?php

class Federation extends Controller {
    public function index() {
        $data['judul'] = 'Daftar Federasi';
        $data['fed'] = $this->model('FederationModel')->getAllFederation();
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $this->view('templates/header', $data);
        $this->view('federation/index', $data);
        $this->view('templates/footer');
    }

    public function addFederation() {
        if (empty($_POST['nama']) || empty($_POST['kota_id'])) {
            Flasher::setFlash('Nama dan Kota wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        }

        if( $this->model('FederationModel')->addDataFederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        }
    }

    public function deleteFederation($id) {
        $result = $this->model('FederationModel')->deleteDataFederation($id);
        
        if ($result > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        }
    }

    public function getedit() {
        echo json_encode($this->model('FederationModel')->getFederationById($_POST['id']));
    }

    public function editFederation() {
        if( $this->model('FederationModel')->editDataFederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Federation');
            exit;
        }
    }

}