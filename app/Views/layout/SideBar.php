<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="/datadiri">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                        Tugas Container
                    </a>
                    <a class="nav-link" href="/tugas2">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check fa-fade"></i></div>
                        Tugas 2
                    </a>
                    <a class="nav-link" href="/mahasiswa">
                        <div class="sb-nav-link-icon"><i class="fa-sharp fa-solid fa-graduation-cap fa-bounce"></i></div>
                        Data Mahasiswa
                    </a>

                    <div class="sb-sidenav-menu-heading">Transaksi</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Penjualan" aria-expanded="false" aria-controls="Penjualan">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Penjualan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Penjualan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('jual') ?>">Transaksi</a>
                            <a class="nav-link" href="<?= base_url('jual/laporan') ?>">Laporan</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Pembelian" aria-expanded="false" aria-controls="Pembelian">
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Pembelian
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Pembelian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('beli') ?>">Transaksi</a>
                            <a class="nav-link" href="<?= base_url('beli/laporan') ?>">Laporan</a>
                        </nav>
                    </div>

                    <div class="sb-sidenav-menu-heading">Guided & Unguided</div>

                    <?php if (session()->role == "Admin" || session()->role == "Owner" || session()->role == "Karyawan" || session()->role == "Manajer") : ?>
                        <a class="nav-link" href="/book">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Data Buku
                        </a>
                    <?php endif ?>
                    <?php if (session()->role == "Admin" || session()->role == "Owner" || session()->role == "Karyawan" || session()->role == "Manajer") : ?>
                        <a class="nav-link" href="/komik">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-atlas fa-beat"></i></div>
                            Data Komik
                        </a>
                    <?php endif ?>
                    <?php if (session()->role == "Admin" || session()->role == "Owner" || session()->role == "Manajer") : ?>
                        <a class="nav-link" href="/customer">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                            Data Customer
                        </a>
                    <?php endif ?>
                    <?php if (session()->role == "Owner" || session()->role == "Manajer") : ?>
                        <a class="nav-link" href="/supplier">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card-clip"></i></div>
                            Data Supplier
                        </a>
                    <?php endif ?>
                    <?php if (session()->role == "Admin" || session()->role == "Owner") : ?>
                        <a class="nav-link" href="/user">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user" style="color: #ba270d;"></i></div>
                            Data User
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Yohanes Kevin Wahyu U
            </div>
        </nav>
    </div>