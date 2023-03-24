<?php

class Home extends Controller{
    public function index(){


        $users = $this->model('Users');

        $data = array();
        $data['nama'] = $users->getNama();
        $data['orang_orang'] = $users->getAllOrang();

        $this->view("templates/header");
        $this->view("home/index",$data);
        $this->view("templates/footer");
    }

    public function detail($id){


        $users = $this->model('Users');

        $data = array();
        $data['orang_detail'] = $users->getOrang($id);

        $this->view("templates/header");
        $this->view("home/detail",$data);
        $this->view("templates/footer");
    }

    public function cari(){


        $users = $this->model('Users');

        $data = array();
        $data['orang_orang'] = $users->getAllOrangBy($_POST);

        $this->view("templates/header");
        $this->view("home/cari",$data);
        $this->view("templates/footer");
    }

    public function simpan(){


        $users = $this->model('Users');
        if( $users->setOrang($_POST) > 0 ){

            Flasher::setFlash('Data berhasil disimpan!','success'); 

        }else{

            Flasher::setFlash('Data gagal disimpan!','danger'); 

        }       

        header("Location:".BASE_URL."/home/index");
        exit;


    }

    public function data($id){


        $users = $this->model('Users');

        echo json_encode( $users->getOrang($id) );
    }

    public function hapus($id){
        $users = $this->model('Users');
        if( $users->removeOrang($id)){

            Flasher::setFlash('Data berhasil dihapus!','success'); 

        }else{

            Flasher::setFlash('Data gagal dihapus!','danger'); 

        }       

        header("Location:".BASE_URL."/home/index");
        exit;

    }
}