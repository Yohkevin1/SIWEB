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
                     <?= $title ?>
                 </div>
                 <div class="card-body">
                     <!-- Form data -->
                     <form action="<?= base_url('book-update/' . $dataBuku['id_buku']) ?>" method="post" enctype="multipart/form-data">
                         <?= csrf_field() ?>
                         <div class="mb-3 row">
                             <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control <?= $validation->hasError('judul_buku') ? 'is-invalid' : '' ?>" id="judul_buku" name="judul_buku" value="<?= old('judul_buku', $dataBuku['judul_buku']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('judul_buku') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control <?= $validation->hasError('penerbit') ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit" value="<?= old('penerbit', $dataBuku['penerbit']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('penerbit') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control <?= $validation->hasError('penulis') ? 'is-invalid' : '' ?>" id="penulis" name="penulis" value="<?= old('penulis', $dataBuku['penulis']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('penulis') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                             <div class="col-sm-5">
                                 <input type="text" class="form-control <?= $validation->hasError('tahun_terbit') ? 'is-invalid' : '' ?>" id="tahun_terbit" name="tahun_terbit" value="<?= old('tahun_terbit', $dataBuku['tahun_terbit']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('tahun_terbit') ?>
                                 </div>
                             </div>
                             <label for="diskon" class="col-sm-2 col-form-label">diskon</label>
                             <div class="col-sm-3">
                                 <input type="text" class="form-control <?= $validation->hasError('diskon') ? 'is-invalid' : '' ?>" id="diskon" name="diskon" value="<?= old('diskon', $dataBuku['diskon']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('diskon') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                             <div class="col-sm-5">
                                 <input type="text" class="form-control <?= $validation->hasError('jumlah') ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah', $dataBuku['jumlah']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('jumlah') ?>
                                 </div>
                             </div>
                             <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                             <div class="col-sm-3">
                                 <input type="text" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga', $dataBuku['harga']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('harga') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                             <div class="col-sm-5">
                                 <input type="hidden" name="gambarlama" value="<?= $dataBuku['gambar'] ?>">
                                 <input type="file" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : '' ?>" id="gambar" name="gambar" value="<?= old('gambar') ?>" onchange="previewImage()">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('gambar') ?>
                                 </div>
                                 <div class="col-sm-6 mt-2">
                                     <img src="/img/<?= $dataBuku['gambar'] == "" ? "default.jpg" : $dataBuku['gambar'] ?>" alt="" class="img-thumbnail img-preview">
                                 </div>
                             </div>
                             <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                             <div class="col-sm-3">
                                 <select class="form-control" name="id_kategori">
                                     <?php
                                        foreach ($tbl_kategori as $kategori) : ?>
                                         <option value="<?= $kategori['id_kategori'] ?>" <?= $kategori['id_kategori'] == $dataBuku['id_kategori'] ? 'selected' : '' ?>><?= $kategori['nama_kategori'] ?></option>
                                     <?php endforeach ?>
                                 </select>
                             </div>
                         </div>
                         <div class="d-grid gap-2 d-md-block">
                             <button type="submit" class="btn btn-primary">Perbaharui</button>
                             <a class="btn btn-danger" href="/book">Batal</a>
                         </div>
                     </form>
                     <!-- end form -->
                 </div>
             </div>
         </div>
     </main>
     <?= $this->endsection() ?>