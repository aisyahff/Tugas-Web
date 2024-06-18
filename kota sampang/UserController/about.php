<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <!-- Favicon (using Bootstrap Icons) -->
    <link rel="icon" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/icons/apple.svg" type="image/svg+xml">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8bbd0;
        }

        .card-title:hover,
        .carousel-item img:hover,
        .header-title:hover,
        .header-subtitle:hover {
            color: #ffc0cb;
            transform: scale(1.05);
            transition: transform 0.3s, color 0.3s;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e91e63;">
        <div class="container">
            <a class="navbar-brand" href="bloghome.php" style="color: white;">Kota Sampang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="bloghome.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="../AdminController/login.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-1 border-bottom mb-1" style="background-color: #f8bbd0;">
        <div class="container">
            <div class="text-center my-3">
                <h1 class="fw-bolder hover-text">Tentang Website Kami</h1>
                <p class="lead mb-0 hover-text">Kami menyediakan berbagai artikel menarik dan informatif untuk Anda</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container flex-grow-1">
        <div class="row justify-content-center align-items-center">
            <!-- Kolom untuk gambar -->
            <div class="col-lg-4 mb-4 mb-lg-3">
                <img src="http://localhost/kota%20sampang/img/about.png" alt="Tentang Kami" class="img-fluid rounded hover-zoom">
            </div>
            <!-- Kolom untuk teks -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body text-center"> <!-- Menyelaraskan teks ke tengah -->
                        <h2 class="card-title">Tentang Kami</h2>
                        <p class="card-text">Selamat datang di website Kota Sampang! Kami hadir untuk menyajikan informasi terbaru dan menarik tentang segala hal yang berkaitan dengan kota tercinta ini. Dengan komitmen yang tinggi, kami berusaha menyuguhkan konten berkualitas dan bermanfaat bagi seluruh warga dan pengunjung.</p>
                        <p class="card-text">Tim penulis kami yang berpengalaman dan berdedikasi selalu memastikan setiap artikel ditulis dengan cermat dan teliti. Kami membahas berbagai topik mulai dari hot news, destinasi wisata, kuliner, festival yang ada di Kota Sampang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5" style="background-color: #e91e63;">
        <div class="container text-center text-white">
            <p class="m-0">&copy; Kota Sampang </p>
            <div class="mt-3">
                <a href="https://www.instagram.com/aaiseeee?igsh=M242azIyOGNtcjEy" target="_blank" class="text-white me-3">
                    <i class="bi bi-instagram"></i> Instagram
                </a>
                <a href="mailto:aisyahnurff@gmail.com" class="text-white me-3">
                    <i class="bi bi-envelope-fill"></i> Email
                </a>
                <a href="https://wa.me/6281332772896" target="_blank" class="text-white">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>