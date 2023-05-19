<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 5rem;
            margin: 0;
            line-height: 1;
            color: #f15b2a;
        }

        p {
            font-size: 1.5rem;
            margin: 1rem 0;
            color: #444;
        }

        button {
            background-color: #f15b2a;
            color: #fff;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #d44c28;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! Halaman yang kamu cari tidak ditemukan.</p>
        <button onclick="window.history.back();">Kembali ke Halaman Sebelumnya</button>
    </div>
</body>

</html>