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
                    <!-- Laporan -->
                    <a target="_blank" class="btn btn-primary mb-3" type="button" href="/jual/exportPDF">
                        Export PDF</a>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nota</th>
                                <th>Tanggal Transaksi</th>
                                <th>User</th>
                                <th>Customer</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($laporan as $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['sale_id'] ?></td>
                                    <td><?= date("d/m/Y H:i:s", strtotime($value['tgl_transaksi']))  ?></td>
                                    <td><?= $value['firstname'] ?> <?= $value['lastname'] ?></td>
                                    <td><?= $value['nama_cust'] ?></td>
                                    <td><?= number_to_currency($value['Total'], 'IDR', 'id_ID', 2)  ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- -->
                </div>
            </div>
            <!-- -->
        </div>
    </main>
    <?= $this->endsection() ?>