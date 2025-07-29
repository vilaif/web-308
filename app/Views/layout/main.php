<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title><?= esc($title['title'] ?? 'Default Title') ?></title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/font-awesome.css'); ?>">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/templatemo-hexashop.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/owl-carousel.css');  ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/lightbox.css'); ?>">
    <!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->

    <style>
    /* .header-sticky {
        display: flex;
        align-items: center;
        justify-content: center;
    } */

    /* .logo-img {
        max-width: 140px;
        
        height: 200px;
    } */
    /* .header-sticky {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 50px 20px;
        background: #fff;
    } */

    .logo-img {
        /* max-width: 200px; */
        max-height: 100px;
        width: auto;
        /* height: auto;
        padding: 15px; */
        /* Biarkan tinggi menyesuaikan proporsi gambar */
    }

    @media (max-width: 768px) {
        .logo-img {
            max-height: 40px;
        }
    }

    .main-nav {
        /* display: flex; */
        gap: 10px;
        /* Beri jarak antar menu */
    }

    .main-nav ul {
        list-style: none;
        /* display: flex; */
        gap: 15px;
        padding: 0;
        margin: 0;
    }

    /* .main-nav ul li {
        display: inline-block;
    } */

    .main-nav ul li a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        padding: 0px 15px;
        transition: color 0.3s;
    }

    .main-nav ul li a:hover {
        color: #ff6600;
        /* Warna saat hover */
    }

    .footer-logo {
        max-height: 100px;
        /* atau sesuaikan dengan tinggi footer */
        width: auto;
        /* display: block; */
        /* margin: 0 auto; */
        /* center horizontal jika diperlukan */
    }
    </style>



</head>

<body>

    <?= $this->include('layout/header'); ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer'); ?>



    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery-2.1.0.min.js') ?>"></script>

    <!-- Bootstrap -->
    <script src="<?= base_url('assets/js/popper.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

    <!-- Plugins -->
    <script src="<?= base_url('assets/js/owl-carousel.js') ?>"></script>
    <script src="<?= base_url('assets/js/accordions.js') ?>"></script>
    <script src="<?= base_url('assets/js/datepicker.js') ?>"></script>
    <script src="<?= base_url('assets/js/scrollreveal.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.counterup.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/imgfix.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/slick.js') ?>"></script>
    <script src="<?= base_url('assets/js/lightbox.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.js') ?>"></script>

    <!-- Global Init -->
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>


    <script>
    $(function() {
        var selectedClass = "";
        $("p").click(function() {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function() {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });
    </script>

</body>

</html>