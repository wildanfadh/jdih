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
            <form id="tambah_pengajuan" role="form" action="<? echo base_url("pengajuan/save_disposisi") ?>">
              <div class="card-body m-3">

                <div class="row">

                    <div class="col-md-6">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Judul</span>
                            </div>
                            <input type="text" class="form-control" name="judul" placeholder="Judul Disposisi" aria-label="Judul" aria-describedby="basic-addon1">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_kordinasikan" >
                                    <label class="form-check-label" for="exampleCheck1">Di Koordinasikan</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_selesaikan">
                                    <label class="form-check-label" for="exampleCheck1">Di Selesaikan</label>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_tindak_lanjuti">
                                    <label class="form-check-label" for="exampleCheck1">Di Tindak Lanjuti </label>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_proses_ketentuan">
                                    <label class="form-check-label" for="exampleCheck1">Di Proses Ketentuan</label>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_laporan">
                                    <label class="form-check-label" for="exampleCheck1">Di Laporkan</label>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_bicarakan">
                                    <label class="form-check-label" for="exampleCheck1">Di Bicarakan</label>
                                </div>
                            </div>

                        </div>
                        

                    </div>



                    <div class="col-md-6">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Status</span>
                            </div>
                                <select class="form-control" name="status">
                                    <option>Status</option>
                                    <option>Diterima</option>
                                    <option>Ditolak</option>
                                </select>
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Perihal</span>
                            </div>
                            <input type="text" name="perihal" class="form-control" placeholder="" aria-label="Judul" aria-describedby="basic-addon1">
                        </div>

                    </div>


                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Keterangan</span>
                        </div>
                        <textarea class="form-control" name="keterangan" aria-label="With textarea"></textarea>
                    </div>

                </div>

              <!-- <div class="button-fixed"> -->
                <button type="submit" class="btn btn-primary float-right mt-3">Simpan</button>
              <!-- </div> -->
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>