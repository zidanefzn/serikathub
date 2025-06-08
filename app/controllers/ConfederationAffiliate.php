<?php

class ConfederationAffiliate extends Controller {
    public function details($id) {
        $data['judul'] = 'Daftar Afiliasi';
        $data['confed_affiliate'] = $this->model('ConfederationAffiliateModel')->getConfederationAffiliateById($id);
        $data['konfederasi_id'] = $id;
        $this->view('templates/header', $data);
        $this->view('confederation/affiliate', $data);
        $this->view('templates/footer');
    }

    public function deleteConfederationAffiliate($id) {
        if( $this->model('ConfederationAffiliateModel')->deleteDataConfederationAffiliate($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/ConfederationAffiliate/details/' . $id);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/ConfederationAffiliate/details/' . $id);
            exit;
        }
    }

}