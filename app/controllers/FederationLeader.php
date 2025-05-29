<?php

class FederationLeader extends Controller {
    public function FederationLeader($id) {
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
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/');
            exit;
        }

        if( $this->model('FederationLeaderModel')->addDataFederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/' . $_POST['federasi_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/' . $_POST['federasi_id']);
            exit;
        }
    }

    public function deleteFederationLeader($id) {
        if( $this->model('FederationLeaderModel')->deleteDataFederationLeader($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/' . $id);
            exit;
        }
    }

    
    public function getedit() {
        echo json_encode($this->model('FederationLeaderModel')->getLeaderById($_POST['id']));
    }
 

    public function editFederationLeader() {
        if( $this->model('FederationLeaderModel')->editDataFederationLeader($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/' . $_POST['federasi_id']);
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/FederationLeader/FederationLeader/' . $_POST['federasi_id']);
            exit;
        }
    }

    public function generatePdf($id) {  
        ob_clean();
        
        $data['fed_leader'] = $this->model('FederationLeaderModel')->getFederationLeaderById($id);

        require_once($_SERVER['DOCUMENT_ROOT'] . '/serikathub/public/lib/fpdf/fpdf.php');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(200, 10, 'DAFTAR PIMPINAN FEDERASI', 0, 0, 'C');

        $pdf->Cell(10, 15, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(65, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(55, 10, 'Jabatan', 1, 0, 'C');
        $pdf->Cell(60, 10, 'No. Telp', 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', '', 12);

        $no = 1;
        foreach ($data['fed_leader'] as $fedLeader) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(65, 10, $fedLeader['pf_nama'], 1, 0, 'C');
            $pdf->Cell(55, 10, $fedLeader['pf_jabatan'], 1, 0, 'C');
            $pdf->Cell(60, 10, $fedLeader['pf_no_telp'], 1, 0, 'C'); 
            $pdf->Ln();
        }

        $pdf->Output(); 
        exit;
    }

    public function generateCsv($id) {
        $data['fed_leader'] = $this->model('FederationLeaderModel')->getFederationLeaderById($id);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_pimpinan_federasi.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Nama', 'Jabatan', 'No. Telp']);

        $no = 1;
        foreach ($data['fed_leader'] as $confedLeader) {
            fputcsv($output, [
                $no++, 
                $confedLeader['pf_nama'],
                $confedLeader['pf_jabatan'],
                $confedLeader['pf_no_telp']
            ]);
        }

        fclose($output);
        exit;
    }
}