<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0 text-dark">Tambah Produk Hukum <?php echo ucwords($tipe["default"]); ?> <small>(<?php echo $prokum["subjek_singkat"]; ?>)</small></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <form id="tambah_prokum" role="form">
              <div class="card-body">
                <input type="hidden" name="tipe" id="tipe" value="<?php echo strtoupper($_GET["tipe"]); ?>">
                <input type="hidden" name="id" id="id" value="<?php echo $prokum["id"]; ?>">

                <div class="form-group" enctype="multipart/form-data">
                  <label for="jenis">Jenis Produk Hukum <small id="err_jenis" class="em-error">(Jenis harus dipilih)</small></label>
                  <select class="custom-select" id="jenis" name="jenis" onchange="validateThis(this);">
                    <option value="">-- Pilih Jenis Produk Hukum</option>
                    <?php foreach ($jenis as $val) {
                      $selected = "";
                      if ($val["id"] == $prokum["id_jenis"]) {
                        $selected = "selected";
                      }
                    ?>

                      <option value="<?php echo $val["id"]; ?>" <?php echo $selected; ?>><?php echo $val["singkatan"] . " (" . $val["nama"] . ")"; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="publish" name="publish" <?php echo $prokum["is_online"] ? "checked" : ""; ?>>
                    <label for="publish" class="custom-control-label">Online kan Prokum <small>('Centang' untuk PERDA, PERWALI)</small></label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="noper">No. Peraturan <small id="err_noper" class="em-error">(No. Peraturan harus diisi)</small></label>
                  <input type="text" class="form-control" id="noper" name="noper" placeholder="No. Peraturan" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $prokum["no_peraturan"]; ?>">
                </div>

                <div class="form-group">
                  <label for="tentang">Tentang <small id="err_tentang" class="em-error">(Tentang harus diisi)</small></label>
                  <textarea class="form-control" id="tentang" name="tentang" rows="3" placeholder="Tentang" onkeyup="validateThis(this);" onchange="validateThis(this);"><?php echo $prokum["tentang"]; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="tahun">Tahun Peraturan</label>
                  <select class="custom-select select2" id="tahun" name="tahun" onchange="validateThis(this);">
                    <?php
                    $tahun = date("Y") + 5;
                    for ($i = 1950; $i < $tahun; $i++) {
                      $selected = "";
                      if ($i == $prokum["tahun_peraturan"]) {
                        $selected = "selected";
                      }
                    ?>
                      <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="halaman">Jumlah Halaman <small id="err_halaman" class="em-error">(Jumlah Halaman harus diisi)</small></label>
                  <div class="input-group">
                    <input type="number" min="1" class="form-control" id="halaman" name="halaman" placeholder="Jumlah Halaman" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $prokum["jumlah_halaman"]; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">Halaman</span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="seri">Seri Peraturan <small id="err_seri" class="em-error">(Seri Peraturan harus dipilih)</small></label>
                  <select class="custom-select" id="seri" name="seri" onchange="validateThis(this);">
                    <option value="">-- Pilih Seri Peraturan</option>
                    <option value="A" <?php echo ($prokum["seri_peraturan"] == "A") ? "selected" : ""; ?>>Seri A : Anggaran Pendapatan Dan Belanja Daerah</option>
                    <option value="B" <?php echo ($prokum["seri_peraturan"] == "B") ? "selected" : ""; ?>>Seri B : Pajak Daerah</option>
                    <option value="C" <?php echo ($prokum["seri_peraturan"] == "C") ? "selected" : ""; ?>>Seri C : Retribusi Daerah</option>
                    <option value="D" <?php echo ($prokum["seri_peraturan"] == "D") ? "selected" : ""; ?>>Seri D : Kelembagaan</option>
                    <option value="E" <?php echo ($prokum["seri_peraturan"] == "E") ? "selected" : ""; ?>>Seri E : Materi Peraturan Selain Huruf A Sampai Dengan D</option>
                    <option value="F" <?php echo ($prokum["seri_peraturan"] == "F") ? "selected" : ""; ?>>Seri F : Keputusan Bersama</option>
                    <option value="G" <?php echo ($prokum["seri_peraturan"] == "G") ? "selected" : ""; ?>>Seri G : Keputusan Kepala Daerah Tertentu</option>
                  </select>
                </div>

                <hr>

                <div class="form-group">
                  <label for="subjek">Subjek Singkat Peraturan <small id="err_subjek" class="em-error">(Subjek Singkat Peraturan harus diisi)</small></label>
                  <input type="text" class="form-control" id="subjek" name="subjek" placeholder="Subjek Singkat Peraturan" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $prokum["subjek_singkat"]; ?>">
                </div>

                <div class="form-group">
                  <label for="pertimbangan">Dasar Pertimbangan Peraturan</label>
                  <textarea class="form-control" id="pertimbangan" name="pertimbangan" rows="3" placeholder="Dasar Pertimbangan Peraturan"><?php echo strip_tags($prokum["dasar_pertimbangan"]); ?></textarea>
                </div>

                <div class="form-group">
                  <label for="hukum">Dasar Hukum Peraturan</label>
                  <textarea class="form-control" id="hukum" name="hukum" rows="3" placeholder="Dasar Hukum Peraturan"><?php echo strip_tags($prokum["dasar_hukum"]); ?></textarea>
                </div>

                <div class="form-group">
                  <label for="catatan">Catatan Penting</label>
                  <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Catatan Penting"><?php echo strip_tags($prokum["catatan_penting"]); ?></textarea>
                </div>

                <hr>

                <div class="form-group">
                  <label for="status">Status Peraturan <small id="err_status" class="em-error">(Status Peraturan harus dipilih)</small></label>
                  <select class="custom-select" id="status" name="status" onchange="validateThis(this);">
                    <option value="">-- Pilih Status Peraturan</option>
                    <option value="Berlaku" data-jenis="berlaku" <?php echo ($prokum["status_peraturan"] == "Berlaku") ? "selected" : ""; ?>>Berlaku</option>
                    <option value="Mengubah" data-jenis="non-berlaku" <?php echo ($prokum["status_peraturan"] == "Mengubah") ? "selected" : ""; ?>>Mengubah</option>
                    <option value="Mencabut" data-jenis="non-berlaku" <?php echo ($prokum["status_peraturan"] == "Mencabut") ? "selected" : ""; ?>>Mencabut</option>
                    <option value="Diubah" data-jenis="non-berlaku" <?php echo ($prokum["status_peraturan"] == "Diubah") ? "selected" : ""; ?>>Diubah</option>
                    <option value="Dicabut" data-jenis="non-berlaku" <?php echo ($prokum["status_peraturan"] == "Dicabut") ? "selected" : ""; ?>>Dicabut</option>
                    <option value="Tidak Berlaku" data-jenis="non-berlaku" <?php echo ($prokum["status_peraturan"] == "Tidak Berlaku") ? "selected" : ""; ?>>Tidak Berlaku</option>
                  </select>
                </div>

                <div class="form-group hide" id="berlaku">
                  <label for="status_sesuai">Penyesuaian Status <small id="err_status_sesuai" class="em-error">(Penyesuaian Status harus dipilih)</small></label>
                  <select class="custom-select" id="status_sesuai" name="status_sesuai" onchange="validateThis(this);">
                    <option value="">-- Pilih Penyesuaian Status</option>
                    <option value="Berlaku sejak tanggal diundangkan" <?php echo ($prokum["detail_status_peraturan"] == "Berlaku sejak tanggal diundangkan") ? "selected" : ""; ?>>Berlaku sejak tanggal diundangkan</option>
                    <option value="Berlaku sejak tanggal ditetapkan" <?php echo ($prokum["detail_status_peraturan"] == "Berlaku sejak tanggal ditetapkan") ? "selected" : ""; ?>>Berlaku sejak tanggal ditetapkan</option>
                    <option value="Berlaku sejak ditandatangani para Pihak" <?php echo ($prokum["detail_status_peraturan"] == "Berlaku sejak ditandatangani para Pihak") ? "selected" : ""; ?>>Berlaku sejak ditandatangani para Pihak</option>
                  </select>
                </div>

                <div class="form-group hide" id="non-berlaku">
                  <label for="status_judul">Penyesuaian Status <small id="err_status_judul" class="em-error">(Penyesuaian Status harus diisi)</small></label>
                  <input type="text" class="form-control" id="status_judul" name="status_judul" placeholder="Penyesuaian Status" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $prokum["detail_status_peraturan"]; ?>">
                </div>

                <div class="form-group">
                  <label for="tg_penetapan">Tanggal Penetapan <small id="err_tg_penetapan" class="em-error">(Tanggal Penetapan harus diisi)</small></label>
                  <input type="text" class="form-control" id="tg_penetapan" name="tg_penetapan" placeholder="dd/mm/yyyy" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="true" value="<?php echo $prokum["tanggal_penetapan"]; ?>">
                </div>

                <div class="form-group">
                  <label for="tg_pengundangan">Tanggal Pengundangan <small id="err_tg_pengundangan" class="em-error">(Tanggal Pengundangan harus diisi)</small></label>
                  <input type="text" class="form-control" id="tg_pengundangan" name="tg_pengundangan" placeholder="dd/mm/yyyy" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="true" value="<?php echo $prokum["tanggal_pengundangan"]; ?>">
                </div>

                <div class="form-group">
                  <label for="reg_provinsi">No. Register Provinsi</label>
                  <input type="text" class="form-control" id="reg_provinsi" name="reg_provinsi" placeholder="No. Register Provinsi" value="<?php echo $prokum["noreg_provinsi"]; ?>">
                </div>

                <div class="form-group">
                  <label for="reg_daerah">No. Register Lembaran Daerah</label>
                  <input type="text" class="form-control" id="reg_daerah" name="reg_daerah" placeholder="No. Register Lembaran Daerah" value="<?php echo $prokum["noreg_daerah"]; ?>">
                </div>

                <!-- ADDED -->
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="is_upload" name="is_upload" <?php echo $prokum["is_upload"] ? "checked" : ""; ?>>
                    <label for="is_upload" class="custom-control-label">Upload File <small>('Centang' jika file belum pernah diupload)</small></label>
                  </div>
                </div>

                <div class="form-group <?php echo $prokum["is_upload"] ? "" : "hide"; ?>" id="upload_file">
                  <label for="file_upload">File <small id="err_file_upload" class="em-error">(File Upload harus dipilih)</small></label>
                  <div class="custom-file">
                    <label class="custom-file-label" for="file_upload"><?php echo $prokum["is_upload"] ? $prokum["file"] : "Pilih File"; ?></label>
                    <input type="file" class="custom-file-input" id="file_upload" name="file_upload" accept=".pdf, .doc, .docx" onchange="validateThis(this);" disabled>
                  </div>
                  <button type="button" class="btn btn-sm btn-warning" style="margin-top: 5px;" id="ganti_file">Ganti File</button>
                  <input type="hidden" id="file_change" name="file_change" value="2">
                </div>

                <div class="form-group <?php echo $prokum["is_upload"] ? "hide" : ""; ?>" id="select_file">
                  <label for="file_select">File <small id="err_file_select" class="em-error">(File harus dipilih)</small></label>
                  <select class="custom-select select2" id="file_select" name="file_select" onchange="validateThis(this);">
                    <option value="">-- Pilih File</option>
                    <?php foreach ($file as $val) {
                      $selected = "";
                      if ($val == $prokum["file"]) {
                        $selected = "selected";
                      } ?>

                      <option value="<?php echo $val; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>

                    <?php } ?>
                  </select>
                </div>
                <!-- ADDED -->

                <div class="form-group">
                  <label for="lemari">Hardcopy disimpan di <small id="err_lemari" class="em-error">(Letak Hardcopy harus dipilih)</small></label>
                  <select class="custom-select" id="lemari" name="lemari" onchange="validateThis(this);">
                    <option value="">-- Pilih Letak Hardcopy</option>
                    <?php foreach ($lemari as $val) {
                      $selected = "";
                      if ($val["id"] == $prokum["id_kabinet"]) {
                        $selected = "selected";
                      }
                    ?>
                      <option value="<?php echo $val["id"]; ?>" <?php echo $selected; ?>><?php echo $val["macam"] . " : " . $val["keterangan"] . ", posisi : " . $val["posisi"]; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <hr>

                <div class="form-group">
                  <label for="pihak1">Pihak I</label>
                  <input type="text" class="form-control" id="pihak1" name="pihak1" placeholder="Pihak I" value="<?php echo $prokum["pihak1"]; ?>">
                </div>

                <div class="form-group">
                  <label for="pihak2">Pihak II</label>
                  <input type="text" class="form-control" id="pihak2" name="pihak2" placeholder="Pihak II" value="<?php echo $prokum["pihak2"]; ?>">
                </div>

                <div class="form-group">
                  <label for="masa_berlaku">Masa Berlaku Perjanjian (Bulan/Tahun)</label>
                  <input type="text" class="form-control" id="masa_berlaku" name="masa_berlaku" placeholder="mm/yyyy" data-inputmask="'mask': ['99/9999']" data-mask="" im-insert="true" value="<?php echo $prokum["masa_berlaku"]; ?>">
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