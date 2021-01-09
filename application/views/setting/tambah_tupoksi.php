<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Tupoksi</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_tupoksi" role="form" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="tahun">Tahun <small id="err_tahun" class="em-error">(Tahun harus diisi)</small></label>
                  <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>

                <div class="form-group" id="upload_file">
                  <label for="file_upload">File <small id="err_file_upload" class="em-error">(File Upload harus dipilih)</small></label>
                  <div class="custom-file">
                    <label class="custom-file-label" for="file_upload">Pilih File</label>
                    <input type="file" class="custom-file-input" id="file_upload" name="file_upload" accept=".pdf" onchange="validateThis(this);">
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="active" name="active" checked>
                    <label for="active" class="custom-control-label">Aktifkan Tupoksi</label>
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