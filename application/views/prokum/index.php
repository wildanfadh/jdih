<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0 text-dark"><?php echo ucwords($tipe["texted"]); ?></h1>
                </div>

                <?php if ($group == PERM_ADM or $group == PERM_DOKUM) { ?>
                    <div class="col-sm-4">
                        <div class="float-sm-right">
                            <button type="button" id="tambah_prokum" class="btn btn-primary btn-sm">Tambah <?php echo ucwords($tipe["texted"]); ?></button>
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
                    <div class="card-body table-responsive">
                        <table id="jenis_tab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Judul</th>
                                    <th>Tentang</th>
                                    <th>Tahun</th>
                                    <th class="row-number">Publish</th>
                                    <th class="row-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($prokum as $key => $val) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val["subjek_singkat"]; ?></td>
                                        <td><?php echo $val["tentang"]; ?></td>
                                        <td><?php echo $val["tahun_peraturan"]; ?></td>
                                        <td>
                                            <?php if ($val["is_online"]) { ?>
                                                <span class="btn btn-sm btn-block btn-outline-success">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                            <?php } else { ?>
                                                <span class="btn btn-sm btn-block btn-outline-danger">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                            <?php } ?>
                                        </td>
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