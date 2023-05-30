<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= strtoupper($title) ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Pengelolaan <?= $title ?></li>
            </ol>
            <!-- Alert -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashdata('warning')) : ?>
                <div class="alert alert-warning" role="alert">
                    <?= session()->getFlashdata('warning'); ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-error" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif ?>
            <!--  -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List <?= $title ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label class="col-form-label">Tanggal</label>
                            <input type="text" value="<?= date('d/m/y') ?>" disabled>
                        </div>
                        <div class="col">
                            <label class="col-form-label">Username</label>
                            <input type="text" value="<?= session()->username ?>" disabled>
                        </div>
                        <div class="col">
                            <label class="col-form-label">Supplier: </label>
                            <input type="text" id="nama-supp" disabled>
                            <input type="hidden" id="id-supp">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" data-bs-target="#Komik" data-bs-toggle="modal">Pilih Produk</button>
                            <button class="btn btn-dark" data-bs-target="#Supplier" data-bs-toggle="modal">Cari Supplier</button>
                        </div>
                    </div>
                    <table class="table table-striped table-hover mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <!-- <th>Diskon</th> -->
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="detail_cart">
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <label class="col-form-label">Total bayar</label>
                                <h1><span id="spanTotal">0</span></h1>
                            </div>
                            <div class="col-4">
                                <div class="mb-3 row">
                                    <label class="col-4 col-form-label">Nominal</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="nominal" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-4 col-form-label">Kembalian</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="kembalian" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grip gap-3 d-md-felx justify-content-md-end">
                            <button onclick="bayar()" class="btn btn-success me-md-2" type="button"> Proses Bayar</button>
                            <button onclick="location.reload()" class="btn btn-primary" type="button"> Transaksi Baru</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -->
        </div>
    </main>
    <?= $this->include('Pembelian/komik') ?>
    <?= $this->include('Pembelian/supplier') ?>
    <script>
        function load() {
            $('#detail_cart').load("<?= base_url('beli/load') ?>");
            $('#spanTotal').load("<?= base_url('beli/gettotal') ?>");
        }
        $(document).ready(function() {
            load();
        });

        //uabh jumlah item
        $(document).on('click', '.ubah_cart', function() {
            var row_id = $(this).attr("id");
            var qty = $(this).attr("qty");
            $('#rowid').val(row_id);
            $('#qty').val(qty);
            $('#Ubah').modal('show');
        });

        //hapus cart
        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?= base_url('beli') ?>/" + row_id,
                method: "DELETE",
                success: function(data) {
                    // console.log(data);S
                    load();
                }
            });
        });

        function bayar() {
            var nominal = $('#nominal').val();
            var idsupp = $('#id-supp').val();
            $.ajax({
                url: "<?= base_url('beli/bayar') ?>",
                method: "POST",
                data: {
                    'nominal': nominal,
                    'id-supp': idsupp
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    swal({
                        title: result.msg,
                        icon: result.status ? "success" : "error",
                    });
                    // alert(result.msg);
                    load();
                    $('#nominal').val("");
                    $('#kembalian').val(result.data.kembalian);
                    // setTimeout(function() {
                    //     location.reload('');
                    // }, 2000); // Refresh halaman setelah 5 detik (5000 milidetik)
                }
            })
        }
    </script>
    <?= $this->endsection() ?>