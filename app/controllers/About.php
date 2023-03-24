<?php

class About extends Controller{

    public function index($nama = '', $pekerjaan = '', $umur = 30){


        $data = array();
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;

        $this->view("templates/header");
        $this->view("about/index",$data);
        $this->view("templates/footer");
    }

    public function page(){
        $this->view("templates/header");
        $this->view("about/page");
        $this->view("templates/footer");

    }
}