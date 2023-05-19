 <?= $this->extend('layout/template') ?>

 <?= $this->section('content') ?>
 <div id="layoutSidenav_content">
     <main>
         <div class="container-fluid px-4">
             <h1 class="mt-4"><?= strtoupper($title) ?></h1>
             <ol class="breadcrumb mb-4">
                 <li class="breadcrumb-item active">Pengelolaan <?= $title ?></li>
             </ol>
             <div class="card mb-4">
                 <div class="card-header">
                     <i class="fas fa-table me-1"></i>
                     Detail <?= $title ?>
                 </div>
                 <div class="card-body">
                     <div class="card mb-3" style="max-width: 540px;">
                         <div class="row g-0">
                             <div class="col-md-4">
                                 <img src="<?= base_url('img/' . $dataKomik['cover']) ?>" alt="" width="100%" height="100%">
                             </div>
                             <div class="col-md-8">
                                 <div class="card-body">
                                     <h5 class="card-title"><?= $dataKomik['judul'] ?></h5>
                                     <p class="card-text">Penulis: <?= $dataKomik['penulis'] ?></p>
                                     <p class="card-text">Tahun Rilis: <?= $dataKomik['tahun_rilis'] ?></p>
                                     <p class="card-text">Harga: <?= $dataKomik['harga'] ?></p>
                                     <p class="card-text">Stock: <?= $dataKomik['stock'] ?> Buku</p>
                                     <p class="card-text">Diskon: <?= $dataKomik['diskon'] ?></p>
                                     <p class="card-text">Kategori: <?= $dataKomik['nama_kategori'] ?></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <a href="/komik" class="btn btn-dark"><i class="fas fa-arrow-left"></i>
                 Kembali</a>
         </div>
     </main>
     <?= $this->endsection() ?>