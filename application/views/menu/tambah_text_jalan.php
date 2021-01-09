<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Text Jalan</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_text" role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="text">Text <small id="err_text" class="em-error">(Text harus diisi)</small></label>
                  <input type="text" class="form-control" id="text" name="text" placeholder="Text" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="active" name="active" checked>
                    <label for="active" class="custom-control-label">Aktifkan Text</label>
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