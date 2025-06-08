<?php

class SpsbLeader extends Controller {
    public function details($id) {
        $data['judul'] = 'Daftar Pimpinan SP/SB';
        $data['spsb_leader'] = $this->model('SpsbLeaderModel')->getSpsbLeaderById($id);
        $data['spsb_id'] = $id;
        $this->view('templates/header', $data);
        $this->view('spsb/leader', $data);
        $this->view('templates/footer');
    }

    public function addSpsbLeader() {
        if (empty($_POST['nama'])) {
            Flasher::setFlash('Nama wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/details/');
            exit;
        }

        if( $this->model('SpsbLeaderModel')->addDataSpsbLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/SpsbLeader/details/' . $_POST['spsb_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/details/' . $_POST['spsb_id']);
            exit;
        }
    }

    public function deleteSpsbLeader($id) {
        if( $this->model('SpsbLeaderModel')->deleteDataSpsbLeader($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/SpsbLeader/details/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/details/' . $id);
            exit;
        }
    }

    
    public function getedit() {
        echo json_encode($this->model('SpsbLeaderModel')->getLeaderById($_POST['id']));
    }
 

    public function editSpsbLeader() {
        if( $this->model('SpsbLeaderModel')->editDataSpsbLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/SpsbLeader/details/' . $_POST['spsb_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/details/' . $_POST['spsb_id']);
            exit;
        }
    }

}