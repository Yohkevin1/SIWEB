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
                                 <img src="<?= base_url('img/' . $dataBuku['gambar']) ?>" alt="" width="100%" height="100%">
                             </div>
                             <div class="col-md-8">
                                 <div class="card-body">
                                     <h5 class="card-title"><?= $dataBuku['judul_buku'] ?></h5>
                                     <p class="card-text">Penulis: <?= $dataBuku['penulis'] ?></p>
                                     <p class="card-text">Penerbit: <?= $dataBuku['penerbit'] ?></p>
                                     <p class="card-text">Tahun terbit: <?= $dataBuku['tahun_terbit'] ?></p>
                                     <p class="card-text">Kategori: <?= $dataBuku['nama_kategori'] ?></p>
                                     <p class="card-text">Jumlah: <?= $dataBuku['jumlah'] ?> Buku</p>
                                     <p class="card-text">Harga: <?= $dataBuku['harga'] ?></p>
                                     <p class="card-text">Diskon: <?= $dataBuku['diskon'] ?></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <a href="/book" class="btn btn-dark"><i class="fas fa-arrow-left"></i>
                 Kembali</a>
         </div>
     </main>
     <?= $this->endsection() ?>