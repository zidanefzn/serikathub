<?php

class SpsbLeader extends Controller {
    public function SpsbLeader($id) {
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
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/');
            exit;
        }

        if( $this->model('SpsbLeaderModel')->addDataSpsbLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/' . $_POST['spsb_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/' . $_POST['spsb_id']);
            exit;
        }
    }

    public function deleteSpsbLeader($id) {
        if( $this->model('SpsbLeaderModel')->deleteDataSpsbLeader($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/' . $id);
            exit;
        }
    }

    
    public function getedit() {
        echo json_encode($this->model('SpsbLeaderModel')->getLeaderById($_POST['id']));
    }
 

    public function editSpsbLeader() {
        if( $this->model('SpsbLeaderModel')->editDataSpsbLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/' . $_POST['spsb_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/SpsbLeader/SpsbLeader/' . $_POST['spsb_id']);
            exit;
        }
    }

    public function generatePdf($id) {  
        ob_clean();
        
        $data['spsb_leader'] = $this->model('SpsbLeaderModel')->getSpsbLeaderById($id);

        require_once($_SERVER['DOCUMENT_ROOT'] . '/serikathub/public/lib/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(200, 10, 'DAFTAR PIMPINAN spsb', 0, 0, 'C');

        $pdf->Cell(10, 15, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(65, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(55, 10, 'Jabatan', 1, 0, 'C');
        $pdf->Cell(60, 10, 'No. Telp', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', '', 12);

        $no = 1;
        foreach ($data['spsb_leader'] as $SpsbLeader) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(65, 10, $SpsbLeader['ps_nama'], 1, 0, 'C');
            $pdf->Cell(55, 10, $SpsbLeader['ps_jabatan'], 1, 0, 'C');
            $pdf->Cell(60, 10, $SpsbLeader['ps_no_telp'], 1, 0, 'C'); 
            $pdf->Ln();
        }

        $pdf->Output(); 
        exit;
    }

    public function generateCsv($id) {
        $data['spsb_leader'] = $this->model('SpsbLeaderModel')->getSpsbLeaderById($id);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_pimpinan_spsb.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Nama', 'Jabatan', 'No. Telp']);

        $no = 1;
        foreach ($data['spsb_leader'] as $SpsbLeader) {
            fputcsv($output, [
                $no++, 
                $SpsbLeader['pf_nama'],
                $SpsbLeader['pf_jabatan'],
                $SpsbLeader['pf_no_telp']
            ]);
        }

        fclose($output);
        exit;
    }
}