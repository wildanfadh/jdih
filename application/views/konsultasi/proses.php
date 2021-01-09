<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-4">

                    <?php if ($this->session->userdata("group") == PERM_SKPD) { ?>

                        <div class="float-sm-right mt-1">
                            <a href="<?php echo base_url("Konsultasi/addkonsul") ?>" class="btn btn-primary btn-sm btn-block mb-3">Tambah Konsultasi</a>
                        </div>

                    <?php } else { ?>
                        <div class="dropdown float-right mt-1">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="select-message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tampilkan Pesan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="select-message">
                                <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/konsultasi_proses"); ?>">Semua Pesan</a>
                                <?php if (!in_array($this->session->userdata("group"), array(PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA, PERM_RESEPSIONIS))) { ?>
                                    <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_forme"); ?>">Pesan Untuk Saya</a>
                                <?php } ?>
                                <?php if ($this->session->userdata("group") == PERM_KABAG) { ?>
                                    <a class="dropdown-item btn-sm" href="<?php echo base_url("Konsultasi/message_confir"); ?>">Pesan Belum Dikonfirmasi</a>
                                <?php } ?>
                            </div>
                        </div>
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
                                        <th>(SKPD)</th>
                                        <th>Kepada</th>
                                        <th>Judul</th>
                                        <!-- <th>Pesan</th> -->
                                        <?php if ($this->session->userdata("group") == PERM_KABAG) { ?>
                                            <th>Status Konfirmasi</th>
                                        <?php } ?>
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