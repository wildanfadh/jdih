<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
                </div>

                <!-- <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a type="button" id="tambah_disposisi" href="<? echo base_url("pengajuan/tambah_disposisi") ?>" class="btn btn-primary btn-sm">Tambah Disposisi</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tab_disposisi" class="table table-bordered table-hover text-center" width="100%">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Posisi</th>
                                    <!-- <th>Pengajuan Dari</th> -->
                                    <th>Di koordinasikan</th>
                                    <th>Di Selesaikan</th>
                                    <th>Di Tindak Lanjuti</th>
                                    <th>Di Proses Ketentuan</th>
                                    <th>Di Laporkan</th>
                                    <th>Di Bicarakan</th>
                                    <th class="row-number">Status</th>
                                    <th>Perihal</th>
                                    <th>Keterangan</th>
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

<!-- Modal Disposisi -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lanjutkan Disposisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-disposisi" id="form-disposisi">
                    <input type="hidden" class="custom-control-input" id="id" name="id">
                    <input type="hidden" class="custom-control-input" id="penyusunan" name="penyusunan">
                    <input type="hidden" class="custom-control-input" id="idTo" name="idTo">

                    <div class="form-group">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary" for="status">Status</label>
                            </div>
                            <select class="custom-select" id="status" name="status">
                                <option selected value="0">Pilih...</option>
                                <option value="1">Terima</option>
                                <option value="0">Kembalikan</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group hide" id="id_to">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary" for="to">Kirim ke</label>
                            </div>
                            <select class="custom-select" id="to" name="to">
                                <option selected value="0">Pilih...</option>
                                <option value="97" class="asisten hide">Asisten</option>
                                <option value="98" class="sekda hide">Sekda</option>
                                <option value="99" class="walikota hide">Walikota</option>
                                <option value="0" class="kabag hide">Kabag</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="kordinasi" name="kordinasi">
                            <label class="custom-control-label" for="kordinasi">Koordinasikan</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="selesaikan" name="selesaikan">
                            <label class="custom-control-label" for="selesaikan">Selesaikan</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="tindak" name="tindak">
                            <label class="custom-control-label" for="tindak">Tindak Lanjuti</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="proses" name="proses">
                            <label class="custom-control-label" for="proses">Proses Ketentuan</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="laporan" name="laporan">
                            <label class="custom-control-label" for="laporan">Laporkan</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="bicarakan" name="bicarakan">
                            <label class="custom-control-label" for="bicarakan">Bicarakan</label>
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline my-3 mx-5">
                            <input type="checkbox" class="custom-control-input" id="keterangan" name="keterangan">
                            <label class="custom-control-label" for="keterangan">Tambah Keterangan</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="perihal" class="col-form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal">
                    </div>


                    <div class="form-group txtKeterangan hide" id="txtKeterangan">
                        <label for="BoxKeterangan" class="col-form-label">Keterangan</label>
                        <textarea class="form-control" id="BoxKeterangan" name="BoxKeterangan"></textarea>
                    </div>

                    <div class="float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"> Simpan </button>
                    </div>

                </form>
            </div>

        </div>