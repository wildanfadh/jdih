<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url("assets"); ?>/images/logo/jdih_hitam.ico">
    <title>Jaringan Dokumentasi dan Informasi Hukum (JDIH)</title>

    <link href="<?php echo base_url("assets") ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/slick-theme.css" rel="stylesheet" />
    <link href="<?php echo base_url("assets") ?>/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/component.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/style5.css" rel="stylesheet">

    <link href="<?php echo base_url("assets") ?>/css/demo.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/typography.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/shotcode.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/svg-icon.css" rel="stylesheet">

    <link href="<?php echo base_url("assets") ?>/css/color.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/css/datatables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets") ?>/dashboard/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <link href="<?php echo base_url("assets") ?>/css/Chart.min.css" rel="stylesheet">

    <style>
        .swal2-popup {
            font-size: 1.4rem !important;
        }

        table th,
        table td {
            text-align: center;
            vertical-align: middle !important;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 99999;
            padding-top: 10px;
            left: 0;
            top: 0;
            width: 100%;
            height: 105%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 10px;
            border: 1px solid #888;
            width: 90%;
            height: 90%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        #view_pdf {
            height: 90%;
        }

        .header {
            margin-bottom: 35px;
        }

        .table-aksi th:nth-last-child(1) {
            width: 70px !important;
        }

        ol.profil {
            padding-left: -1px;
        }

        ol.profil li {
            font-size: 16px;
        }

        .theam_btn {
            background-color: green !important;
        }

        .text-jalan,
        .text-jalan>a {
            color: #000000 !important;
        }

        ul#counterbox {
            color: white;
            font-weight: 400;
            margin: 0 20px;
        }
    </style>
</head>

