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
    <div class="container-fluid">
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
                <li class="nav-item active">
                  <a href="<?php echo base_url("Konsultasi") ?>" class="nav-link">
                    <i class="fas fa-inbox"></i> Pesan Masuk
                    <span class="badge bg-primary float-right"></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url("Konsultasi/sent") ?>" class="nav-link">
                    <i class="far fa-envelope"></i> Terkirim
                    <span class="badge bg-primary float-right"></span>
                  </a>
                </li>

                <?php
                $usr_ = $this->session->userdata("user_id");

                if ($usr_ == 5 ) {
                
                ?>

                <li class="nav-item">
                  <a href="<?php echo base_url("Konsultasi/permite_sent") ?>" class="nav-link">
                    <i class="far fa-envelope"></i> Izinkan Pesan
                    <span class="badge bg-primary float-right"></span>
                  </a>
                </li>

                <?php } ?>

                <li class="nav-item">
                  <a href="<?php echo base_url("Konsultasi/draft") ?>" class="nav-link">
                    <i class="far fa-file-alt"></i> Pesan Tersimpan
                    <span class="badge bg-primary float-right"></span>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="<?php echo base_url("Konsultasi/deleted") ?>" class="nav-link">
                    <i class="far fa-trash-alt"></i> Pesan Dihapus
                    <span class="badge bg-primary float-right"></span>
                  </a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5><?php echo $konsultasi["subject"]; ?></h5>
                <h7>Dari: <?php echo $konsultasi["user"]["user_full_name"] . " (" . $konsultasi["user"]["group_name"] . ")"; ?>
                  <span class="mailbox-read-time float-right"><?php echo date("d M Y, H:i", strtotime($konsultasi["created_date"])); ?></span>
                </h7>
              </div>
              <div class="mailbox-read-message">
                <?php echo $konsultasi["message"]; ?>
              </div>
            </div>

            <?php if ($konsultasi["id_from"] != $this->session->userdata("user_id")) { ?>
              <div class="card-footer">
                <div class="float-right">
                  <button type="button" class="btn btn-default" id="reply"><i class="fas fa-reply"></i> Balas</button>
                </div>
                <!-- <button type="button" class="btn btn-default" id="delete"><i class="far fa-trash-alt"></i> Hapus</button> -->
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
  </section>
</div>