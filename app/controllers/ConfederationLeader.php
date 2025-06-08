<?php

class ConfederationLeader extends Controller {
    public function details($id) {
        $data['judul'] = 'Daftar Pimpinan Konfederasi';
        $data['confed_leader'] = $this->model('ConfederationLeaderModel')->getConfederationLeaderById($id);
        $data['konfederasi_id'] = $id;
        $this->view('templates/header', $data);
        $this->view('confederation/leader', $data);
        $this->view('templates/footer');
    }

    public function addConfederationLeader() {
        if (empty($_POST['nama'])) {
            Flasher::setFlash('Nama wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/');
            exit;
        }

        if( $this->model('ConfederationLeaderModel')->addDataConfederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/' . $_POST['konfederasi_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/' . $_POST['konfederasi_id']);
            exit;
        }
    }

    public function deleteConfederationLeader($id) {
        if( $this->model('ConfederationLeaderModel')->deleteDataConfederationLeader($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/' . $id);
            exit;
        }
    }

    
    public function getedit() {
        echo json_encode($this->model('ConfederationLeaderModel')->getLeaderById($_POST['id']));
    }

    public function editConfederationLeader() {
        if( $this->model('ConfederationLeaderModel')->editDataConfederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/' . $_POST['konfederasi_id']); // Mengarahkan ke ID yang benar
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/details/' . $_POST['konfederasi_id']); // Mengarahkan ke ID yang benar
            exit;
        }
    }

}