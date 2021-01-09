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
                <input type="hidden" id="user" name="user" value="<?php echo $konsultasi["id_from"]; ?>">
                <input type="hidden" id="from_message" name="from_message" value="<?php echo $konsultasi["id"]; ?>">

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
              <!-- <button type="reset" class="btn btn-default" id="hapus"><i class="fas fa-times"></i> Hapus</button> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>