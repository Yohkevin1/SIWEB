<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Diri</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: royalblue;
            color: #FFFFFF;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px #999999;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            width: 30%;
        }

        .value {
            width: 70%;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .row {
                flex-direction: column;
            }

            .label {
                width: 100%;
            }

            .value {
                width: 100%;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <header>
        <h1>Data Diri</h1>
    </header>
    <div class="text-center">
        <img src="/img/kepin.jpg" class="rounded" alt="...">
    </div> <br>
    <div class="accordion" id="accordionExample">
        <div class="container">
            <div class="row">
                <div class="label">Nama</div>
                <div class="value">Yohanes Kevin Wahyu Utama</div>
            </div>
            <div class="row">
                <div class="label">Umur</div>
                <div class="value">20 Tahun</div>
            </div>
            <div class="row">
                <div class="label">Alamat</div>
                <div class="value">Jl. Adhi Karya Pintu Air Rt.012 / Rw 05, Kedoya Selatan, Kebon Jeruk, Jakarta Barat</div>
            </div>
            <div class="row">
                <div class="label">Program Studi</div>
                <div class="value">Sistem Informasi</div>
            </div>
            <div class="row">
                <div class="label">No. HP</div>
                <div class="value">087755116033</div>
            </div>
            <div class="row">
                <div class="label">Jenis Kelamin</div>
                <div class="value">Pria &#x1F468;</div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>/assets/demo/chart-area-demo.js"></script>
        <script src="<?= base_url() ?>/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>/js/datatables-simple-demo.js"></script>
</body>

</html>