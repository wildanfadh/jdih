<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-7">
                    <h1 class="m-0 text-dark"><?php echo ucwords($title); ?></h1>
                </div>

                <div class="col-sm-5">
                    <div class="float-sm-right">
                        <button type="button" id="tambah_surat" class="btn btn-primary btn-sm">Tambah Surat Pengajuan</button>
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
                        <table id="skpd_tab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>No. Lacak</th>
                                    <th>No. Surat</th>
                                    <th>SKPD</th>
                                    <th class="row-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($surat)) {
                                    foreach ($surat as $key => $val) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $val["no_lacak"]; ?></td>
                                            <td><?php echo $val["nomor_surat"]; ?></td>
                                            <td><?php echo $val["nama_skpd"]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning edit" data-id="<?php echo $val["id"] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger delete" data-id="<?php echo $val["id"] ?>">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php $i++;
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>