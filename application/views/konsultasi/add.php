<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1><?php echo $title; ?></h1>
        </div>
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

                <?php $usr_ = $this->session->userdata("user_id");
                if ($usr_ == 5) { ?>

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
            <div class="card-body">
              <form id="tambah_konsultasi">
                <div class="form-group">
                  <label for="user">Kirim Ke <small id="err_user" class="em-error">(Penerima harus dipilih)</small></label>
                  <select class="custom-select" id="user" name="user" onkeyup="validateThis(this);" onchange="validateThis(this);">
                    <option value="">-- Pilih Penerima</option>
                    <?php
                    $usr_ = $this->session->userdata("user_id");
                    // $usr_admin = array( 1, 2, 3, );
                    $usr_kabag = 5;
                    $usr_skpd = 4;

                    if ($usr_ == $usr_skpd) {

                      foreach ($group as $val) {
                        if ($val["user_id"] !== $this->session->userdata("user_id")) {
                          echo "<option value='" . $val["user_id"] . "'>" . $val["user_full_name"] . " (" . $val["group_description"] . ")</option>";
                        }
                      }
                    } elseif ($usr_ == $usr_kabag) {

                      foreach ($group as $val) {
                        if ($val["user_id"] != $this->session->userdata("user_id")) {
                          echo "<option value='" . $val["user_id"] . "'>" . $val["user_full_name"] . " (" . $val["group_description"] . ")</option>";
                        }
                      }
                    } else {

                      echo "<option value='" . $usr_skpd . "'> Dinas Kominfo ( SKPD )</option>";
                    } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="subject">Judul <small id="err_subject" class="em-error">(Judul harus diisi)</small></label>
                  <input class="form-control" id="subject" name="subject" placeholder="Judul" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>
                <div class="form-group">
                  <label for="message">Pesan <small id="err_message" class="em-error">(Pesan harus diisi)</small></label>
                  <textarea id="message" name="message" class="form-control text-summer" onkeyup="validateThis(this);" onchange="validateThis(this);"></textarea>
                </div>
              </form>
            </div>

            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default" id="simpan"><i class="fas fa-pencil-alt"></i> Simpan</button>
                <button type="button" class="btn btn-primary" id="kirim"><i class="far fa-envelope"></i> Kirim</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>