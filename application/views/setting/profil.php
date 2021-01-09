<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profil</h1>
                </div>

                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button type="button" id="tambah_profil" class="btn btn-primary btn-sm">Tambah Profil</button>
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
                        <table id="profil_tab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Walikota</th>
                                    <th>Periode</th>
                                    <th class="row-number">Status</th>
                                    <th style="max-width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($profil as $key => $val) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val["walikota"]; ?></td>
                                        <td><?php echo $val["periode_awal"] . " - " . $val["periode_akhir"]; ?></td>
                                        <td>
                                            <?php if ($val["is_active"]) { ?>
                                                <span class="btn btn-xs btn-block btn-outline-success">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                            <?php } else { ?>
                                                <span class="btn btn-xs btn-block btn-outline-danger">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-warning edit" data-id="<?php echo $val["id"] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-danger delete" data-id="<?php echo $val["id"] ?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-info organ" data-id="<?php echo $val["id"] ?>">
                                                <i class="fas fa-bezier-curve"></i>
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