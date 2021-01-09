<style>
    .dropdown-toggle::after {
        margin-left: 0px;
    }

    [class*=icheck-]>input:first-child:disabled+input[type=hidden]+label,
    [class*=icheck-]>input:first-child:disabled+input[type=hidden]+label::before,
    [class*=icheck-]>input:first-child:disabled+label,
    [class*=icheck-]>input:first-child:disabled+label::before {
        opacity: 1;
    }

    #detail_pengajuan td,
    #detail_pengajuan th {
        padding-top: 3px;
        padding-bottom: 3px;
    }

    #view_pdf {
        height: 560px;
    }

    .view-table {
        margin-bottom: 0px;
    }

    .view-table td,
    .view-table th {
        padding: .5rem !important;
    }
</style>

<div class="content-wrapper">
    <?php if ($pengajuan == "a") { ?>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="content-header" style="padding-top: 2px;">
            <div class="container-fluid">
            </div>
        </div>
    <?php } ?>

    <section class="content">
        <?php if ($pengajuan == "a") { ?>

        <?php } else { ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">
                                        <strong>Detail Pengajuan Produk Hukum</strong>
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
                                            <th class="text-left" style="width: 125px;">Nama Pengusul</th>
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
                                            <td>:</td>
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
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-sm btn-primary" id="btn_tambah_penyusunan" data-id="<?= $pengajuan["id"] ?>">Tambah Penyusunan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <?php if ($pengajuan == "a") {
                                    echo "&nbsp;";
                                } else { ?>
                                    <h3 class="card-title">
                                        <strong><?= $title; ?></strong>
                                    </h3>
                                <?php } ?>
                            </div>
                            <div class="col-md-2 text-right">
                                <?php if (!empty($opd)) { ?>
                                    <select class="custom-select custom-select-sm" id="opd_select">
                                        <option value="0">Semua OPD</option>
                                        <?php foreach ($opd as $val) {
                                            echo '<option value="' . $val["user_id"] . '">' . $val["user_full_name"] . '</option>';
                                        } ?>
                                    </select>
                                <?php } else {
                                    echo "&nbsp;";
                                } ?>
                            </div>
                            <?php if ($paraf > 0) { ?>
                                <div class="col-md-2 text-right">
                                    <select class="custom-select custom-select-sm" id="paraf_select">
                                        <option value="1" <?php echo ($paraf == 1) ? "selected" : ""; ?>>Belum Paraf/Tanda tangan</option>
                                        <option value="2" <?php echo ($paraf == 2) ? "selected" : ""; ?>>Sudah Paraf/Tanda tangan</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-2 text-right">
                                    <select class="custom-select custom-select-sm" id="daftar_select">
                                        <option value="a">Semua Progress</option>
                                        <option value="<?= PENYUSUNAN_PROSES ?>">Menunggu Paraf</option>
                                        <option value="<?= PENYUSUNAN_DRAFT ?>">Menunggu Proses Kasubbag</option>
                                        <option value="<?= PENYUSUNAN_KEMBALI ?>">Prokum Usulan Dikembalikan</option>
                                        <option value="<?= PENYUSUNAN_SIAP ?>">Prokum Siap Diambil</option>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tab_penyusunan" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th style="width: 130px;">No. Penyusunan</th>
                                    <th>Judul Prokum</th>
                                    <?php if ($pengajuan == "a") { ?>
                                        <th style="width: 120px;">Nama Pengusul</th>
                                    <?php }

                                    if (!empty($opd)) { ?>
                                        <th style="width: 120px;">OPD</th>
                                    <?php } ?>
                                    <th style="max-width: 110px !important">Progress</th>
                                    <th style="max-width: 80px !important;">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data <small>(<span id="mod_ubah_header"></span>)</small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="mod_ubah">
                    <input type="hidden" id="mod_id" name="id">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="mod_judul">Judul <small id="err_mod_judul" class="em-error">(Judul harus diisi)</small></label>
                                <input type="text" class="form-control" id="mod_judul" name="judul" placeholder="Judul" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mod_status">Status Penyusunan <small id="err_mod_status" class="em-error">(Status Penyusunan harus dipilih)</small></label>
                                <select class="custom-select form-control" id="mod_status" name="status" onchange="validateThis(this);">
                                    <option value="">-- Pilih Status Penyusunan</option>
                                    <option value="<?php echo PENYUSUNAN_DRAFT; ?>">Diproses</option>
                                    <option value="<?php echo PENYUSUNAN_KEMBALI; ?>">Dikembalikan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mod_keterangan">Keterangan <small id="err_mod_keterangan" class="em-error">(Keterangan harus diisi)</small></label>
                                <textarea class="form-control" id="mod_keterangan" name="keterangan" placeholder="Keterangan" onkeyup="validateThis(this);" onchange="validateThis(this);" style="resize: vertical;"></textarea>
                            </div>
                        </div>


                        <div class="col-md-6 hide" id="mod_div_file_keterangan">
                            <div class="form-group">
                                <label for="mod_file_keterangan">File Keterangan</label>

                                <div class="custom-file">';
                                    <label class="custom-file-label" for="mod_file_keterangan">Pilih File Keterangan</label>
                                    <input type="file" class="custom-file-input" id="mod_file_keterangan" name="file[]" accept=".pdf" onchange="validateThis(this);">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="mod_simpan">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VIEW -->
<div class="modal fade" id="modal_view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Penyusunan
                    <small><span id="view_header"></span></small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 190px;">Judul Produk Hukum</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_judul"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Nomor Penyusunan</th>
                                <td>:</td>
                                <td class="text-left"><span id="view_urut"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Keterangan</th>
                                <td>:</td>
                                <td class="text-left"><span id="view_keterangan"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Jenis Pengajuan</th>
                                <td>:</td>
                                <td class="text-left"><span id="view_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Perihal</th>
                                <td>:</td>
                                <td class="text-left"><span id="view_perihal"></span></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 150px;">Nama Pengusul</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="view_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jabatan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="view_jabatan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 110px;">OPD</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="view_opd"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Nomor Hp</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="view_nomor"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 220px;">File Surat Pengajuan</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left" id="view_surat_pengajuan"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">File Pengajuan Tambahan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="view_surat_tambahan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 190px;">File Pengajuan Word</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left" id="view_word"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">File Pengajuan Excel</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="view_excel"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer paraf-kabag">
                <input type="hidden" id="view_id">
                <input type="hidden" id="view_otoritas">

                <button type="button" class="btn btn-primary btn-sm" id="paraf_kabag_btn">Ajukan Paraf ke Kabag</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARAF -->
<div class="modal fade" id="modal_paraf">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Paraf/Tanda Tangan Penyusunan Produk Hukum <small id="paraf_header"></small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 190px;">Judul Produk Hukum</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="paraf_judul"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Nomor Penyusunan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="paraf_urut"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left" style="width: 150px;">Jenis Pengajuan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="paraf_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left" style="width: 150px;">Perihal</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="paraf_perihal"></span></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 150px;">Nama Pengusul</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="paraf_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jabatan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="paraf_jabatan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 110px;">OPD</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="paraf_opd"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Nomor Hp</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="paraf_nomor"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="margin-top: 5px; margin-bottom: 23px;">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="paraf_kabag" disabled>
                                <label for="paraf_kabag">Telah diparaf oleh Kepala Bagian</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="paraf_sekda" disabled>
                                <label for="paraf_sekda">Telah diparaf/ditandatangani oleh Sekretariat Daerah</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="paraf_asisten" disabled>
                                <label for="paraf_asisten">Telah diparaf oleh Asisten</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="paraf_walikota" disabled>
                                <label for="paraf_walikota">Telah diparaf/ditandatangani oleh Walikota</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PARAF PRODUK HUKUM -->
                <form id="paraf_form">
                    <hr style="margin-top: 5px;">
                    <input type="hidden" id="paraf_penyusunan" name="penyusunan">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="paraf_status">Diparaf/Ditandangani Oleh <small id="err_paraf_status" class="em-error">(Paraf Oleh harus dipilih)</small></label>
                                <select class="custom-select form-control" id="paraf_status" name="paraf" onchange="validateThis(this);">
                                    <option value="">-- Pilih Paraf Oleh</option>
                                    <option value="<?php echo PERM_ASISTEN; ?>" data-ttd="0">Diparaf Asisten</option>
                                    <option value="<?php echo PERM_SEKDA; ?>" data-ttd="0">Diparaf Sekretariat Daerah</option>
                                    <option value="<?php echo PERM_SEKDA; ?>" data-ttd="1">Ditandatangani Sekretariat Daerah</option>
                                    <option value="<?php echo PERM_WALIKOTA; ?>" data-ttd="1">Ditandatangani Walikota</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="paraf_ready">Siap Diambil</label>
                                <select class="custom-select form-control" id="paraf_ready" name="ready" onchange="validateThis(this);">
                                    <option value="0">Belum Siap</option>
                                    <option value="1">Sudah Siap Diambil</option>
                                </select>
                            </div>
                        </div> -->
                    </div>
                </form>

                <!-- INPUT NOMOR PRODUK HUKUM -->
                <form id="produk_form">
                    <hr style="margin-top: 5px;">
                    <input type="hidden" id="produk_penyusunan" name="penyusunan">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="produk_hukum">Nomor Produk Hukum <small id="err_produk_hukum" class="em-error">(Nomor Produk Hukum harus dipilih)</small></label>
                                <input type="text" class="form-control" id="produk_hukum" name="produk_hukum" placeholder="Nomor Produk Hukum" onchange="validateThis(this);" onkeyup="validateThis(this);">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="produk_file">File Produk Hukum <small id="err_produk_file" class="em-error">(File Produk Hukum harus dipilih)</small></label>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="produk_file">Pilih File Produk Hukum</label>
                                    <input type="file" class="custom-file-input" id="produk_file" name="file[]" accept=".pdf" multiple onchange="validateThis(this);">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- LIHAT HASIL JADI PRODUK HUKUM -->
                <div id="view_produk">
                    <hr style="margin-top: 5px;">

                    <div class="row">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 240px;">Nomor Produk Hukum</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_produk_nomor"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">File Produk Hukum</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_produk_file"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer paraf-footer">
                <button type="button" class="btn btn-primary btn-sm" id="paraf_simpan">Paraf/Tanda Tangan Penyusunan</button>
                <button type="button" class="btn btn-primary btn-sm" id="produk_simpan">Simpan Nomor Produk Hukum</button>

                <button type="button" class="btn btn-primary btn-sm" id="ready_simpan">Produk Hukum Siap Diambil</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARAF SELF -->
<div class="modal fade" id="modal_paraf_self">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Paraf/Tanda Tangan Penyusunan Produk Hukum <small id="paraf_header"></small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 190px;">Judul Produk Hukum</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="self_judul"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Nomor Penyusunan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="self_urut"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left" style="width: 150px;">Jenis Pengajuan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="self_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left" style="width: 150px;">Perihal</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="self_perihal"></span></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 150px;">Nama Pengusul</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="self_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jabatan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="self_jabatan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 110px;">OPD</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="self_opd"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Nomor Hp</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="self_nomor"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 220px;">File Surat Pengajuan</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left" id="self_surat_pengajuan"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">File Pengajuan Tambahan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="self_surat_tambahan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 190px;">File Pengajuan Word</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left" id="self_word"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">File Pengajuan Excel</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="self_excel"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer paraf-footer">
                <?php if (in_array($group, array(PERM_KABAG, PERM_ASISTEN))) {
                    echo '<button type="button" class="btn btn-primary btn-sm" id="self_simpan">Paraf Penyusunan</button>';
                } elseif ($group == PERM_SEKDA) {
                    echo '<button type="button" class="btn btn-primary btn-sm" id="self_simpan">Paraf Penyusunan</button>';
                    echo '<button type="button" class="btn btn-secondary btn-sm" id="self_simpan_ttd">Tanda Tangan Penyusunan</button>';
                } elseif ($group == PERM_WALIKOTA) {
                    echo '<button type="button" class="btn btn-secondary btn-sm" id="self_simpan_ttd">Tanda Tangan Penyusunan</button>';
                } ?>
            </div>
        </div>
    </div>
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