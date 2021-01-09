<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Ubah Lemari Arsip <small><?php echo "(" . $kabinet["macam"] . ")"; ?></small></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_jenis" role="form">
              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="id" id="id" value="<?php echo $kabinet["id"]; ?>">

                  <label for="macam">Macam <small id="err_macam" class="em-error">(Macam harus diisi)</small></label>
                  <input type="text" class="form-control" id="macam" name="macam" placeholder="Macam" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $kabinet["macam"]; ?>">
                  <small>Catatan : Khusus untuk inputan diatas, ganti spasi dengan tanda strip (-)</small>
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan <small id="err_keterangan" class="em-error">(Keterangan harus diisi)</small></label>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $kabinet["keterangan"]; ?>">
                </div>
                <div class="form-group">
                  <label for="posisi">Posisi Lemari <small id="err_posisi" class="em-error">(Posisi Lemari harus diisi)</small></label>
                  <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Posisi Lemari" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $kabinet["posisi"]; ?>">
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