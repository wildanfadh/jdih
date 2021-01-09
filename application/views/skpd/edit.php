<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-7">
          <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_skpd" role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="nama">Nama Satuan Kerja Perangkat Daerah (SKPD) <small id="err_nama" class="em-error">(Nama SKPD harus diisi)</small></label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Satuan Kerja Perangkat Daerah (SKPD)" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $skpd["nama"]; ?>">
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="is_active" name="is_active" <?php echo $skpd["is_active"]?"checked":""; ?>>
                    <label for="is_active" class="custom-control-label">Aktif <small>('Centang' untuk mengaktifkan SKPD)</small></label>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>