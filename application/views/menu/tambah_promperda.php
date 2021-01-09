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
            <form id="form_add" role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="tahun">Tahun</label>
                  <select class="custom-select select2" id="tahun" name="tahun" onchange="validateThis(this);">
                    <?php
                    $tahun = date("Y") + 5;
                    for ($i = 1950; $i < $tahun; $i++) {
                      $selected = "";
                      if ($i == date("Y")) {
                        $selected = "selected";
                      }
                    ?>
                      <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="text">Keterangan <small id="err_keterangan" class="em-error">(Keterangan harus diisi)</small></label>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" onkeyup="validateThis(this);" onchange="validateThis(this);">
                </div>

                <div class="form-group">
                  <label for="text">Realisasi</label>
                  <textarea class="form-control" name="realisasi" id="realisasi" rows="3" placeholder="Realisasi"></textarea>
                </div>

                <div class="form-group">
                  <label for="text">Persentase</label>
                  <input type="number" class="form-control" id="persentase" name="persentase" placeholder="Persentase" min="0" max="100">
                </div>

                <div class="form-group" id="upload_file">
                  <label for="file_upload">File <small id="err_file_upload" class="em-error">(File Upload harus dipilih)</small></label>
                  <div class="custom-file">
                    <label class="custom-file-label" for="file_upload">Pilih File</label>
                    <input type="file" class="custom-file-input" id="file_upload" name="file_upload" accept=".pdf" onchange="validateThis(this);">
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