<?php

class Federation extends Controller {
    public function index() {
        $data['judul'] = 'Daftar Federasi';
        $data['fed'] = $this->model('FederationModel')->getAllFederation();
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
        if( $this->model('FederationModel')->deleteDataFederation($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/federation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/federation');
            exit;
        }
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

    public function generatePdf() {
        $data['fed'] = $this->model('FederationModel')->getAllFederation();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/serikathub/public/lib/fpdf/fpdf.php');
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(280, 10, 'DAFTAR FEDERASI', 0, 0, 'C');

        $pdf->Cell(10, 15, '', 0, 1,);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Federasi', 1,  0, 'C');
        $pdf->Cell(70, 10, 'Alamat', 1,  0, 'C');
        $pdf->Cell(60, 10, 'No. Pencatatan', 1,  0, 'C');
        $pdf->Cell(37, 10, 'Jumlah Anggota', 1,  0, 'C');
        $pdf->Cell(40, 10, 'Keterangan', 1,  0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', '', 12);

        $no = 1;
        foreach ($data['fed'] as $fed) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(60, 10, $fed['nama'], 1, 0, 'C');
            $pdf->Cell(70, 10, $fed['alamat'], 1, 0, 'C');
            $pdf->Cell(60, 10, $fed['no_pencatatan'], 1, 0, 'C');
            $pdf->Cell(37, 10, $fed['total_anggota'], 1, 0, 'C');
            $pdf->Cell(40, 10, $fed['keterangan'], 1, 0, 'C');
            $pdf->Ln();
        }

        $pdf->Output();
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