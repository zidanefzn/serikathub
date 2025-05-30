<?php

class Dashboard extends Controller {
    public function index() {
        $data['judul'] = 'Dashboard';
        $data['total_confed'] = $this->model('DashboardModel')->getTotalConfederation();
        $data['total_fed'] = $this->model('DashboardModel')->getTotalFederation();
        $data['total_spsb'] = $this->model('DashboardModel')->getTotalSpsb();
        $data['province'] = $this->model('ProvinceModel')->getAllProvince();
        $data['spsb_provinsi'] = $this->model('DashboardModel')->getSpsbSummaryByProvince();
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }
}