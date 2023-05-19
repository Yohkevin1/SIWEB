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
                     <form action="<?= base_url('komik-update/' . $dataKomik['komik_id']) ?>" method="post" enctype="multipart/form-data">
                         <?= csrf_field() ?>
                         <div class="mb-3 row">
                             <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>" id="judul" name="judul" value="<?= old('judul', $dataKomik['judul']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('judul') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control <?= $validation->hasError('penulis') ? 'is-invalid' : '' ?>" id="penulis" name="penulis" value="<?= old('penulis', $dataKomik['penulis']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('penulis') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="tahun_rilis" class="col-sm-2 col-form-label">Tahun Rilis</label>
                             <div class="col-sm-5">
                                 <input type="text" class="form-control <?= $validation->hasError('tahun_rilis') ? 'is-invalid' : '' ?>" id="tahun_rilis" name="tahun_rilis" value="<?= old('tahun_rilis', $dataKomik['tahun_rilis']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('tahun_rilis') ?>
                                 </div>
                             </div>
                             <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                             <div class="col-sm-3">
                                 <input type="text" class="form-control <?= $validation->hasError('stock') ? 'is-invalid' : '' ?>" id="stock" name="stock" value="<?= old('stock', $dataKomik['stock']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('stock') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                             <div class="col-sm-5">
                                 <input type="text" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga', $dataKomik['harga']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('harga') ?>
                                 </div>
                             </div>
                             <label for="diskon" class="col-sm-2 col-form-label">diskon</label>
                             <div class="col-sm-3">
                                 <input type="text" class="form-control <?= $validation->hasError('diskon') ? 'is-invalid' : '' ?>" id="diskon" name="diskon" value="<?= old('diskon', $dataKomik['diskon']) ?>">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('diskon') ?>
                                 </div>
                             </div>
                         </div>
                         <div class="mb-3 row">
                             <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                             <div class="col-sm-5">
                                 <input type="hidden" name="coverLama" value="<?= $dataKomik['cover'] ?>">
                                 <input type="file" class="form-control <?= $validation->hasError('cover') ? 'is-invalid' : '' ?>" id="cover" name="cover" value="<?= old('cover') ?>" onchange="previewCover()">
                                 <div id="validationServer03Feedback" class="invalid-feedback">
                                     <?= $validation->getError('cover') ?>
                                 </div>
                                 <div class="col-sm-6 mt-2">
                                     <img src="/img/<?= $dataKomik['cover'] == "" ? "default.jpg" : $dataKomik['cover'] ?>" alt="" class="img-thumbnail img-preview">
                                 </div>
                             </div>
                             <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                             <div class="col-sm-3">
                                 <select class="form-control" name="id_kategori">
                                     <?php foreach ($tbl_kategori as $kategori) : ?>
                                         <option value="<?= $kategori['id_kategori'] ?>" <?= $kategori['id_kategori'] == $dataKomik['id_kategori'] ? 'selected' : '' ?>><?= $kategori['nama_kategori'] ?></option>
                                     <?php endforeach ?>
                                 </select>
                             </div>
                         </div>
                         <div class="d-grid gap-2 d-md-block">
                             <button type="submit" class="btn btn-primary">Perbaharui</button>
                             <a class="btn btn-danger" href="/komik">Batal</a>
                         </div>
                     </form>
                     <!-- end form -->
                 </div>
             </div>
         </div>
     </main>
     <?= $this->endsection() ?>