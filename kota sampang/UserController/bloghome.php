<?php
include '../connection.php'; // Include the connection file

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Set up pagination variables
$non_featured_posts_per_page = 4;
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($current_page - 1) * $non_featured_posts_per_page;

// Adjust the query to include search functionality and pagination
if (!empty($search)) {
    $query = "SELECT artikel.*, kategori.nama_kategori 
              FROM artikel 
              JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
              WHERE artikel.judul LIKE '%$search%' 
              ORDER BY artikel.tanggal DESC 
              LIMIT $offset, $non_featured_posts_per_page";
} else {
    $query = "SELECT artikel.*, kategori.nama_kategori 
              FROM artikel 
              JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
              ORDER BY artikel.tanggal DESC 
              LIMIT $offset, $non_featured_posts_per_page";
}

$result = $conn->query($query);

// Query to get the total number of non-featured posts for pagination
$total_non_featured_query = "SELECT COUNT(*) as total 
                             FROM artikel 
                             WHERE judul LIKE '%$search%'";
$total_non_featured_result = $conn->query($total_non_featured_query);
$total_non_featured = $total_non_featured_result->fetch_assoc()['total'];
$total_pages = ceil($total_non_featured / $non_featured_posts_per_page);

// Query to get categories
$query_categories = "SELECT * FROM kategori";
$result_categories = $conn->query($query_categories);
$categories = [];
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>
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

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #e91e63;">
        <!-- tempat ngubah warna navbar atas -->
        <div class="container">
            <a class="navbar-brand" href="bloghome.php" style="color: white;">Kota Sampang </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="bloghome.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="bloghome.php">Blog</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="../AdminController/login.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-1 border-bottom mb-1" style="background-color: #f8bbd0;">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder header-title">SELAMAT DATANG DI WEBSITE KOTA SAMPANG</h1>
                <p class="lead mb-0 header-subtitle"> Wajah Kota Sampang</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <?php
                $featured = true;
                $post_counter = 0;

                // Only show featured post on the first page
                if ($current_page == 1) {
                ?>
                    <!-- Featured blog post-->
                    <div id="featuredCarousel" class="carousel slide card mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $featured_query = "SELECT artikel.*, kategori.nama_kategori 
                                               FROM artikel 
                                               JOIN kategori ON artikel.id_kategori = kategori.id_kategori 
                                               ORDER BY artikel.tanggal DESC 
                                               LIMIT 3"; // Fetching 3 latest articles for the carousel
                            $featured_result = $conn->query($featured_query);
                            $active_class = 'active';
                            if ($featured_result->num_rows > 0) {
                                while ($featured_row = $featured_result->fetch_assoc()) {
                            ?>
                                    <div class="carousel-item <?= $active_class ?>">
                                        <a href="blogpost.php?id=<?= $featured_row['id_artikel'] ?>">
                                            <img class="d-block w-100" src="data:image/jpeg;base64,<?= base64_encode($featured_row['gambar']) ?>" alt="..." height="350" />
                                        </a>
                                        <div class="card-body">
                                            <div class="small text-muted"><?= ($featured_row['tanggal']) ?></div>
                                            <h2 class="card-title"><?= $featured_row['judul'] ?></h2>
                                            <p class="card-text"><?= substr($featured_row['isi'], 0, 200) ?>...</p>
                                            <a class="btn btn-secondary" href="blogpost.php?id=<?= $featured_row['id_artikel'] ?>">Read more →</a>
                                        </div>
                                    </div>
                            <?php
                                    $active_class = ''; // After the first item, no other item should be active
                                }
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#featuredCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#featuredCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                <?php
                }
                ?>
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) : ?>
                            <div class="col-lg-6">
                                <!-- Blog post-->
                                <div id="carouselNonFeatured<?= $row['id_artikel'] ?>" class="carousel slide card mb-4" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <a href="blogpost.php?id=<?= $row['id_artikel'] ?>">
                                                <img class="d-block w-100" src="data:image/jpeg;base64,<?= base64_encode($row['gambar']) ?>" alt="..." height="350" />
                                            </a>
                                        </div>
                                        <!-- Add more carousel items here if there are multiple images for a single post -->
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselNonFeatured<?= $row['id_artikel'] ?>" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselNonFeatured<?= $row['id_artikel'] ?>" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?= ($row['tanggal']) ?></div>
                                        <h2 class="card-title h4"><?= $row['judul'] ?></h2>
                                        <p class="card-text"><?= substr($row['isi'], 0, 100) ?>...</p>
                                        <a class="btn btn-secondary" href="blogpost.php?id=<?= $row['id_artikel'] ?>">Read more →</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $post_counter++;
                            if ($post_counter % 2 == 0) :
                                echo '</div><div class="row">';
                            endif;
                        endwhile;
                        if ($post_counter % 2 != 0) :
                            echo '</div>'; // Close the last row if not closed
                        endif;
                    } else {
                        echo "<p class='text-center'>No articles found matching your search criteria.</p>";
                    }
                    ?>
                </div>
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <?php if ($current_page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $current_page - 1 ?><?php if (!empty($search)) echo '&search=' . $search; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?= $i ?><?php if (!empty($search)) echo '&search=' . $search; ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($current_page < $total_pages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $current_page + 1 ?><?php if (!empty($search)) echo '&search=' . $search; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <form action="bloghome.php" method="get">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." name="search" value="<?= htmlentities($search) ?>" />
                                <button class="btn btn-secondary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($categories as $category) : ?>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="category.php?id=<?= $category['id_kategori'] ?>"><?= htmlspecialchars($category['nama_kategori']) ?></a></li>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        // Activate carousel
        document.querySelectorAll('.carousel').forEach(carousel => {
            carousel.addEventListener('slide.bs.carousel', event => {
                // Add hover effect on slide change
                const img = event.target.querySelector('.carousel-item.active img');
                if (img) {
                    img.addEventListener('mouseover', () => {
                        img.style.transform = 'scale(1.05)';
                    });
                    img.addEventListener('mouseout', () => {
                        img.style.transform = 'scale(1)';
                    });
                }
            });
        });
    </script>
</body>

</html>