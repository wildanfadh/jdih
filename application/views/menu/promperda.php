<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Promperda</h1>
                </div>

                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button type="button" id="btn_tambah" class="btn btn-primary btn-sm">Tambah Promperda</button>
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
                        <table id="tab_data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Keterangan</th>
                                    <th>Realisasi</th>
                                    <th class="row-aksi">Persentase</th>
                                    <th class="row-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($promperda as $key => $val) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val["keterangan"]; ?></td>
                                        <td><?php echo $val["realisasi"]; ?></td>
                                        <td><?php echo $val["persentase"]; ?></td>
                                        <td>
                                            <a href="<?php echo base_url("uploads/") . $val["filename"]; ?>" class="btn btn-xs btn-info preview" data-id="<?php echo $val["id"] ?>" target="_blank">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-xs btn-warning edit" data-id="<?php echo $val["id"] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-danger delete" data-id="<?php echo $val["id"] ?>">
                                                <i class="fas fa-trash"></i>
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