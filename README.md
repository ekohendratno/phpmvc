# PHP MVC (Model View Controller
 
Fitur:
* Controller
* Model
* View


Struktur File dan Folder:
```
app/
 -config/
  -config.php
 -controller/
  -Home.php
  -About.php
 -models/
  -Users.php
 -core/
  -App.php
  -Controller.php
  -Database.php
  -Flasher.php
 -views/
  -about/
  -home/
  -templates/
   -header.php
   -footer.php
 -init.php
 -.htaccess
public/
 -js/
 -css/
 -img/
 -index.php
 -.htaccess
```

Routing
```
/controller/method/param1/param2/param3
```

Default Routing:
```
/home/index
```


Cara Membuat:

app/controller/Tes.php
```
<?php
class Tes extend Controller{

    public function index(){


        $tes = $this->model('Tes');

        $data = array();
        
        $data['all'] = $tes->getAllTes();

        $this->view("templates/header");
        $this->view("tes/index",$data);
        $this->view("templates/footer");
    }
    
    public function simpan(){


        $tes = $this->model('Tes');
        if( $tes->setTes($_POST) > 0 ){

            Flasher::setFlash('Data berhasil disimpan!','success'); 

        }else{

            Flasher::setFlash('Data gagal disimpan!','danger'); 

        }       

        header("Location:".BASE_URL."/home/index");
        exit;


    }
    
    public function hapus($id){
        $tes = $this->model('Tes');
        if( $tes->removeTes($id)){

            Flasher::setFlash('Data berhasil dihapus!','success'); 

        }else{

            Flasher::setFlash('Data gagal dihapus!','danger'); 

        }       

        header("Location:".BASE_URL."/home/index");
        exit;

    }
    

}
```

app/models/Tes.php
```
<?php
class Users{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
        
    }
    
    public function getAllOrang(){

        $this->db->query("SELECT * FROM tes");

        return $this->db->result();
    }
    
    public function setTes($request){

        if( $request['id'] > 0 ){

            $this->db->query("UPDATE tes SET nama=:nama WHERE id=:id");
            $this->db->bind('nama',$request['nama']);
            $this->db->bind('id',$request['id']);
            $this->db->execute();

            return $this->db->resultCount();

        }else{
            $this->db->query("INSERT INTO tes VALUES(null,:nama)");
            $this->db->bind('nama',$request['nama']);

            return $this->db->resultCount();

        }

    }
    
    public function removeTes($id){

        if( $id > 0 ){

            $this->db->query("DELETE FROM tes WHERE id=:id");
            $this->db->bind('id',$id);
            $this->db->execute();

            return 1;

        }else{

            return 0;

        }

    }
}
```

app/views/tes/index.php
```


<form action="<?php echo BASE_URL; ?>/home/simpan" method="post">
    <input name="id" type="hidden" class="form-control" value="0">

    <div class="form-group row">
        <label for="staticNama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input name="nama" type="text" class="form-control" id="staticNama" value="">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input name="email" type="text" class="form-control" id="staticEmail" value="">
        </div>
    </div>
    <div class="form-group row">
        <label for="staticAlamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
            <input name="alamat" type="text" class="form-control" id="staticAlamat" value="">
        </div>
    </div>
    <div class="form-group text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>



<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NAMA</th>
            <th scope="col" class="text-center">AKSI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;

        foreach ($data['all'] as $tes) {
        ?>
            <tr>
                <th scope="row"><?php echo $no; ?></th>
                <td><?php echo $tes['nama']; ?></td>
                <td class="text-center">

                    <a href="<?php echo BASE_URL; ?>/tes/detail/<?php echo $orang['id']; ?>"><span class="badge badge-primary badge-pill">detail</span></a>
                    <a href="javascript:void();" class="ubah" onclick="openEdit(<?php echo $orang['id']; ?>)"><span class="badge badge-success badge-pill" data-toggle="modal" data-target="#exampleModalCenter">edit</span></a>
                    <a href="<?php echo BASE_URL; ?>/tes/hapus/<?php echo $orang['id']; ?>"><span class="badge badge-danger badge-pill">hapus</span></a>

                </td>
            </tr>

        <?php
            $no++;
        }

        ?>
    </tbody>
</table>


<script type="text/javascript">
    function openEdit(id) {

        $.ajax({
            method: 'get',
            url: '<?php echo BASE_URL; ?>/tes/data/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data);

                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' ' + errorThrown);
            }
        });
    };
</script>

```


Screenshot

<img src="https://raw.githubusercontent.com/ekohendratno/phpmvc/main/screenshot.png" width="60%"></img> 

