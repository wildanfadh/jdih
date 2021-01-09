<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-7">
                    <h1 class="m-0 text-dark"><?php echo ucwords($title); ?></h1>
                </div>

                <div class="col-sm-5">
                    <div class="float-sm-right">
                        <button type="button" id="tambah_group" class="btn btn-primary btn-sm">Tambah Group</button>
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
                        <table id="group_tab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Nama Group</th>
                                    <th class="wp15">Status</th>
                                    <th class="row-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($group)) {
                                    foreach ($group as $key => $val) {
                                        $disabled = "";
                                        if ($val["is_permanent"]) {
                                            $disabled = "disabled";
                                        } ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td class="center"><?php echo $val["name"]; ?></td>
                                            <td>
                                                <?php if ($val["is_active"]) { ?>
                                                    <span class="btn btn-sm btn-block btn-outline-success">
                                                        Aktif
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="btn btn-sm btn-block btn-outline-danger">
                                                        Tidak Aktif
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning edit" data-id="<?php echo $val["id"] ?>" <?php echo $disabled; ?>>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger delete" data-id="<?php echo $val["id"] ?>" <?php echo $disabled; ?>>
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