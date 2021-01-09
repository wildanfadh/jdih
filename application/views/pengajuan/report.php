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
                <div class="col-sm-8">
                    <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
                </div>

                <?php if ($perm == PERM_SKPD) { ?>
                    <div class="col-sm-4">
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">&nbsp;</div>
                            <div class="col-md-2 text-right">
                                <select class="custom-select custom-select-sm" id="daftar_select">
                                    <option value="a">Semua Progress</option>
                                    <option value="<?= PENGAJUAN_MASUK ?>">Usulan Masuk</option>
                                    <option value="<?= PENGAJUAN_PROSES ?>">Menunggu Proses Kasubbag</option>
                                    <option value="<?= PENGAJUAN_KEMBALI ?>">Usulan Dikembalikan</option>
                                    <option value="<?= PENGAJUAN_TERUS ?>">Menunggu Disposisi Kabag</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="tab_pengajuan" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr style="vertical-align: middle;">
                                    <th class="row-number">#</th>
                                    <th>Perihal Surat</th>
                                    <th>Pengusul</th>
                                    <th>Jabatan</th>
                                    <?php if ($perm != PERM_SKPD) echo "<th>OPD</th>" ?>
                                    <th style="max-width: 110px !important">Progress</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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