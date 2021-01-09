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

    .form-control[readonly] {
        background-color: #ffffff;
    }

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

    table td,
    table th {
        vertical-align: middle !important;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
                </div>

                <?php if ($perm == PERM_SKPD) { ?>
                    <div class="col-sm-6">
                        <div class="float-sm-right">
                            <button type="button" id="tambah_pengajuan" class="btn btn-primary btn-sm">Tambah Surat Pengajuan Prokum</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php if ($group != PERM_SKPD) { ?>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">&nbsp;</div>
                                <div class="col-md-2 text-right">
                                    <select class="custom-select custom-select-sm" id="opd_select">
                                        <option value="a">Semua OPD</option>
                                        <?php foreach ($opd as $val) {
                                            echo '<option value="' . $val["user_id"] . '">' . $val["user_full_name"] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="card-body table-responsive">
                        <table id="tab_pengajuan" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr style="vertical-align: middle;">
                                    <th class="row-number">#</th>
                                    <th>Perihal Surat</th>
                                    <th>Pengusul</th>
                                    <th>Jabatan</th>
                                    <?php if ($perm != PERM_SKPD) echo "<th>OPD</th>" ?>
                                    <th style="max-width: 110px !important">
                                        <?php if ($group == PERM_KABAG) {
                                            // echo "Status Disposisi";
                                        } else {
                                            // echo "Status";
                                        } ?>

                                        Status
                                    </th>
                                    <th style="max-width: 65px !important;">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL DISPOSISI -->
<div class="modal fade modal_add hide" id="modal_disposisi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lembar Disposisi
                    <!-- <small>(<span id="disposisi_header"></span>)</small> -->
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
                                <th class="text-left" style="width: 150px;">Jenis Pengajuan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="dis_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Perihal Surat</th>
                                <td>:</td>
                                <td class="text-left"><span id="dis_judul"></span></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 150px;">Nama</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="dis_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jabatan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="dis_jabatan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 200px;">Nomor Hp</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="dis_nomor"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jumlah Produk Hukum</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="dis_jumlah"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="disposisi_form">
                    <hr>
                    <input type="hidden" id="disposisi_pengajuan" name="pengajuan">
                    <input type="hidden" id="disposisi_status" name="status">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="diteruskan_ke">Diteruskan kepada <small id="err_diteruskan_ke" class="em-error">(Diterukan kepada harus dipilih)</small></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="diteruskan" type="checkbox" id="disposisi_penyusunan" name="penyusunan">
                                    <label for="disposisi_penyusunan">Kasubbag. Perundang-Undangan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="diteruskan" type="checkbox" id="disposisi_bantuan" name="bantuan">
                                    <label for="disposisi_bantuan">Kasubbag. Bantuan Hukum</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="diteruskan" type="checkbox" id="disposisi_administrasi" name="administrasi">
                                    <label for="disposisi_administrasi">Kasubbag. Dokumentasi dan Informasi</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="disposisi_perihal">Perihal <small id="err_disposisi_perihal" class="em-error">(Perihal harus diisi)</small></label>
                                <input type="text" class="form-control" id="disposisi_perihal" name="perihal" placeholder="Perihal" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-12">
                            <label for="disposisi_isi">Isi Disposisi <small id="err_disposisi_isi" class="em-error">(Isi Disposisi harus dipilih)</small></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_koordinasikan" name="koordinasikan">
                                    <label for="disposisi_koordinasikan">Koordinasikan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_selesaikan" name="selesaikan">
                                    <label for="disposisi_selesaikan">Selesaikan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_tindak_lanjuti" name="tindak_lanjuti">
                                    <label for="disposisi_tindak_lanjuti">Tindak Lanjuti</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_proses_sesuai" name="proses_sesuai">
                                    <label for="disposisi_proses_sesuai">Proses Sesuai Ketentuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_buatkan_laporan" name="buatkan_laporan">
                                    <label for="disposisi_buatkan_laporan">Buatkan Laporan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_bicarakan" name="bicarakan">
                                    <label for="disposisi_bicarakan">Bicarakan dengan Saya</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input class="isi" type="checkbox" id="disposisi_check_keterangan" name="check_keterangan">
                                    <label for="disposisi_check_keterangan">Keterangan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group hide" id="div_keterangan">
                                <label for="disposisi_keterangan">Keterangan <small id="err_disposisi_keterangan" class="em-error">(Keterangan harus diisi)</small></label>
                                <textarea class="form-control" id="disposisi_keterangan" name="keterangan" placeholder="Keterangan" onkeyup="validateThis(this);" onchange="validateThis(this);"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 10px 1rem;">
                <button type="button" class="btn btn-primary" id="disposisi_simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VIEW DISPOSISI -->
<div class="modal fade hide" id="modal_view_disposisi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Lembar Disposisi
                    <input type="hidden" id="vidis_pengajuan">
                    <button class="btn btn-xs btn-primary" id="vidis_download">
                        <i class="fas fa-download"></i>
                    </button>
                    <!-- <small>(<span id="vidis_header"></span>)</small> -->
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
                                <th class="text-left" style="width: 150px;">Jenis Pengajuan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="vidis_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Perihal Surat</th>
                                <td>:</td>
                                <td class="text-left"><span id="vidis_judul"></span></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 150px;">Nama</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="vidis_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jabatan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="vidis_jabatan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 200px;">Nomor Hp</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="vidis_nomor"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jumlah Produk Hukum</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="vidis_jumlah"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <label>Diteruskan kepada</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_penyusunan" disabled>
                                <label for="vidis_penyusunan">Kasubbag. Perundang-Undangan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_bantuan" disabled>
                                <label for="vidis_bantuan">Kasubbag. Bantuan Hukum</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_administrasi" disabled>
                                <label for="vidis_administrasi">Kasubbag. Dokumentasi dan Informasi</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label>Isi Disposisi</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_koordinasikan" disabled>
                                <label for="vidis_koordinasikan">Koordinasikan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_selesaikan" disabled>
                                <label for="vidis_selesaikan">Selesaikan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_tindak_lanjuti" disabled>
                                <label for="vidis_tindak_lanjuti">Tindak Lanjuti</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_proses_sesuai" disabled>
                                <label for="vidis_proses_sesuai">Proses Sesuai Ketentuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_buatkan_laporan" disabled>
                                <label for="vidis_buatkan_laporan">Buatkan Laporan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_bicarakan" disabled>
                                <label for="vidis_bicarakan">Bicarakan dengan Saya</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="vidis_check_keterangan" disabled>
                                <label for="vidis_check_keterangan">Keterangan</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">&nbsp;</div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group hide" id="div_vidis_keterangan">
                            <label for="disposisi_keterangan">Keterangan</label>
                            <textarea class="form-control" id="vidis_keterangan" placeholder="Keterangan" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VIEW DETAIL PENGAJUAN -->
<div class="modal fade" id="modal_view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pengajuan oleh <span id="view_header"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 150px;">Jenis Pengajuan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Perihal Surat</th>
                                <td>:</td>
                                <td class="text-left"><span id="view_judul"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 150px;">Nama</th>
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
                                <th class="text-left" style="width: 200px;">Nomor Hp</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_nomor"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Jumlah Produk Hukum</th>
                                <td>:</td>
                                <td class="text-left"><span id="view_jumlah"></span></td>
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
</div>

<!-- MODAL ASSIGN.KEMBALIKAN -->
<div class="modal fade" id="modal_assign">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ass_title">Melanjutkan Surat Pengajuan ke Kepala Bagian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 150px;">Jenis Pengajuan</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="ass_jenis"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Perihal Surat</th>
                                <td>:</td>
                                <td class="text-left"><span id="ass_judul"></span></td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 150px;">Nama</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="ass_nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jabatan</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="ass_jabatan"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-hover view-table" width="100%">
                                    <tr>
                                        <th class="text-left" style="width: 200px;">Nomor Hp</th>
                                        <td>:</td>
                                        <td class="text-left"><span id="ass_nomor"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Jumlah Produk Hukum</th>
                                        <td style="width: 5px;">:</td>
                                        <td class="text-left"><span id="ass_jumlah"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 10px 1rem;">
                <input type="hidden" id="ass_id" value="">

                <button type="button" class="btn bg-teal btn-sm" id="ass_simpan">Teruskan Surat ke Kabag</button>
                <button type="button" class="btn btn-danger btn-sm" id="ass_back_simpan">Kembalikan Surat</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TOTAL -->
<div class="modal fade" id="modal_view_jumlah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Progres Pengajuan Prokum</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless table-hover view-table" width="100%">
                            <tr>
                                <th class="text-left" style="width: 250px;">Jumlah Pengajuan Prokum</th>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="jum_pengajuan"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Jumlah Prokum Diproses</th>
                                <td>:</td>
                                <td class="text-left"><span id="jum_proses"></span></td>
                            </tr>
                            <tr>
                                <th class="text-left">Jumlah Prokum Dikembalikan</th>
                                <td>:</td>
                                <td class="text-left"><span id="jum_kembali"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
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