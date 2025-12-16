<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar {
            background-color: #0d47a1;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        footer {
            margin-top: 50px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">SIAKAD PMB</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/prodi">Prodi</a>
            <a class="nav-link" href="/pendaftar">Pendaftar</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<footer>
    <hr>
    <p>© {{ date('Y') }} Sistem PMB Online</p>
</footer>

</body>
</html>
