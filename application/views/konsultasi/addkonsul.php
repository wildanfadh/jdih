<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><?php echo $title; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form id="tambah_konsultasi">
                                <!-- 
                                <div class="form-group">
                                    <label for="user">Kirim Ke <small id="err_user" class="em-error">(Penerima harus dipilih)</small></label>
                                    <select class="custom-select" id="user" name="user" onkeyup="validateThis(this);" onchange="validateThis(this);">
                                        <option value="">-- Pilih Penerima</option>
                                        <?php foreach ($opd as $val) {
                                            if (in_array($val["group_id"], array(PERM_KABAG, PERM_BANKUM, PERM_PERUNDANGAN, PERM_DOKUM))) {
                                                echo "<option value='" . $val["user_id"] . "' data-group='" . $val["group_id"] . "'>" . $val["user_full_name"] . " (" . $val["group_description"] . ") </option>";
                                            }
                                        } ?>
                                    </select>
                                </div> -->
                                <input type="hidden" name="idtogroup" id="idtogroup">
                                <div class="form-group">
                                    <label for="nama">Nama <small id="err_nama" class="em-error">(Nama harus diisi)</small></label>
                                    <input class="form-control" id="nama" name="nama" placeholder="Nama" onkeyup="validateThis(this);" onchange="validateThis(this);">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan <small id="err_jabatan" class="em-error">(Jabatan harus diisi)</small></label>
                                    <input class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" onkeyup="validateThis(this);" onchange="validateThis(this);">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Judul <small id="err_subject" class="em-error">(Judul harus diisi)</small></label>
                                    <input class="form-control" id="subject" name="subject" placeholder="Judul" onkeyup="validateThis(this);" onchange="validateThis(this);">
                                </div>
                                <div class="form-group">
                                    <label for="message">Pesan <small id="err_message" class="em-error">(Pesan harus diisi)</small></label>
                                    <textarea id="message" name="message" class="form-control text-summer" onkeyup="validateThis(this);" onchange="validateThis(this);">

                                </textarea>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer">
                            <div class="float-right">
                                <!-- <button type="button" class="btn btn-default" id="simpan"><i class="fas fa-pencil-alt"></i> Simpan</button> -->
                                <button type="button" class="btn btn-primary" id="kirim"><i class="far fa-envelope"></i> Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>