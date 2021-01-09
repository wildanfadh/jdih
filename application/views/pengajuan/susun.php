<style>
  .view-table {
    margin-bottom: 0px;
  }

  .view-table td,
  .view-table th {
    padding-top: 3px;
    padding-bottom: 3px;
  }

  #view_pdf {
    height: 560px;
  }
</style>

<div class="content-wrapper">
  <div class="content-header" style="padding-top: 2px;">
    <div class="container-fluid">
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6">
                  <h3 class="card-title">
                    <strong>Progress Penyusunan Produk Hukum</strong>
                  </h3>
                </div>
                <div class="col-md-6">
                  <h3 class="card-title" style="float: right;">
                    <strong>
                      <?php if ($disposisi["is_penyusunan"]) {
                        echo "Kasub. Bag. Perundang-Undangan";
                      } elseif ($disposisi["is_bantuan"]) {
                        echo "Kasub. Bag. Bantuan Hukum";
                      } elseif ($disposisi["is_administrasi"]) {
                        echo "Kasub. Bag. Dokumentasi dan Informasi";
                      } ?>
                    </strong>
                  </h3>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <table id="detail_pengajuan" class="table table-borderless table-hover view-table" width="100%">
                    <tr>
                      <th class="text-left" style="width: 150px;">Perihal Surat</th>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $pengajuan["judul"]; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left">Jenis Pengajuan</th>
                      <td>:</td>
                      <td class="text-left"><?php echo $pengajuan["jenis_pengajuan_text"]; ?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <table id="detail_pengajuan" class="table table-borderless table-hover view-table" width="100%">
                    <tr>
                      <th class="text-left" style="width: 150px;">OPD</th>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $pengajuan["user_full_name"]; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left">Jabatan</th>
                      <td>:</td>
                      <td class="text-left"><?php echo $pengajuan["jabatan"]; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left" style="width: 125px;">Nama</th>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $pengajuan["nama"]; ?></td>
                    </tr>
                    <tr>
                      <th class="text-left">Nomor HP</th>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $pengajuan["nomor_hp"]; ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table id="detail_pengajuan" class="table table-borderless table-hover view-table" width="100%">
                    <?php if (!empty($pengajuan["file_pengajuan_tambahan"])) {
                      $pdf = explode("!!!", $pengajuan["file_pengajuan_tambahan"]); ?>
                      <tr>
                        <th class="text-left" style="width: 220px;">File Surat Pengajuan</th>
                        <td style="width: 5px;">:</td>
                        <td class="text-left">
                          <button class="btn btn-danger btn-xs view-pdf" data-file="<?php echo $pdf[0]; ?>">
                            <i class="far fa-eye"></i>
                          </button>
                        </td>
                      </tr>

                      <tr>
                        <th class="text-left">File Pengajuan Tambahan</th>
                        <td>:</td>
                        <td class="text-left">
                          <?php if (count($pdf) > 2) { ?>
                            <button class="btn btn-danger btn-xs view-pdf" data-file="<?php echo $pdf[1]; ?>">
                              <i class="far fa-eye"></i>
                            </button>
                          <?php } else {
                            echo "-";
                          } ?>
                        </td>
                      </tr>
                    <?php } ?>

                    <tr>
                      <th class="text-left">File Pengajuan Word</th>
                      <td ">:</td>
                      <td class=" text-left">
                        <?php $word = explode("!!!", $pengajuan["file_pengajuan_word"]);
                        $count = 0;
                        $count_file = count($word);
                        foreach ($word as $key => $val) {
                          $count++;
                          if ($count_file > 1) {
                            if (($count_file - 1) != $key) { ?>
                              <button class="btn btn-primary btn-xs download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word <?php echo $count; ?>">
                                <i class=" fas fa-download"></i>
                              </button>
                            <?php }
                          } else { ?>
                            <button class="btn btn-primary btn-xs download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word <?php echo $count; ?>">
                              <i class=" fas fa-download"></i>
                            </button>
                        <?php }
                        } ?>
                      </td>
                    </tr>

                    <tr>
                      <th class="text-left">File Pengajuan Excel</th>
                      <td>:</td>
                      <td class="text-left">
                        <?php $excel = explode("!!!", $pengajuan["file_pengajuan_excel"]);
                        $count = 0;
                        $count_file = count($excel);
                        foreach ($excel as $key => $val) {
                          $count++;
                          if ($count_file > 1) {
                            if (($count_file - 1) != $key) { ?>
                              <button class="btn btn-success btn-xs download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel <?php echo $count; ?>">
                                <i class="fas fa-download"></i>
                              </button>
                            <?php }
                          } else { ?>
                            <button class="btn btn-success btn-xs download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel <?php echo $count; ?>">
                              <i class="fas fa-download"></i>
                            </button>
                        <?php }
                        } ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <hr>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input class="isi" type="checkbox" <?php echo $disposisi["is_kordinasikan"] ? "checked" : ""; ?>>
                      <label for="disposisi_koordinasikan">Koordinasikan</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input class="isi" type="checkbox" <?php echo $disposisi["is_selesaikan"] ? "checked" : ""; ?>>
                      <label for="disposisi_selesaikan">Selesaikan</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input class="isi" type="checkbox" <?php echo $disposisi["is_tindak_lanjuti"] ? "checked" : ""; ?>>
                      <label for="disposisi_tindak_lanjuti">Tindak Lanjuti</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input class="isi" type="checkbox" <?php echo $disposisi["is_proses_ketentuan"] ? "checked" : ""; ?>>
                      <label for="disposisi_proses_sesuai">Proses Sesuai Ketentuan</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input class="isi" type="checkbox" <?php echo $disposisi["is_laporan"] ? "checked" : ""; ?>>
                      <label for="disposisi_buatkan_laporan">Buatkan Laporan</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input class="isi" type="checkbox" <?php echo $disposisi["is_bicarakan"] ? "checked" : ""; ?>>
                      <label for="disposisi_bicarakan">Bicarakan dengan Saya</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <form id="form_save" style="width: 100%;">

          <div class="col-md-12 append-here">
            <div class="card">
              <div class="card-header">
                <label class="card-title" for="judul">Jumlah Usulan <small id="err_jumlah" class="em-error">(Jumlah Maksimal Produk Hukum : <?= $pengajuan["jumlah_prokum"]; ?>)</small></label>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group" style="margin-bottom: 0px;">
                      <!-- <label for="judul">Tambah Penyusunan <small id="err_jumlah" class="em-error">(Jumlah Maksimal Produk Hukum : <?= $pengajuan["jumlah_prokum"]; ?>)</small></label> -->

                      <div class="input-group">
                        <input type="number" max="<?= $pengajuan["jumlah_prokum"]; ?>" class="form-control" id="jumlah" placeholder="Isi Jumlah Produk Hukum di sini">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-info" id="jumlah_change">Produk Hukum</button>
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

<!-- MODAL PDF -->
<div class="modal fade" id="modal_pdf">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div id="view_pdf"></div>
      </div>
    </div>
  </div>
</div>