<div class="container">
    <div class="jumbotron mt-5">
        <h1 class="display-4">Selamat datang di PHPMVC</h1>
        <p class="lead">Halo, nama Saya <?php echo $data['nama']; ?></p>
    </div>

    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-md-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">

            <div class="col-sm-12">
                <form action="<?php echo BASE_URL; ?>/home/cari" method="post">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInput">Katakunci</label>
                            <input name="keyword" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Cari disini">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-12">

                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Tambah Data
                </a>

            </div>
            <br />
            <br />




            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    foreach ($data['orang_orang'] as $orang) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><?php echo $orang['nama']; ?></td>
                            <td><?php echo $orang['email']; ?></td>
                            <td class="text-center">

                                <a href="<?php echo BASE_URL; ?>/home/detail/<?php echo $orang['id']; ?>"><span class="badge badge-primary badge-pill">detail</span></a>
                                <a href="javascript:void();" class="ubah" onclick="openEdit(<?php echo $orang['id']; ?>)"><span class="badge badge-success badge-pill" data-toggle="modal" data-target="#exampleModalCenter">edit</span></a>
                                <a href="<?php echo BASE_URL; ?>/home/hapus/<?php echo $orang['id']; ?>"><span class="badge badge-danger badge-pill">hapus</span></a>

                            </td>
                        </tr>

                    <?php
                        $no++;
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


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


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function openEdit(id) {

        $.ajax({
            method: 'get',
            url: '<?php echo BASE_URL; ?>/home/data/' + id,
            dataType: 'json',
            success: function(data) {
                console.log(data);

                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="alamat"]').val(data.alamat);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + textStatus + ' ' + errorThrown);
            }
        });
    };
</script>