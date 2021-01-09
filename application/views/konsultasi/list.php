<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-4">

                    <?php if ($group == PERM_SKPD) { ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dropdown float-sm-right mt-1">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="select-message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tampilkan Pesan
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="select-message">
                                        <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/konsultasi_list"); ?>">Semua Pesan</a>
                                        <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_pending"); ?>">Belum Tersedia</a>
                                        <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_proses_foropd"); ?>">Sedang Diproses</a>
                                        <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_done"); ?>">Sudah Tersedia</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-right mt-1">
                                    <a href="<?php echo base_url("Konsultasi/addkonsul") ?>" class="btn btn-primary btn-sm mb-3">Tambah Konsultasi</a>
                                </div>
                            </div>
                        </div>


                    <?php } else { ?>
                        <div class="dropdown float-right mt-1">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="select-message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tampilkan Pesan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="select-message">
                                <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/konsultasi_list"); ?>">Semua Pesan</a>
                                <?php if (!in_array($this->session->userdata("group"), array(PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA, PERM_RESEPSIONIS))) { ?>
                                    <!-- <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_forme"); ?>">Pesan Untuk Saya</a> -->
                                <?php } ?>
                                <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_pending"); ?>">Belum Dibalas</a>
                                <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_confir"); ?>">Sudah Dibalas</a>
                                <?php if ($this->session->userdata("group") == PERM_KABAG) { ?>
                                <?php } ?>
                                <!-- <a class="dropdown-item btn-sm" href="">Sudah Dibalas</a> -->
                                <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_done"); ?>">Dikonfirmasi</a>
                                <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_reject"); ?>">DiBatalkan</a>
                            </div>
                        </div>

                        <!-- <div class="col-md-2 text-right"> -->
                        <!-- <select class="custom-select custom-select-sm" id="daftar_select">
                            <option value="">Semua Pesan</option>
                            <option value="<?= BELUM_DIBALAS ?>">Belum Dibalas</option>
                            <option value="<?= SUDAH_DIBALAS ?>">Sudah Dibalas</option>
                            <option value="<?= KONFIRMASI_SELESAI ?>">Konfirmasi Selesai</option>
                            <option value="<?= BELUM_KONFIRMASI ?>">Pesan Belum Dikonfirmasi</option>
                        </select> -->
                        <!-- </div> -->
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body" style="padding: 0.5rem;">
                        <div class="col-md-12">
                            <table id="konsultasi_tab" class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="row-number">#</th>
                                        <th>Pengirim</th>
                                        <th>Jabatan</th>
                                        <th>Kepada</th>
                                        <th>Perihal</th>
                                        <!-- <th>Pesan</th> -->
                                        <th>Status</th>
                                        <!-- <?php if ($this->session->userdata("group") != PERM_SKPD) { ?>
                                        <?php } ?> -->
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