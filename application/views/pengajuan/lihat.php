<style>
  #view_pdf {
    height: 560px;
  }
</style>

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
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <table id="tab_pengajuan" class="table table-borderless table-hover" width="100%">
                    <tr>
                      <td class="text-left" style="width: 215px;">Judul</td>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $data["judul"]; ?></td>
                    </tr>
                    <tr>
                      <td class="text-left" style="width: 215px;">Nama</td>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $data["nama"]; ?></td>
                    </tr>
                    <tr>
                      <td class="text-left" style="width: 215px;">Jabatan</td>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $data["jabatan"]; ?></td>
                    </tr>
                    <tr>
                      <td class="text-left" style="width: 215px;">Nomor HP</td>
                      <td style="width: 5px;">:</td>
                      <td class="text-left"><?php echo $data["nomor_hp"]; ?></td>
                    </tr>

                    <?php if (!empty($data["file_pengajuan_tambahan"])) {
                      $pdf = explode("!!!", $data["file_pengajuan_tambahan"]); ?>

                      <tr>
                        <td class="text-left" style="width: 215px;">File Surat Pengajuan</td>
                        <td style="width: 5px;">:</td>
                        <td class="text-left">
                          <button class="btn btn-danger btn-sm view-pdf" data-file="<?php echo $pdf[0]; ?>">
                            <i class="far fa-eye"></i>
                          </button>
                        </td>
                      </tr>

                      <?php if (count($pdf) > 2) { ?>
                        <tr>
                          <td class="text-left" style="width: 215px;">File Pengajuan Tambahan</td>
                          <td style="width: 5px;">:</td>
                          <td class="text-left">
                            <button class="btn btn-danger btn-sm view-pdf" data-file="<?php echo $pdf[1]; ?>">
                              <i class="far fa-eye"></i>
                            </button>
                          </td>
                        </tr>
                    <?php }
                    } ?>

                    <tr>
                      <td class="text-left" style="width: 215px;">File Pengajuan Word</td>
                      <td style="width: 5px;">:</td>
                      <td class="text-left">
                        <?php $word = explode("!!!", $data["file_pengajuan_word"]);
                        $count = 0;
                        $count_file = count($word);
                        foreach ($word as $key => $val) {
                          $count++;
                          if ($count_file > 1) {
                            if (($count_file - 1) != $key) { ?>
                              <button class="btn btn-primary btn-sm download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word <?php echo $count; ?>">
                                <i class=" fas fa-download"></i>
                              </button>
                            <?php }
                          } else { ?>
                            <button class="btn btn-primary btn-sm download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word <?php echo $count; ?>">
                              <i class=" fas fa-download"></i>
                            </button>
                        <?php }
                        } ?>
                      </td>
                    </tr>

                    <tr>
                      <td class="text-left" style="width: 215px;">File Pengajuan Excel</td>
                      <td style="width: 5px;">:</td>
                      <td class="text-left">
                        <?php $excel = explode("!!!", $data["file_pengajuan_excel"]);
                        $count = 0;
                        $count_file = count($excel);
                        foreach ($excel as $key => $val) {
                          $count++;
                          if ($count_file > 1) {
                            if (($count_file - 1) != $key) { ?>
                              <button class="btn btn-success btn-sm download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel <?php echo $count; ?>">
                                <i class="fas fa-download"></i>
                              </button>
                            <?php }
                          } else { ?>
                            <button class="btn btn-success btn-sm download" data-file="<?php echo $val; ?>" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel <?php echo $count; ?>">
                              <i class="fas fa-download"></i>
                            </button>
                        <?php }
                        } ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="modal_pdf">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div id="view_pdf"></div>
      </div>
    </div>
  </div>
</div>