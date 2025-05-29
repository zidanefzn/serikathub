<?php

class City extends Controller {
    public function city() {
        $data['city'] = $this->model('cityModel')->getAllCity();
    }
}