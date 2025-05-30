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
            header('Location: ' . BASEURL . '/federation');
            exit;
        }

        if( $this->model('FederationModel')->addDataFederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/federation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/federation');
            exit;
        }
    }

    public function deleteFederation($id) {
        $result = $this->model('FederationModel')->deleteDataFederation($id);
        
        if ($result > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } elseif ($result === -1) {
            Flasher::setFlash('gagal', 'dihapus karena federasi masih memiliki afiliasi dengan SP/SB', 'danger');
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
        }
        
        header('Location: ' . BASEURL . '/federation');
        exit;
    }

    public function getedit() {
        echo json_encode($this->model('FederationModel')->getFederationById($_POST['id']));
    }

    public function editFederation() {
        if( $this->model('FederationModel')->editDataFederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/federation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/federation');
            exit;
        }
    }

    public function generateCsv() {
        $data['fed'] = $this->model('FederationModel')->getAllFederation();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_federasi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Federasi', 'Alamat', 'No. Pencatatan', 'Jumlah Anggota', 'Keterangan']);

        $no = 1;
        foreach ($data['fed'] as $fed) {
            fputcsv($output, [
                $no++, 
                $fed['nama'], 
                $fed['alamat'], 
                $fed['no_pencatatan'], 
                $fed['total_anggota'], 
                $fed['keterangan']
            ]);
        }

        fclose($output);
        exit;
    }
}