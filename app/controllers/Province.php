<?php

class Province extends Controller {
    public function province() {
        $data['province'] = $this->model('ProvinceModel')->getAllProvince();
    }
}