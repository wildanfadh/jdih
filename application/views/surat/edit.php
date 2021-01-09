<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-7">
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
            <form id="tambah_surat" role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="nama">Nomor Surat <small id="err_no_surat" class="em-error">(Nomor Surat harus diisi)</small></label>
                  <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $surat["nomor_surat"]; ?>">
                </div>

                <div class="form-group">
                  <label for="nama">Isi/Tentang <small id="err_tentang" class="em-error">(Isi/Tentang harus diisi)</small></label>
                  <textarea class="form-control" id="tentang" name="tentang" rows="3" placeholder="Isi/Tentang" onkeyup="validateThis(this);" onchange="validateThis(this);"><?php echo $surat["perihal"]; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="tanggal_surat">Tanggal Surat <small id="err_tanggal_surat" class="em-error">(Tanggal Surat harus diisi)</small></label>
                  <input type="text" class="form-control" id="tanggal_surat" name="tanggal_surat" placeholder="dd/mm/yyyy" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="true" value="<?php echo date("d/m/Y", strtotime($surat["tanggal_surat"])); ?>">
                </div>

                <div class="form-group">
                  <label for="tanggal_terima">Tanggal Terima <small id="err_tanggal_terima" class="em-error">(Tanggal Terima harus diisi)</small></label>
                  <input type="text" class="form-control" id="tanggal_terima" name="tanggal_terima" placeholder="dd/mm/yyyy" onkeyup="validateThis(this);" onchange="validateThis(this);" data-inputmask="'mask': ['99/99/9999']" data-mask="" im-insert="true" value="<?php echo date("d/m/Y", strtotime($surat["tanggal_terima"])); ?>">
                </div>

                <div class="form-group">
                  <label for="file_upload" id="label_surat">Surat Pengajuan <small id="err_surat_pengajuan" class="em-error">(Surat Pengajuan harus dipilih)</small></label>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="is_change_surat" name="is_change_surat">
                    <label for="is_change_surat" class="custom-control-label"><small>('Centang' untuk mengganti Surat Pengajuan)</small></label>
                  </div>

                  <label id="cur_surat">
                    <?php
                    $dokumen = explode("/", $surat["surat_pengajuan"]);
                    echo $dokumen[2];
                    ?>
                  </label>

                  <div class="custom-file hide" id="up_surat">
                    <label class="custom-file-label" for="surat_pengajuan">Unggah Surat Pengajuan</label>
                    <input type="file" class="custom-file-input" id="surat_pengajuan" name="surat_pengajuan" accept="application/pdf" data-text="(Surat Pengajuan harus dipilih)" onchange="validateThis(this); validateSize(this);">
                  </div>
                </div>

                <div class="form-group">
                  <label for="file_upload" id="label_draft">Draft Prokum <small id="err_draft_prokum" class="em-error">(Draft Prokum harus dipilih)</small></label>

                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="is_change_draft" name="is_change_draft">
                    <label for="is_change_draft" class="custom-control-label"><small>('Centang' untuk mengganti Draft Prokum)</small></label>
                  </div>

                  <label id="cur_draft">
                    <?php
                    $dokumen = explode("/", $surat["draft_prokum"]);
                    echo $dokumen[2];
                    ?>
                  </label>

                  <div class="custom-file hide" id="up_draft">
                    <label class="custom-file-label" for="draft_prokum">Unggah Draft Prokum</label>
                    <input type="file" class="custom-file-input" id="draft_prokum" name="draft_prokum" accept=".doc, .docx, .xls, .xlsx" data-text="(Draft Prokum harus dipilih)" onchange="validateThis(this);">
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