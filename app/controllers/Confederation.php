<?php

class Confederation extends Controller {
    public function index() {
        $data['judul'] = 'Daftar Konfederasi';
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $this->view('templates/header', $data);
        $this->view('confederation/index', $data);
        $this->view('templates/footer');
    }

    public function addConfederation() {
        if (empty($_POST['nama']) || empty($_POST['kota_id'])) {
            Flasher::setFlash('Nama dan Kota wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        }

        if( $this->model('ConfederationModel')->addDataConfederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        }
    }

    public function deleteConfederation($id) {
        if( $this->model('ConfederationModel')->deleteDataConfederation($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        }
    }

    public function getedit() {
        echo json_encode($this->model('ConfederationModel')->getConfederationById($_POST['id']));
    }

    public function editConfederation() {
        if( $this->model('ConfederationModel')->editDataConfederation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/confederation');
            exit;
        }
    }

    public function generatePdf() {
        // Ambil data konfederasi
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();

        // Membuat instance FPDF
        require_once($_SERVER['DOCUMENT_ROOT'] . '/serikathub/public/lib/fpdf/fpdf.php');
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(280, 10, 'DAFTAR KONFEDERASI', 0, 0, 'C');

        // Set font untuk header tabel
        $pdf->Cell(10, 15, '', 0, 1,);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Konfederasi', 1,  0, 'C');
        $pdf->Cell(70, 10, 'Alamat', 1,  0, 'C');
        $pdf->Cell(60, 10, 'No. Pencatatan', 1,  0, 'C');
        $pdf->Cell(37, 10, 'Jumlah Anggota', 1,  0, 'C');
        $pdf->Cell(40, 10, 'Keterangan', 1,  0, 'C');
        $pdf->Ln();

        // Set font untuk data tabel
        $pdf->SetFont('Times', '', 12);

        // Menampilkan data dari database
        $no = 1;
        foreach ($data['confed'] as $confed) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(60, 10, $confed['nama'], 1, 0, 'C');
            $pdf->Cell(70, 10, $confed['alamat'], 1, 0, 'C');
            $pdf->Cell(60, 10, $confed['no_pencatatan'], 1, 0, 'C');
            $pdf->Cell(37, 10, $confed['total_anggota'], 1, 0, 'C');
            $pdf->Cell(40, 10, $confed['keterangan'], 1, 0, 'C');
            $pdf->Ln();
        }

        // Output PDF ke browser
        $pdf->Output();
    }

    public function generateCsv() {
        // Ambil data konfederasi
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();

        // Set header untuk pengunduhan file CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_konfederasi.csv"');

        // Membuka file untuk ditulis
        $output = fopen('php://output', 'w');

        // Menulis header kolom CSV
        fputcsv($output, ['No', 'Konfederasi', 'Alamat', 'No. Pencatatan', 'Jumlah Anggota', 'Keterangan']);

        // Menulis data dari database
        $no = 1;
        foreach ($data['confed'] as $confed) {
            fputcsv($output, [
                $no++, 
                $confed['nama'], 
                $confed['alamat'], 
                $confed['no_pencatatan'], 
                $confed['total_anggota'], 
                $confed['keterangan']
            ]);
        }

        // Menutup file
        fclose($output);
        exit;
    }
}