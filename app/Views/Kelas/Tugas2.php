<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <h1 class="mt-4" style="margin-left: 0px;"><?= strtoupper($title) ?></h1>
            <div class="row gx-0 bg-warning justify-content-center text-center" style="height: 5vh;">
                <strong style="color: white; font-size: larger;">Container 1 - Gambar</strong>
            </div>
            <div class="row gx-0 bg-primary" style="height: 50vh;">
                <div class="col-6 d-flex flex-column justify-content-center text-center align-items-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSc45L0i87CmOl_MsJZ6HxwnhS-Mj0R81fJaw&usqp=CAU" alt="" width="150" height="180" style="object-fit: cover;">
                    <strong>MBEKKKKK</strong>
                </div>
                <div class="col-6" style="height: 50vh;">
                    <div class="bg-success h-100 d-flex flex-column align-items-center justify-content-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_lD5C_cqTabfbFiQ7QViTg8sV9izHLCaWwg&usqp=CAU" alt="" width="200" height="180" style="object-fit: cover;">
                        <strong>Salam Booyah</strong>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row gx-0 bg-warning justify-content-center text-center" style="height: 5vh;">
                <strong style="color: white; font-size: larger;">Container 1 - Gambar</strong>
            </div>
            <div class="row gx-0 bg-info" style="height: 20vh;">
                <div class="col-7 d-flex flex-column ">
                    <h4 class="text-center font-size: larger;">Pengalaman Belajar SIWEB:</h4>
                    <br>
                    <p>Kok Gampang Banget Ya lalalallalalalalalalalalalallalalalalalal</p>
                </div>
                <div class="col-5" style="height: 20vh;">
                    <div class="bg-primary h-100 d-flex flex-column ">
                        <strong style="text-align: center; font-size: larger;">Pesan Kesan Terhadap ASDOS:</strong>
                        <br>
                        <strong style="text-align: center; font-size: medium;">Pesan : GAK ADA</strong><br>

                        <strong style="text-align: center; font-size: small;">Kesan: SIWEB MENYENANGKAN</strong>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= $this->endsection() ?>