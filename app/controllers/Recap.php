<?php

class Recap extends Controller {
    public function index() {
        $data['judul'] = 'Rekapitulasi SP/SB';
        $data['spsb'] = $this->model('SpsbModel')->getAllSpsb();
        $data['fed'] = $this->model('FederationModel')->getAllFederation();
        $data['confed'] = $this->model('ConfederationModel')->getAllConfederation();
        $data['city'] = $this->model('CityModel')->getAllCity();
        $data['province'] = $this->model('ProvinceModel')->getAllProvince();
        $this->view('templates/header', $data);
        $this->view('recap/index', $data);
        $this->view('templates/footer');
    }

}