<style>
  .croppie-container {
    height: 430px !important;
  }

  #crop-image {
    padding: 9px 13px;
  }

  th,
  td {
    vertical-align: middle !important;
  }

  .table-max {
    overflow: auto;
    max-height: 300px;
  }

  .table-max thead th {
    position: sticky;
    top: 0;
  }

  tr th {
    background-color: #ffffff;
  }
</style>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Profil</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_profil" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="walikota">Nama Wali Kota <small id="err_walikota" class="em-error">(Nama Wali Kota harus diisi)</small></label>
                  <input type="text" class="form-control" id="walikota" name="walikota" placeholder="Nama Wali Kota" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="active" name="active" checked>
                    <label for="active" class="custom-control-label">Wali Kota Aktif <small>('Centang' maka akan menonaktifkan data yang lain.)</small></label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="periode_awal">Periode Awal <small id="err_periode_awal" class="em-error">(Periode Awal harus diisi)</small></label>
                      <input type="text" class="form-control" id="periode_awal" name="periode_awal" placeholder="Periode Awal" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['9999']" data-mask="" im-insert="true">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="periode_akhir">Periode Akhir <small style="color: #28a745;">(Bisa dikosongkan)</small></label>
                      <input type="text" class="form-control" id="periode_akhir" name="periode_akhir" placeholder="Periode Akhir" data-inputmask="'mask': ['9999']" data-mask="" im-insert="true">
                    </div>
                  </div>
                </div>

                <div class="form-group table-max">
                  <input type="hidden" class="form-control" id="count_visi" value="1">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Visi <small id="err_visi" class="em-error">(Visi harus diisi)</small></th>
                        <th style="width: 110px;">
                          <div class="input-group input-group-sm">
                            <input type="number" min="1" class="form-control" id="num_visi">
                            <span class="input-group-append">
                              <button type="button" class="btn btn-primary btn-flat" id="add_visi"><i class="fa fa-plus"></i></button>
                            </span>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tbody_visi"></tbody>
                  </table>
                </div>

                <div class="form-group table-max">
                  <input type="hidden" class="form-control" id="count_misi" value="1">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Misi <small id="err_misi" class="em-error">(Misi harus diisi)</small></th>
                        <th style="width: 110px;">
                          <div class="input-group input-group-sm">
                            <input type="number" min="1" class="form-control" id="num_misi">
                            <span class="input-group-append">
                              <button type="button" class="btn btn-primary btn-flat" id="add_misi"><i class="fa fa-plus"></i></button>
                            </span>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tbody_misi"></tbody>
                  </table>
                </div>

                <!-- FOTO -->
                <div class="form-group">
                  <label for="upload">Foto Walikota <small id="err_upload" class="em-error">(Foto Walikota harus dipilih)</small></label>
                  <div class="custom-file">
                    <label class="custom-file-label" id="label_upload" for="upload">Pilih Foto</label>
                    <input type="file" class="custom-file-input" id="upload" name="upload" accept="image/*" onchange="validateThis(this);">
                  </div>
                </div>

                <!-- <div class="form-group">
                  <button type="button" class="btn btn-block btn-primary" id="crop-image">Crop Gambar</button>
                </div> -->

                <div class="form-group" id="upload_demo_div">
                  <div id="upload_demo"></div>
                </div>

                <!-- <div class="form-group" id="upload_demo_res_div" style="text-align: center;">
                  <img id="upload_demo_res" name="upload_demo_res">
                </div> -->
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