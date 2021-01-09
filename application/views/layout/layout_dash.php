<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo base_url("assets"); ?>/images/logo/jdih_hitam.ico">
    <title>JDIH | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/fontawesome-free/css/all.min.css">

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/jqvmap/jqvmap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>dist/css/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/daterangepicker/daterangepicker.css">

    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/summernote/summernote-bs4.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <!-- Sweetalert CSS -->
    <link href="<?php echo base_url("assets") ?>/dashboard/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <!-- Croppie Master -->
    <link href="<?php echo base_url("assets") ?>/dashboard/plugins/croppie-master/croppie.css" rel="stylesheet">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/dashboard/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets") ?>/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/dashboard/") ?>dist/css/custom-self.css">

    <style>
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="loading">
        <div class="jumping-dots-loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <span class="nav-link" style="color: #343a40 !important;"><?= $group_name; ?></span>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" onclick="goBack();" style="cursor: pointer;"><i class="fas fa-undo"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="sidebar" data-slide="true" id="sidebar-right" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?php echo base_url(); ?>" class="brand-link">
                <img src="<?php echo base_url("assets/") ?>images/logo/jdih.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">JDIH</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url("assets/dashboard/") ?>dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <span class="d-block" style="color: #28a745 !important; font-weight: 500;">
                            <?php echo $this->session->userdata("full_name"); ?>
                            <br>
                            <a href="<?php echo base_url("Login/logout"); ?>"><small>(Logout)</small></a>
                        </span>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-header">MENU</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url("Dashboard"); ?>" class="nav-link <?php echo ($nav == NAVC_DASHBOARD) ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <?php if ($group == PERM_ADM) { ?>
                            <li class="nav-item has-treeview <?php echo ($active == NAVP_MENU_WEB) ? "menu-open" : ""; ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p> Menu Web <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Menu/text_jalan"); ?>" class="nav-link <?php echo ($nav == NAVC_MENU_WEB_1) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Text Berjalan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Setting/profil"); ?>" class="nav-link <?php echo ($nav == NAVC_MENU_WEB_2) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Profil</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Setting/agenda"); ?>" class="nav-link <?php echo ($nav == NAVC_MENU_WEB_3) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kegiatan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Setting/tupoksi"); ?>" class="nav-link <?php echo ($nav == NAVC_MENU_WEB_4) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tupoksi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview <?php echo ($active == NAVP_PENGATURAN) ? "menu-open" : ""; ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Pengaturan <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("User"); ?>" class="nav-link <?php echo ($nav == NAVC_PENGATURAN_1) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Setting/lemari"); ?>" class="nav-link <?php echo ($nav == NAVC_PENGATURAN_2) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lemari Arsip</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if (
                            $group == PERM_ADM
                            or $group == PERM_KABAG
                            or $group == PERM_DOKUM
                            or $group == PERM_PERUNDANGAN
                            or $group == PERM_BANKUM
                        ) { ?>
                            <li class="nav-item has-treeview <?php echo ($active == NAVP_DOKUM) ? "menu-open" : ""; ?>">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Dokumentasi Hukum <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Prokum?tipe=" . strtolower(PROK_DAERAH)) ?>" class="nav-link <?php echo ($nav == NAVC_DOKUM_1) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Prokum Daerah</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Prokum?tipe=" . strtolower(PROK_PUSAT)) ?>" class="nav-link <?php echo ($nav == NAVC_DOKUM_2) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Prokum Pusat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Prokum?tipe=" . strtolower(PROK_NON)) ?>" class="nav-link <?php echo ($nav == NAVC_DOKUM_3) ? "active" : ""; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Non Prokum</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if (!in_array($group, array(PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) { ?>
                            <?php if ($group != PERM_RESEPSIONIS) { ?>
                                <li class="nav-item has-treeview <?php echo ($active == NAVP_PROKUM) ? "menu-open" : ""; ?>">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon far fa-envelope"></i>
                                        <p>
                                            <?php echo (in_array($group, array(PERM_KABAG, PERM_PERUNDANGAN, PERM_DOKUM, PERM_BANKUM)) ? "Lembar Kerja" : "Produk Hukum") ?> <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url("Pengajuan"); ?>" class="nav-link <?php echo ($nav == NAVC_PROKUM_1) ? "active" : ""; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Pengajuan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <?php if ($group != PERM_SKPD) { ?>
                                                <a href="<?php echo base_url("Pengajuan/penyusunan_list?pengajuan=a"); ?>" class="nav-link <?php echo ($nav == NAVC_PROKUM_2) ? "active" : ""; ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Penyusunan</p>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url("Pengajuan/penyusunan_report_list?pengajuan=a"); ?>" class="nav-link <?php echo ($nav == NAVC_REPORT_2) ? "active" : ""; ?>">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Penyusunan</p>
                                                </a>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url("Pengajuan"); ?>" class="nav-link <?php echo ($nav == NAVC_PROKUM_1) ? "active" : ""; ?>">
                                        <i class="fas far fa-envelope nav-icon"></i>
                                        <p>Lembar Kerja</p>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($group != PERM_SKPD) { ?>
                                <li class="nav-item has-treeview <?php echo ($active == NAVP_REPORT) ? "menu-open" : ""; ?>">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-border-all"></i>
                                        <p>
                                            Report <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url("Pengajuan/report"); ?>" class="nav-link <?php echo ($nav == NAVC_REPORT_1) ? "active" : ""; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Pengajuan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo base_url("Pengajuan/penyusunan_report_list?pengajuan=a"); ?>" class="nav-link <?php echo ($nav == NAVC_REPORT_2) ? "active" : ""; ?>">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Penyusunan</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url("Pengajuan/penyusunan_list?pengajuan=a"); ?>" class="nav-link <?php echo ($nav == NAVC_REPORT_1) ? "active" : ""; ?>">
                                    <i class="fas far fa-envelope nav-icon"></i>
                                    <p>Lembar Paraf</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url("Pengajuan/penyusunan_report_list?pengajuan=a"); ?>" class="nav-link <?php echo ($nav == NAVC_REPORT_2) ? "active" : ""; ?>">
                                    <i class="fas fas fa-border-all nav-icon"></i>
                                    <p>Daftar Penyusunan</p>
                                </a>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a href="<?php echo base_url("Konsultasi/konsultasi_list"); ?>" class="nav-link <?php echo ($nav == NAVC_KONSULTASI) ? "active" : ""; ?>">
                                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                <p>Konsultasi</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <?php
        if (isset($_view) && $_view)
            $this->load->view($_view);

        if (isset($_aside) && $_aside)
            $this->load->view($_aside);
        ?>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/jquery/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- ChartJS -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/chart.js/Chart.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/sparklines/sparkline.js"></script>

    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/jquery-knob/jquery.knob.min.js"></script>

    <!-- InputMask -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/inputmask/jquery.inputmask.bundle.js"></script>
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/moment/moment.min.js"></script>

    <!-- Summernote -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/summernote/summernote-bs4.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo base_url("assets/dashboard/") ?>dist/js/adminlte.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url("assets/dashboard/") ?>dist/js/demo.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!--Sweetalert-->
    <script src="<?php echo base_url("assets") ?>/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!--PDF Object-->
    <script src="<?php echo base_url("assets") ?>/js/pdfobject.min.js"></script>

    <!-- Croppie Master -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/croppie-master/croppie.min.js"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url("assets/dashboard/") ?>plugins/select2/js/select2.full.min.js"></script>

    <!-- Custom Self JS -->
    <script src="<?php echo base_url("assets/dashboard/") ?>dist/js/custom-self.js"></script>

    <script>
        function ucwords(str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($result) {
                return $result.toUpperCase();
            });
        }
    </script>

    <?php
    if (isset($_js) && $_js)
        $this->load->view($_js);
    ?>
</body>

</html>