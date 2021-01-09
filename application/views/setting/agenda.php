<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kegiatan</h1>
                </div>

                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button type="button" id="tambah_agenda" class="btn btn-primary btn-sm">Tambah Kegiatan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="agenda_tab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Tempat</th>
                                    <th class="row-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($agenda as $key => $val) {
                                    $tanggal = date("d/m/Y", strtotime($val["tanggal_mulai"])) . " - ";
                                    $tanggal .= date("d/m/Y", strtotime($val["tanggal_selesai"]));
                                ?>

                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val["judul"]; ?></td>
                                        <td><?php echo $tanggal; ?></td>
                                        <td><?php echo $val["waktu"]; ?></td>
                                        <td><?php echo $val["tempat"]; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning edit" data-id="<?php echo $val["id"] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete" data-id="<?php echo $val["id"] ?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>