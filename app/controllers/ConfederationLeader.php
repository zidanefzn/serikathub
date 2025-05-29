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

    public function generatePdf($id) {  // Tambahkan parameter $id
        // Pastikan tidak ada output sebelumnya
        ob_clean();
        
        // Ambil data konfederasi
        $data['confed_leader'] = $this->model('ConfederationLeaderModel')->getConfederationLeaderById($id);

        // Membuat instance FPDF
        require_once($_SERVER['DOCUMENT_ROOT'] . '/serikathub/public/lib/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(200, 10, 'DAFTAR PIMPINAN KONFEDERASI', 0, 0, 'C');

        // Set font untuk header tabel
        $pdf->Cell(10, 15, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(65, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(55, 10, 'Jabatan', 1, 0, 'C');
        $pdf->Cell(60, 10, 'No. Telp', 1, 0, 'C');
        $pdf->Ln();

        // Set font untuk data tabel
        $pdf->SetFont('Times', '', 12);

        // Menampilkan data dari database
        $no = 1;
        foreach ($data['confed_leader'] as $confedLeader) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(65, 10, $confedLeader['pk_nama'], 1, 0, 'C');  // Gunakan pk_nama
            $pdf->Cell(55, 10, $confedLeader['pk_jabatan'], 1, 0, 'C'); // Gunakan pk_jabatan
            $pdf->Cell(60, 10, $confedLeader['pk_no_telp'], 1, 0, 'C'); // Gunakan pk_no_telp
            $pdf->Ln();
        }

        // Output PDF ke browser
        $pdf->Output(); // Beri nama file
        exit; // Pastikan tidak ada output setelahnya
    }

    public function generateCsv($id) {
        // Ambil data konfederasi
        $data['confed_leader'] = $this->model('ConfederationLeaderModel')->getConfederationLeaderById($id);

        // Set header untuk pengunduhan file CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_pimpinan_konfederasi.csv"');

        // Membuka file untuk ditulis
        $output = fopen('php://output', 'w');

        // Menulis header kolom CSV
        fputcsv($output, ['No', 'Nama', 'Jabatan', 'No. Telp']);

        // Menulis data dari database
        $no = 1;
        foreach ($data['confed_leader'] as $confedLeader) {
            fputcsv($output, [
                $no++, 
                $confedLeader['pk_nama'],
                $confedLeader['pk_jabatan'],
                $confedLeader['pk_no_telp']
            ]);
        }

        // Menutup file
        fclose($output);
        exit;
    }
}