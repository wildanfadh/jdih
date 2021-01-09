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
            <form id="tambah_group" role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Nama Group <small id="err_name" class="em-error">(Nama Group harus diisi)</small></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Group" onkeyup="validateThis(this);" onchange="validateThis(this);" value="<?php echo $group["name"]; ?>">
                </div>

                <div class="form-group">
                  <label for="description">Deskripsi <small id="err_description" class="em-error">(Deskripsi harus diisi)</small></label>
                  <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi" onkeyup="validateThis(this);" onchange="validateThis(this);"><?php echo $group["description"]; ?></textarea>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="is_active" name="is_active" <?php echo $group["is_active"]?"checked":""; ?>>
                    <label for="is_active" class="custom-control-label">Aktif <small>('Centang' untuk mengaktifkan Group)</small></label>
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