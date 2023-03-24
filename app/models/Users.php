<?php

class Users{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
        
    }

    public function getNama(){
        return "EKO HENDRATNO";
    }

    public function getAllOrangBy($request){

        $this->db->query("SELECT * FROM users WHERE nama LIKE '%".$request['keyword']."%'");

        return $this->db->result();
    }

    public function getAllOrang(){

        $this->db->query("SELECT * FROM users");

        return $this->db->result();
    }

    public function getOrang($id){

        $this->db->query("SELECT * FROM users WHERE id=:id");
        $this->db->bind('id',$id);

        return $this->db->single();
    }

    public function setOrang($request){

        if( $request['id'] > 0 ){

            $this->db->query("UPDATE users SET nama=:nama, email=:email, alamat=:alamat WHERE id=:id");
            $this->db->bind('nama',$request['nama']);
            $this->db->bind('email',$request['email']);
            $this->db->bind('alamat',$request['alamat']);
            $this->db->bind('id',$request['id']);
            $this->db->execute();

            return $this->db->resultCount();

        }else{
            $this->db->query("INSERT INTO users VALUES(null,:nama,:email,:alamat)");
            $this->db->bind('nama',$request['nama']);
            $this->db->bind('email',$request['email']);
            $this->db->bind('alamat',$request['alamat']);

            return $this->db->resultCount();

        }

    }

    public function removeOrang($id){

        if( $id > 0 ){

            $this->db->query("DELETE FROM users WHERE id=:id");
            $this->db->bind('id',$id);
            $this->db->execute();

            return 1;

        }else{

            return 0;

        }

    }

}