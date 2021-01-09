<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">&nbsp;</div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo base_url("Konsultasi/tambah") ?>" class="btn btn-primary btn-block mb-3">Pesan Baru</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">

                            <?php if ($nav == 1) { ?>

                                <li class="nav-item active">
                                    <a href="<?php echo base_url("Konsultasi") ?>" class="nav-link nav-masuk bg-info">
                                        <i class="fas fa-inbox"></i> Pesan Masuk
                                        <span class="badge bg-primary float-right"></span>
                                    </a>
                                </li>

                            <?php } else { ?>

                                <li class="nav-item active">
                                    <a href="<?php echo base_url("Konsultasi") ?>" class="nav-link nav-masuk">
                                        <i class="fas fa-inbox"></i> Pesan Masuk
                                        <span class="badge bg-primary float-right"></span>
                                    </a>
                                </li>

                            <?php }

                            if ($nav == 2) { ?>

                                <li class="nav-item">
                                    <a href="<?php echo base_url("Konsultasi/sent") ?>" class="nav-link nav-sent bg-info">
                                        <i class="far fa-envelope"></i> Terkirim
                                        <span class="badge bg-primary float-right"></span>
                                    </a>
                                </li>

                            <?php } else { ?>

                                <li class="nav-item">
                                    <a href="<?php echo base_url("Konsultasi/sent") ?>" class="nav-link nav-sent">
                                        <i class="far fa-envelope"></i> Terkirim
                                        <span class="badge bg-primary float-right"></span>
                                    </a>
                                </li>

                                <?php }

                            // tab for kabag session
                            $usr_kabag = $this->session->userdata("user_id");
                            if ($usr_kabag == 5) {
                                if ($nav == 3) { ?>

                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Konsultasi/permite_sent/") ?>" class="nav-link bg-info">
                                            <i class="far fa-envelope"></i> Izinkan Pesan
                                            <span class="badge bg-primary float-right"></span>
                                        </a>
                                    </li>

                                <?php } else { ?>

                                    <li class="nav-item">
                                        <a href="<?php echo base_url("Konsultasi/permite_sent/") ?>" class="nav-link">
                                            <i class="far fa-envelope"></i> Izinkan Pesan
                                            <span class="badge bg-primary float-right"></span>
                                        </a>
                                    </li>

                                <?php }
                            }

                            if ($nav == 4) { ?>

                                <li class="nav-item">
                                    <a href="<?php echo base_url("Konsultasi/draft") ?>" class="nav-link bg-info">
                                        <i class="far fa-file-alt"></i> Pesan Tersimpan
                                        <span class="badge bg-primary float-right"></span>
                                    </a>
                                </li>

                            <?php } else { ?>

                                <li class="nav-item">
                                    <a href="<?php echo base_url("Konsultasi/draft") ?>" class="nav-link">
                                        <i class="far fa-file-alt"></i> Pesan Tersimpan
                                        <span class="badge bg-primary float-right"></span>
                                    </a>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-body" style="padding: 0.5rem;">
                        <div class="col-md-12">
                            <table id="konsultasi_tab" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="row-number">#</th>
                                        <th>Judul</th>
                                        <th class="row-aksi">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>