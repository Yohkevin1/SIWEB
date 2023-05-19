<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <h1 class="mt-4" style="margin-left: 20px;"><?= strtoupper($title) ?></h1>
            <div class="row bg-warning" style="height: 50vh; margin-left: 20px;">
                <div class="col-4 d-flex flex-column justify-content-center text-center align-items-center">
                    <img src=" /img/Kepin.jpg" class="rounded-circle" width="150" height="150">
                    <strong>Biodata</strong>
                    <p>Nama: Yohanes Kevin Wahyu Utama</p>
                    <p>TTL: Jakarta, 1 Mei 2003 </p>
                    <p>NPM: 211711137</p>
                </div>
                <div class="col-8 p-2" style="height: 50vh;">
                    <div class="bg-primary h-100 d-flex flex-column align-items-center justify-content-center">
                        <img src="http://logo.uajy.ac.id/file/uploads/2021/08/UAJY-LOGOGRAM_-01.png " alt="" width="150" height="180" style="object-fit: cover;">
                        <strong>SAYA GK SUKA FRONT-END</strong>
                    </div>
                </div>
            </div>
        </div>
</div>

</div>


</div>


</div>
</main>
<?= $this->endsection() ?>;