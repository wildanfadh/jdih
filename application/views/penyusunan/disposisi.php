<style>
    .swal2-popup.swal2-modal.swal2-show {
        width: 26em !important;
    }

    .dropdown-toggle::after {
        margin-left: 0px;
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tab_pengajuan" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Nomor Urut</th>
                                    <th>Judul</th>
                                    <th class="row-number">Status</th>
                                    <th style="width: 130px !important">Disposisi</th>
                                    <th style="width: 100px !important;">Aksi</th>
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
                                    <option value="<?php // echo PENYUSUNAN_BATAL; ?>">Dibatalkan</option>
                                    <option value="<?php // echo PENYUSUNAN_GABUNG; ?>">Penggabungan</option>
                                    <option value="<?php // echo PENYUSUNAN_INDIVIDU; ?>">Individu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mod_keterangan">Keterangan <small id="err_mod_keterangan" class="em-error">(Keterangan harus diisi)</small></label>
                                <textarea class="form-control" id="mod_keterangan" name="keterangan" placeholder="Keterangan" onkeyup="validateThis(this);" onchange="validateThis(this);" style="resize: vertical;"></textarea>
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
                <h4 class="modal-title">Detail Penyusunan <small>(<span id="view_header"></span>)</small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="view_table" class="table table-borderless table-hover" width="100%">
                            <tr>
                                <td class="text-left" style="width: 215px;">Judul</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_judul"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 215px;">Status</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_status"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 215px;">Keterangan</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_keterangan"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DISPOSISI -->
<div class="modal fade" id="modal_disposisi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Paraf/TTD Penyusunan Prokum <small>(<span id="disposisi_header"></span>)</small> oleh <span id="disposisi_oleh"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="disposisi_form">
                    <input type="hidden" id="disposisi_penyusunan" name="penyusunan">
                    <input type="hidden" id="disposisi_id" name="disposisi">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="disposisi_status">Status <small id="err_disposisi_status" class="em-error">(Status harus dipilih)</small></label>
                                <select class="custom-select" id="disposisi_status" name="status" onchange="validateThis(this);">
                                    <option value="">-- Pilih Status</option>
                                    <option value="1">Terima</option>
                                    <option value="2" disabled>Kembalikan</option>
                                </select>
                            </div>
                        </div>
                    </div>

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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="disposisi_perihal">Perihal <small id="err_disposisi_perihal" class="em-error">(Perihal harus diisi)</small></label>
                                <input type="text" class="form-control" id="disposisi_perihal" name="perihal" placeholder="Perihal" onkeyup="validateThis(this);" onchange="validateThis(this);">
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