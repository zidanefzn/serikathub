<?php

class FederationLeader extends Controller {
    public function details($id) {
        $data['judul'] = 'Daftar Pimpinan Federasi';
        $data['fed_leader'] = $this->model('FederationLeaderModel')->getFederationLeaderById($id);
        $data['federasi_id'] = $id;
        $this->view('templates/header', $data);
        $this->view('federation/leader', $data);
        $this->view('templates/footer');
    }

    public function addFederationLeader() {
        if (empty($_POST['nama'])) {
            Flasher::setFlash('Nama wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/details/');
            exit;
        }

        if( $this->model('FederationLeaderModel')->addDataFederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/FederationLeader/details/' . $_POST['federasi_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/details/' . $_POST['federasi_id']);
            exit;
        }
    }

    public function deleteFederationLeader($id) {
        if( $this->model('FederationLeaderModel')->deleteDataFederationLeader($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/FederationLeader/details/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/details/' . $id);
            exit;
        }
    }

    
    public function getedit() {
        echo json_encode($this->model('FederationLeaderModel')->getLeaderById($_POST['id']));
    }
 

    public function editFederationLeader() {
        if( $this->model('FederationLeaderModel')->editDataFederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/FederationLeader/details/' . $_POST['federasi_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/details/' . $_POST['federasi_id']);
            exit;
        }
    }

    public function generateCsv($id) {
        $data['fed_leader'] = $this->model('FederationLeaderModel')->getFederationLeaderById($id);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_pimpinan_federasi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Nama', 'Jabatan', 'No. Telp']);

        $no = 1;
        foreach ($data['fed_leader'] as $fedLeader) {
            fputcsv($output, [
                $no++, 
                $fedLeader['pf_nama'],
                $fedLeader['pf_jabatan'],
                $fedLeader['pf_no_telp']
            ]);
        }

        fclose($output);
        exit;
    }
}