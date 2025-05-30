<?php

class ConfederationLeader extends Controller {
    public function ConfederationLeader($id) {
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
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/');
            exit;
        }

        if( $this->model('ConfederationLeaderModel')->addDataConfederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/' . $_POST['konfederasi_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/' . $_POST['konfederasi_id']);
            exit;
        }
    }

    public function deleteConfederationLeader($id) {
        if( $this->model('ConfederationLeaderModel')->deleteDataConfederationLeader($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/' . $id);
            exit;
        }
    }

    
    public function getedit() {
        echo json_encode($this->model('ConfederationLeaderModel')->getLeaderById($_POST['id']));
    }

    public function editConfederationLeader() {
        if( $this->model('ConfederationLeaderModel')->editDataConfederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/' . $_POST['konfederasi_id']); // Mengarahkan ke ID yang benar
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/ConfederationLeader/ConfederationLeader/' . $_POST['konfederasi_id']); // Mengarahkan ke ID yang benar
            exit;
        }
    }

    public function generateCsv($id) {
        $data['confed_leader'] = $this->model('ConfederationLeaderModel')->getConfederationLeaderById($id);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_pimpinan_konfederasi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Nama', 'Jabatan', 'No. Telp']);

        $no = 1;
        foreach ($data['confed_leader'] as $confedLeader) {
            fputcsv($output, [
                $no++, 
                $confedLeader['pk_nama'],
                $confedLeader['pk_jabatan'],
                $confedLeader['pk_no_telp']
            ]);
        }

        fclose($output);
        exit;
    }
}