<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Ubah Kegiatan</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_agenda" role="form">
              <input type="hidden" name="id" value="<?php echo $agenda["id"]; ?>">

              <div class="card-body">
                <div class="form-group">
                  <label for="judul">Judul <small id="err_judul" class="em-error">(Judul harus diisi)</small></label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" onkeyup="validateThis(this);" onchange="validateThis(this);" value='<?php echo $agenda["judul"]; ?>'>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="publish" name="publish" <?php echo $agenda["is_online"] ? "checked" : ""; ?>>
                    <label for="publish" class="custom-control-label">Online kan Agenda</label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="isi">Isi Agenda <small id="err_isi" class="em-error">(Isi Agenda harus diisi)</small></label>
                  <textarea class="form-control" id="isi" name="isi" rows="3" placeholder="Isi Agenda" onkeyup="validateThis(this);" onchange="validateThis(this);"><?php echo $agenda["isi_agenda"]; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="waktu">Waktu <small id="err_waktu" class="em-error">(Waktu harus diisi)</small></label>
                  <input type="text" class="form-control" id="waktu" name="waktu" placeholder="Waktu" onkeyup="validateThis(this);" onchange="validateThis(this);" value='<?php echo $agenda["waktu"]; ?>'>
                </div>

                <div class="form-group">
                  <label for="tg_mulai">Tanggal Mulai <small id="err_tg_mulai" class="em-error">(Tanggal Mulai harus diisi)</small></label>
                  <input type="text" class="form-control" id="tg_mulai" name="tg_mulai" placeholder="dd/mm/yyyy" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="true" value='<?php echo date("d-m-Y", strtotime($agenda["tanggal_mulai"])); ?>'>
                </div>

                <div class="form-group">
                  <label for="tg_selesai">Tanggal Selesai <small id="err_tg_selesai" class="em-error">(Tanggal Selesai harus diisi)</small></label>
                  <input type="text" class="form-control" id="tg_selesai" name="tg_selesai" placeholder="dd/mm/yyyy" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="true" value='<?php echo date("d-m-Y", strtotime($agenda["tanggal_selesai"])); ?>'>
                </div>

                <div class="form-group">
                  <label for="tempat">Tempat <small id="err_tempat" class="em-error">(Tempat harus diisi)</small></label>
                  <textarea class="form-control" id="tempat" name="tempat" rows="3" placeholder="Tempat" onkeyup="validateThis(this);" onchange="validateThis(this);"><?php echo $agenda["tempat"]; ?></textarea>
                </div>
              </div>

              <div class="button-fixed">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>