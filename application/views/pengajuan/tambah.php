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
            <form id="tambah_pengajuan" role="form">
              <div class="card-body">

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="judul">Perihal <small id="err_judul" class="em-error">(Perihal harus diisi)</small></label>
                      <input type="text" class="form-control" id="judul" name="judul" placeholder="Perihal" onkeyup="validateThis(this);" onchange="validateThis(this);">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nama">Nama <small id="err_nama" class="em-error">(Nama harus diisi)</small></label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" onkeyup="validateThis(this);" onchange="validateThis(this);">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="jabatan">Jabatan <small id="err_jabatan" class="em-error">(Jabatan harus diisi)</small></label>
                      <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" onkeyup="validateThis(this);" onchange="validateThis(this);">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nomor">Nomor HP <small id="err_nomor" class="em-error">(Nomor HP harus diisi)</small></label>
                      <input type="number" class="form-control" id="nomor" name="nomor" placeholder="Nomor HP" onkeyup="validateThis(this);" onchange="validateThis(this);">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="jumlah">Jumlah Produk Hukum <small id="err_jumlah" class="em-error">(Jumlah Produk Hukum harus diisi)</small></label>
                      <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Produk Hukum" onkeyup="validateThis(this);" onchange="validateThis(this);">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="jenis">Jenis Pengajuan <small id="err_jenis" class="em-error">(Jenis Pengajuan harus dipilih)</small></label>
                      <select class="custom-select" id="jenis" name="jenis" onchange="validateThis(this);">
                        <option value="">-- Pilih Jenis Pengajuan</option>
                        <option value="<?php echo JENP_PERWALI ?>">Peraturan Wali Kota (Perwali)</option>
                        <option value="<?php echo JENP_KEPWALI ?>">Keputusan Walikota (Kepwali)</option>
                        <option value="<?php echo JENP_KEPSEK ?>">Keputusan Sekretariat Daerah</option>
                        <option value="<?php echo JENP_INWALI ?>">Instruksi Walikota (Inwali)</option>
                        <option value="<?php echo JENP_SE ?>">Surat Edaran (SE)</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="file_word">File Word <small id="err_file_word" class="em-error">(File Word harus dipilih)</small></label>
                      <div class="custom-file">
                        <label class="custom-file-label" for="file_word">Pilih File Word</label>
                        <input type="file" class="custom-file-input" id="file_word" name="file[]" accept=".docx" multiple onchange="validateThis(this);">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="file_excel">File Excel <small id="err_file_excel" class="em-error">(File Excel harus dipilih)</small></label>
                      <div class="custom-file">
                        <label class="custom-file-label" for="file_excel">Pilih File Excel</label>
                        <input type="file" class="custom-file-input" id="file_excel" name="file[]" accept=".xlsx" multiple onchange="validateThis(this);">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="file_surat">File Surat <small id="err_file_surat" class="em-error">(File Surat harus dipilih)</small></label>
                      <div class="custom-file">
                        <label class="custom-file-label" for="file_surat">Pilih File Surat</label>
                        <input type="file" class="custom-file-input" id="file_surat" name="file[]" accept=".pdf" onchange="validateThis(this);">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 file-tambahan hide">
                    <div class="form-group">
                      <label for="file_tambahan">File Tambahan <small id="err_file_tambahan" class="em-error">(File Tambahan harus dipilih)</small></label>
                      <div class="custom-file">
                        <label class="custom-file-label" for="file_tambahan">Pilih File Tambahan</label>
                        <input type="file" class="custom-file-input" id="file_tambahan" name="file[]" accept=".pdf" onchange="validateThis(this);">
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