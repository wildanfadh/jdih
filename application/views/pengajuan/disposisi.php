<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <form id="form_save" style="width: 100%;">

          <div class="col-md-12 append-here">
            <div class="card card-secondary">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="judul">Tambah Disposisi</label>

                      <div class="input-group">
                        <input type="number" class="form-control" id="jumlah" placeholder="Isi Jumlah Produk Hukum di sini">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-info" id="jumlah_change">Disposisikan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="button-fixed">
              <button type="button" class="btn btn-primary" id="btn_simpan">Simpan</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
</div>