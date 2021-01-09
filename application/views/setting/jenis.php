<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Jenis Produk Hukum</h1>
                </div>

                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button type="button" id="tambah_jenis" class="btn btn-primary btn-sm">Tambah Jenis Prokum</button>
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
                        <table id="jenis_tab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="row-number">#</th>
                                    <th>Tipe</th>
                                    <th>Nama</th>
                                    <th class="row-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($jenis as $key => $val) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val["tipe_texted"]; ?></td>
                                        <td><?php echo $val["nama"]; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning edit" data-id="<?php echo $val["id"] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- <button type="button" class="btn btn-sm btn-danger delete" data-id="<?php echo $val["id"] ?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button> -->
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