<body class="demo-5">
    <div class="wrapper">
        <header>
            <div class="city_top_wrap hidden-sm hidden-xs">
                <div class="container-fluid">
                    <div class="city_top_logo">
                        <figure>
                            <h1><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url("assets") ?>/images/logo/jdih_hitam.png" alt="jdih"></a></h1>
                        </figure>
                    </div>
                    <div class="city_top_news">
                        <span>JDIH Kota Mojokerto</span>
                        <div class="city-news-slider">
                            <?php foreach ($text_jalan as $val) { ?>
                                <div>
                                    <p class="text-jalan"><?php echo $val["text"]; ?><i class="fa fa-star"></i></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="city_top_navigation menu-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <figure class="visible-xs-block visible-sm-block" id="logo-xs">
                                <h1><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url("assets") ?>/images/logo/jdih_hitam.png" alt="jdih"></a></h1>
                            </figure>
                            <div class="navigation">
                                <ul>
                                    <li><a href="<?php echo base_url("Daftar"); ?>">Produk Hukum</a>
                                        <ul class="child">
                                            <li><a href="<?php echo base_url("Daftar?jenis=perda"); ?>">Peraturan Daerah</a></li>
                                            <li><a href="<?php echo base_url("Daftar?jenis=perwali"); ?>">Peraturan Walikota</a></li>
                                            <li><a href="<?php echo base_url("Daftar?jenis=kepwali"); ?>">Keputusan Walikota</a></li>
                                            <li><a href="<?php echo base_url("Daftar?jenis=instruksi"); ?>">Instruksi Walikota</a></li>

                                            <li><a href="https://www.kemenkumham.go.id/">Peraturan Pusat</a></li>
                                            <li><a href="<?php echo base_url("Statistik"); ?>">Statistik Produk Hukum</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url("Pelayanan"); ?>">Pelayanan</a>
                                        <ul class="child">
                                            <li><a href="#">Bantuan Hukum</a>
                                                <ul class="child">
                                                    <li><a href="https://lsc.bphn.go.id/">Legal Smart Channel</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="<?php echo base_url("Pelayanan?p=1"); ?>" id="nav_konsultasi">Konsultasi Hukum</a></li>
                                            <li><a href="<?php echo base_url("Pelayanan?p=2") ?>" id="nav_pengajuan">Pengajuan Produk Hukum</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url("Profil"); ?>">Profil</a>
                                        <ul class="child">
                                            <li><a href="<?php echo base_url("Profil"); ?>">Profil</a></li>
                                            <li><a href="<?php echo base_url("Struktural"); ?>">Struktur Ogranisasi dan Tata Kerja (SOTK)</a></li>
                                            <li><a href="<?php echo base_url("Tupoksi"); ?>">Tugas Pokok Dan Fungsi</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url("Agenda"); ?>">Kegiatan</a></li>
                                    <li><a href="<?php echo base_url("Survei"); ?>">Survei</a></li>

                                </ul>
                            </div>

                            <div id="kode-responsive-navigation" class="dl-menuwrapper">
                                <button class="dl-trigger">Open Menu</button>
                                <ul class="dl-menu">

                                    <li><a class="active" href="<?php echo base_url(); ?>">Beranda</a></li>
                                    <li class="menu-item kode-parent-menu"><a href="<?php echo base_url("Daftar"); ?>">Produk Hukum</a>
                                        <ul class="dl-submenu">
                                            <li><a href="<?php echo base_url("Daftar?jenis=perda"); ?>">Peraturan Daerah</a></li>
                                            <li><a href="<?php echo base_url("Daftar?jenis=perwali"); ?>">Peraturan Walikota</a></li>
                                            <li><a href="<?php echo base_url("Daftar?jenis=kepwali"); ?>">Keputusan Walikota</a></li>
                                            <li><a href="<?php echo base_url("Daftar?jenis=instruksi"); ?>">Instruksi Walikota</a></li>

                                            <li><a href="https://www.kemenkumham.go.id/">Peraturan Pusat</a></li>
                                            <li><a href="<?php echo base_url("Statistik"); ?>">Statistik Produk Hukum</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="<?php echo base_url("Pelayanan"); ?>">Pelayanan</a>
                                        <ul class="dl-submenu">
                                            <li><a href="#">Bantuan Hukum</a>
                                                <ul class="dl-submenu">
                                                    <li><a href="https://lsc.bphn.go.id/">Legal Smart Channel</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="<?php echo base_url("Pelayanan?p=1"); ?>" id="nav_konsultasi">Konsultasi Hukum</a></li>
                                            <li><a href="<?php echo base_url("Pelayanan?p=2") ?>" id="nav_pengajuan">Pengajuan Produk Hukum</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="<?php echo base_url("Profil"); ?>">Profil</a>
                                        <ul class="dl-submenu">
                                            <li><a href="<?php echo base_url("Struktural"); ?>">Struktur Ogranisasi dan Tata Kerja (SOTK)</a></li>
                                            <li><a href="<?php echo base_url("Tupoksi"); ?>">Tugas Pokok Dan Fungsi</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item kode-parent-menu"><a href="<?php echo base_url("Agenda"); ?>">Kegiatan</a> </li>
                                    <li><a href="<?php echo base_url("Survei"); ?>">Survei</a></li>
                                    <li><a class="btn login" href="<?php echo base_url("Login"); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Masuk </a></li>
                                </ul>
                            </div>


                        </div>

                        <div class="col-md-3">
                            <a class="btn login hidden-sm hidden-xs" href="<?php echo base_url("Login"); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Masuk </a>
                        </div>

                    </div>
                </div>
            </div>

        </header>

        <?php
        if (isset($_view) && $_view)
            $this->load->view($_view);
        ?>

        <div id="modal_pdf" class="modal">
            <div class="modal-content">
                <div class="header">
                    <span class="close">&times;</span>
                </div>

                <div id="view_pdf"></div>
            </div>
        </div>

        <footer>
            <div class="widget_wrap overlay" style="padding-top: 50px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="widget_list">
                                <h4 class="widget_title">Alamat</h4>
                                <div class="widget_text">
                                    <ul>
                                        <li><a href="#">Jl. Gajah Mada No.145,</a></li>
                                        <li><a href="#">Mergelo, Balongsari, Kec. Magersari</a></li>
                                        <li><a href="#">Kota Mojokerto, Jawa Timur 61311</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="widget_list">
                                        <h4 class="widget_title">Produk Hukum</h4>
                                        <div class="widget_service">
                                            <ul>
                                                <li><a href="<?php echo base_url("Daftar?tipe=prokum_daerah"); ?>">Produk Hukum Daerah</a></li>
                                                <li><a href="<?php echo base_url("Daftar?tipe=prokum_pusat"); ?>">Produk Hukum Pusat</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="widget_list">
                                        <h4 class="widget_title">Pelayanan</h4>
                                        <div class="widget_service">
                                            <ul>
                                                <li><a href="#">Konsultasi Hukum</a></li>
                                                <li><a href="#">Lacak E-Legal DRAFTING</a></li>
                                                <li><a id="btn_promperda">Info E-Promperda</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget_list">
                                <h4 class="widget_title">Data</h4>
                                <div class="widget_service">
                                    <ul>
                                        <li><a href="<?php echo base_url("Profil"); ?>">Profil</a></li>
                                        <li><a href="<?php echo base_url("Survei"); ?>">Survei</a></li>
                                        <li><a href="">Total Pengunjung</a></li>
                                        <ul id="counterbox">
                                            <li id="counter"><?php echo $counter["total"]; ?></li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget_copyright">
                            <div class="col-md-3 col-sm-6">
                                <div class="widget_logo">
                                    <a href="#"><img src="<?php echo base_url("assets") ?>/images/logo/jdih.png" alt="" style="max-width: 20%;"></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="copyright_text">
                                    <p><span><?php echo date("Y"); ?> JDIH</span> Jaringan Dokumentasi dan Informasi Hukum Kota Mojokerto</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="city_top_social">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?php echo base_url("assets") ?>/js/jquery.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/slick.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/jquery.bxslider.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/js/modernizr.custom.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/jquery.dlmenu.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/downCount.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/waypoints.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/waypoints-sticky.js"></script>

    <script src="<?php echo base_url("assets") ?>/js/custom.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/datatables.bootstrap.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/js/pdfobject.min.js"></script>

    <script src="<?php echo base_url("assets") ?>/js/Chart.min.js"></script>

    <script>
        $(document).ready(function() {
            // $(document).on("click", "#btn_promperda", function() {
            //     $("#modal_pdf").show();
            //     var path = "<?php // echo base_url("uploads") . $latest_promperda; 
                                ?>";

            //     PDFObject.embed(path, "#view_pdf");
            // });
        });
    </script>

    <?php
    if (isset($_js) && $_js)
        $this->load->view($_js);
    ?>
</body>

</html>