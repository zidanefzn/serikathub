<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SerikatHub | <?= $data['judul']; ?></title>
    <link rel="website icon" type="png" href="<?= BASEURL ?>/img/web-icon.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="<?= BASEURL ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="<?= BASEURL ?>/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= BASEURL ?>/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="sidebar pe-4 pb-3">
            <nav class="navbar d-flex justify-content-center bg-light navbar-light">
                <a href="<?= BASEURL ?>/dashboard" class="navbar-brand mx-4 mb-3">
                    <img src="<?= BASEURL ?>/img/logo.png" alt="KEMNAKER" class="d-none d-lg-block" width="90">
                </a>
                <div class="navbar-nav w-100">
                    <a href="<?= BASEURL ?>/dashboard" class="nav-item nav-link"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
                    <a href="<?= BASEURL ?>/recap" class="nav-item nav-link"><i class="fa-solid fa-database me-2"></i>Rekapitulasi</a>
                    <a href="<?= BASEURL ?>/confederation" class="nav-item nav-link"><i class="fa-solid fa-users me-2"></i>Konfederasi</a>
                    <a href="<?= BASEURL ?>/federation" class="nav-item nav-link"><i class="fa-solid fa-people-group me-2"></i>Federasi</a>
                    <a href="<?= BASEURL ?>/spsb" class="nav-item nav-link"><i class="fa-solid fa-user-group me-2"></i>SP/SB</a>
                </div>  
            </nav>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-2">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>