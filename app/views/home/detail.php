<div class="container">

    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['orang_detail']['nama']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['orang_detail']['email']; ?></h6>
                    <p class="card-text"><?php echo $data['orang_detail']['alamat']; ?></p>
                </div>
            </div>

        </div>
    </div>


</div>