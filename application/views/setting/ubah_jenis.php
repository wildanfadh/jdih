<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Jenis Produk Hukum</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="ubah_jenis" role="form">
              <input type="hidden" name="id" value="<?php echo $jenis["id"]; ?>">

              <div class="card-body">
                <div class="form-group">
                  <label for="tipe">Tipe Produk Hukum <small id="err_tipe" class="em-error">(Tipe harus dipilih)</small></label>
                  <select class="custom-select" id="tipe" name="tipe" onchange="validateThis(this);">
                    <option value="">-- Pilih Tipe Produk Hukum</option>
                    <option value="<?php echo PROK_DAERAH; ?>" <?php echo $jenis["tipe"] == PROK_DAERAH ? "selected" : ""; ?>>Produk Hukum Daerah</option>
                    <option value="<?php echo PROK_PUSAT; ?>" <?php echo $jenis["tipe"] == PROK_PUSAT ? "selected" : ""; ?>>Produk Hukum Pusat</option>
                    <option value="<?php echo PROK_NON; ?>" <?php echo $jenis["tipe"] == PROK_NON ? "selected" : ""; ?>>Non Produk Hukum</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nama">Nama Produk Hukum <small id="err_nama" class="em-error">(Nama harus diisi)</small></label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk Hukum" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $jenis["nama"]; ?>">
                </div>
                <div class="form-group">
                  <label for="singkatan">Singkatan Produk Hukum <small id="err_singkatan" class="em-error">(Singkatan harus diisi)</small></label>
                  <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="Singkatan Produk Hukum" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $jenis["singkatan"]; ?>">
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