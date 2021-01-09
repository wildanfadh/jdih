<style>
  .croppie-container {
    height: 430px !important;
  }

  #crop-image {
    padding: 9px 13px;
  }
</style>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Personil</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_personil" enctype="multipart/form-data">
              <input type="hidden" name="id_profil" id="id_profil" value="<?php echo $id_profil; ?>">

              <div class="card-body">
                <div class="form-group">
                  <label for="nama">Nama <small id="err_nama" class="em-error">(Nama harus diisi)</small></label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>

                <div class="form-group">
                  <label for="gelar">Gelar</label>
                  <input type="text" class="form-control" id="gelar" name="gelar" placeholder="Gelar">
                </div>

                <div class="form-group">
                  <label for="jabatan">Jabatan <small id="err_jabatan" class="em-error">(Jabatan harus diisi)</small></label>
                  <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>

                <div class="form-group" enctype="multipart/form-data">
                  <label for="posisi">Posisi <small id="err_posisi" class="em-error">(Posisi harus dipilih)</small></label>
                  <select class="custom-select" id="posisi" name="posisi" onchange="validateThis(this);">
                    <option value="">-- Pilih Posisi</option>
                    <option value="<?php echo POS_WAKIL; ?>">Wakil Walikota</option>
                    <option value="<?php echo POS_KEPALA; ?>">Kepala Bagian</option>
                    <option value="<?php echo POS_SUB; ?>">Kepala Sub Bagian</option>
                    <option value="<?php echo POS_STAFF; ?>">Staff</option>
                  </select>
                </div>

                <!-- FOTO -->
                <div class="form-group">
                  <label for="upload">Foto <small id="err_upload" class="em-error">(Foto harus dipilih)</small></label>
                  <div class="custom-file">
                    <label class="custom-file-label" id="label_upload" for="upload">Pilih Foto</label>
                    <input type="file" class="custom-file-input" id="upload" name="upload" accept="image/*" onchange="validateThis(this);">
                  </div>
                </div>

                <div class="form-group" id="upload_demo_div">
                  <div id="upload_demo"></div>
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