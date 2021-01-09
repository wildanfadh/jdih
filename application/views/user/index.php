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
                <div class="col-sm-10">
                    <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
                </div>

                <div class="col-sm-2">
                    <button type="button" id="tambah_user" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static" data-keyboard='false'>Tambah User</button>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="tab_user" class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Nama Lengkap</th>
                                    <th>Group</th>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modal_tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tam_form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tam_username">Username <small id="err_tam_username" class="em-error">(Username harus diisi)</small></label>
                                <input type="text" class="form-control" id="tam_username" name="username" placeholder="Username" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tam_password">Password <small id="err_tam_password" class="em-error">(Password harus diisi)</small></label>
                                <input type="password" class="form-control" id="tam_password" name="password" placeholder="Password" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tam_email">Email <small id="err_tam_email" class="em-error">(Email harus diisi)</small></label>
                                <input type="text" class="form-control" id="tam_email" name="email" placeholder="Email" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tam_phone">No. Handphone <small id="err_tam_phone" class="em-error">(No. Handphone harus diisi)</small></label>
                                <input type="number" class="form-control" id="tam_phone" name="phone" placeholder="No. Handphone" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tam_fullname">Nama Lengkap <small id="err_tam_fullname" class="em-error">(Nama Lengkap harus diisi)</small></label>
                                <input type="text" class="form-control" id="tam_fullname" name="full_name" placeholder="Nama Lengkap" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tam_group">Group <small id="err_tam_group" class="em-error">(Group harus dipilih)</small></label>
                                <select class="custom-select form-control" id="tam_group" name="group" onchange="validateThis(this);">
                                    <option value="">-- Pilih Group</option>

                                    <?php foreach ($group_list as $gro) {
                                        echo "<option value='" . $gro["id"] . "'>" . $gro["description"] . "</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="tam_save">Tambah User</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah User <small>(<span id="edi_header"></span>)</small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edi_form" autocomplete="off">
                    <input type="hidden" id="edi_id" name="user">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edi_email">Email <small id="err_edi_email" class="em-error">(Email harus diisi)</small></label>
                                <input type="text" class="form-control" id="edi_email" name="email" placeholder="Email" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edi_phone">No. Handphone <small id="err_edi_phone" class="em-error">(No. Handphone harus diisi)</small></label>
                                <input type="number" class="form-control" id="edi_phone" name="phone" placeholder="No. Handphone" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edi_fullname">Nama Lengkap <small id="err_edi_fullname" class="em-error">(Nama Lengkap harus diisi)</small></label>
                                <input type="text" class="form-control" id="edi_fullname" name="full_name" placeholder="Nama Lengkap" onkeyup="validateThis(this);" onchange="validateThis(this);">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edi_group">Group <small id="err_edi_group" class="em-error">(Group harus dipilih)</small></label>
                                <select class="custom-select form-control" id="edi_group" name="group" onchange="validateThis(this);">
                                    <option value="">-- Pilih Group</option>

                                    <?php foreach ($group_list as $gro) { ?>
                                        <option value="<?php echo $gro["id"]; ?>"><?php echo $gro["description"]; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edi_password">Password <small id="war_edi_password" class="em-warning">(Jika password diisi, akan mengganti password sebelumnya)</small></label>
                                <input type="password" class="form-control" id="edi_password" name="password" placeholder="Password" autocomplete="no">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-primary" id="edi_save">Simpan User</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VIEW -->
<div class="modal fade" id="modal_view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail User <small>(<span id="view_header"></span>)</small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="view_table" class="table table-borderless table-hover" width="100%">
                            <tr>
                                <td class="text-left" style="width: 140px;">Username</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_username"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left">Email</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_email"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left">Nama Lengkap</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_fullname"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left">No. Handphone</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_phone"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left">Group</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_group"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>