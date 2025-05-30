<?php

class Spsb extends Controller {
    public function index() {
        $data['judul'] = 'Daftar SP/SB Perusahaan';
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();
        $data['fed'] = $this->model('FederationModel')->getAllFederation();
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $this->view('templates/header', $data);
        $this->view('spsb/index', $data);
        $this->view('templates/footer');
    }

    public function addSpsb() {
        if (empty($_POST['nama']) || empty($_POST['kota_id'])) {
            Flasher::setFlash('Nama dan Kota wajib diisi!', 'Harap isi terlebih dahulu!', 'danger');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        }

        if( $this->model('SpsbModel')->addDataSpsb($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        }
    }

    public function deleteSpsb($id) {
        if( $this->model('SpsbModel')->deleteDataSpsb($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        }
    }

    public function getedit() {
        echo json_encode($this->model('SpsbModel')->getSpsbById($_POST['id']));
    }

    public function editSpsb() {
        if( $this->model('SpsbModel')->editDataSpsb($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/spsb');
            exit;
        }
    }

    public function generatePdf() {
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/serikathub/public/lib/fpdf/fpdf.php');
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Times', 'B', 13);
        $pdf->Cell(280, 10, 'DAFTAR SP/SB PERUSAHAAN', 0, 0, 'C');

        $pdf->Cell(10, 15, '', 0, 1,);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(10, 20, 'No', 1, 0, 'C');
        $pdf->Cell(60, 20, 'SP/SB', 1,  0, 'C');
        $pdf->Cell(32, 20, 'Alamat', 1,  0, 'C');
        $pdf->Cell(40, 20, 'No. Pencatatan', 1,  0, 'C');
        $pdf->Cell(70, 10, 'Afiliasi', 1,  0, 'C');
        $pdf->Cell(37, 20, 'Jumlah Anggota', 1,  0, 'C');
        $pdf->Cell(30, 20, 'Keterangan', 1,  0, 'C');
        $pdf->Ln();

        $pdf->SetY(35);
        $pdf->SetX(152);
        $pdf->Cell(35, 10, 'Federasi (F)', 1,  0, 'C');
        $pdf->SetX(187);
        $pdf->Cell(35, 10, 'Konfederasi (K)', 1,  0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', '', 12);

        $no = 1;
        foreach ($data['spsb'] as $spsb) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(60, 10, $spsb['nama'], 1, 0, 'C');
            $pdf->Cell(32, 10, $spsb['alamat'], 1, 0, 'C');
            $pdf->Cell(40, 10, $spsb['no_pencatatan'], 1, 0, 'C');
            $pdf->Cell(35, 10, $spsb['federasi_nama'], 1, 0, 'C');
            $pdf->Cell(35, 10, $spsb['konfederasi_nama'], 1, 0, 'C');
            $pdf->Cell(37, 10, $spsb['jumlah_anggota'], 1, 0, 'C');
            $pdf->Cell(30, 10, $spsb['keterangan'], 1, 0, 'C');
            $pdf->Ln();
        }

        $pdf->Output();
    }

    public function generateCsv() {
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="daftar_spsb_perusahaan.csv"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'SP/SB Perusahaan', 'Alamat', 'No. Pencatatan', 'Afiliasi', '', 'Jumlah Anggota', 'Keterangan']);
        fputcsv($output, ['', '', '', '', 'Federasi (F)', 'Konfederasi (K)', '', '']);

        $no = 1;
        foreach ($data['spsb'] as $spsb) {
            fputcsv($output, [
                $no++, 
                $spsb['nama'], 
                $spsb['alamat'], 
                $spsb['no_pencatatan'], 
                $spsb['federasi_nama'],
                $spsb['konfederasi_nama'],
                $spsb['jumlah_anggota'], 
                $spsb['keterangan']
            ]);
        }

        fclose($output);
        exit;
    }
}