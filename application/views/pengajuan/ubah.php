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
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="ubah_pengajuan" role="form">
              <div class="card-body">

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="judul">Judul <small id="err_judul" class="em-error">(Judul harus diisi)</small></label>
                      <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $data["judul"]; ?>">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nama">Nama <small id="err_nama" class="em-error">(Nama harus diisi)</small></label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $data["nama"]; ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="jabatan">Jabatan <small id="err_jabatan" class="em-error">(Jabatan harus diisi)</small></label>
                      <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $data["jabatan"]; ?>">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nomor">Nomor HP <small id="err_nomor" class="em-error">(Nomor HP harus diisi)</small></label>
                      <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor HP" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $data["nomor_hp"]; ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="jumlah">Jumlah Produk Hukum <small id="err_jumlah" class="em-error">(Jumlah Produk Hukum harus diisi)</small></label>
                      <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Produk Hukum" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $data["jumlah_prokum"]; ?>">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="jenis">Jenis Pengajuan <small id="err_jenis" class="em-error">(Jenis Pengajuan harus dipilih)</small></label>
                      <select class="custom-select" id="jenis" name="jenis" onchange="validateThis(this);">
                        <option value="">-- Pilih Jenis Pengajuan</option>
                        <option value="<?php echo JENP_PERWALI; ?>" <?php echo ($data["jenis_pengajuan"] == JENP_PERWALI) ? "selected" : ""; ?>>Peraturan Wali Kota (Perwali)</option>
                        <option value="<?php echo JENP_KEPWALI; ?>" <?php echo ($data["jenis_pengajuan"] == JENP_KEPWALI) ? "selected" : ""; ?>>Keputusan Walikota (Kepwali)</option>
                        <option value="<?php echo JENP_KEPSEK; ?>" <?php echo ($data["jenis_pengajuan"] == JENP_KEPSEK) ? "selected" : ""; ?>>Keputusan Sekretariat Daerah</option>
                        <option value="<?php echo JENP_INWALI; ?>" <?php echo ($data["jenis_pengajuan"] == JENP_INWALI) ? "selected" : ""; ?>>Instruksi Walikota (Inwali)</option>
                        <option value="<?php echo JENP_SE; ?>" <?php echo ($data["jenis_pengajuan"] == JENP_SE) ? "selected" : ""; ?>>Surat Edaran (SE)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <?php
                  $word_text = "";
                  $word = explode("!!!", $data["file_pengajuan_word"]);
                  foreach ($word as $val) {
                    $word_text .= $val . ", ";
                  }
                  $word_text = $word[0];

                  $excel_text = "";
                  $excel = explode("!!!", $data["file_pengajuan_excel"]);
                  foreach ($excel as $val) {
                    $excel_text .= $val . ", ";
                  }
                  $excel_text = $excel[0];

                  $pdf = explode("!!!", $data["file_pengajuan_tambahan"]);
                  $tambahan = !empty($pdf[1]) ? $pdf[1] : "Pilih File Tambahan";
                  ?>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="file_word">File Word <small id="err_file_word" class="em-error">(File Word harus dipilih)</small></label>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-danger change" id="change_word" data-tipe="word" data-file="<?php echo $word_text; ?>">Ganti File</button>
                          <input type="hidden" id="status_word" value="0" name="status_ganti[]">
                          <input type="hidden" id="jenis_word" name="jenis_ganti[]" value="docx">
                        </div>
                        <div class="custom-file">
                          <label class="custom-file-label" for="file_word" id="label_word"><?php echo $word_text; ?></label>
                          <input type="file" class="custom-file-input" id="file_word" name="file[]" accept=".docx" multiple onchange="validateThis(this);" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="file_excel">File Excel <small id="err_file_excel" class="em-error">(File Excel harus dipilih)</small></label>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-danger change" id="change_excel" data-tipe="excel" data-file="<?php echo $excel_text; ?>">Ganti File</button>
                          <input type="hidden" id="status_excel" value="0" name="status_ganti[]">
                          <input type="hidden" id="jenis_excel" name="jenis_ganti[]" value="xlsx">
                        </div>
                        <div class="custom-file">
                          <label class="custom-file-label" for="file_excel" id="label_excel"><?php echo $excel_text; ?></label>
                          <input type="file" class="custom-file-input" id="file_excel" name="file[]" accept=".xlsx" multiple onchange="validateThis(this);" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="file_surat">File Surat <small id="err_file_surat" class="em-error">(File Surat harus dipilih)</small></label>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-danger change" id="change_surat" data-tipe="surat" data-file="<?php echo $pdf[0]; ?>">Ganti File</button>
                          <input type="hidden" id="status_surat" value="0" name="status_ganti[]">
                          <input type="hidden" id="jenis_surat" name="jenis_ganti[]" value="pdf">
                        </div>
                        <div class="custom-file">
                          <label class="custom-file-label" for="file_surat" id="label_surat"><?php echo $pdf[0]; ?></label>
                          <input type="file" class="custom-file-input" id="file_surat" name="file[]" accept=".pdf" onchange="validateThis(this);" disabled>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 file-tambahan <?php echo !empty($pdf[1]) ? "" : "hide"; ?>">
                    <div class="form-group">
                      <label for="file_tambahan">File Tambahan <small id="err_file_tambahan" class="em-error">(File Tambahan harus dipilih)</small></label>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-danger change" id="change_tambahan" data-tipe="tambahan" data-file="<?php echo $tambahan; ?>">Ganti File</button>
                          <input type="hidden" id="status_tambahan" value="0" name="status_ganti[]">
                          <input type="hidden" id="jenis_tambahan" name="jenis_ganti[]" value="pdf">
                        </div>
                        <div class="custom-file">
                          <label class="custom-file-label" for="file_tambahan" id="label_tambahan"><?php echo $tambahan; ?></label>
                          <input type="file" class="custom-file-input" id="file_tambahan" name="file[]" accept=".pdf" onchange="validateThis(this);" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
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