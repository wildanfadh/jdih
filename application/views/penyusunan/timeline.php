<style>
    #view_pdf {
        height: 560px;
    }

    .time-label {
        margin-top: 35px;
    }

    .time-label>span {
        padding: 5px 10px !important;
    }

    .view-table {
        margin-bottom: 0px;
    }

    .view-table td,
    .view-table th {
        padding: .5rem !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><?= $title; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="margin-bottom: 25px !important;">
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="detail_pengajuan" class="table table-borderless table-hover view-table" width="100%">
                                        <tr>
                                            <th class="text-left" style="width: 150px;">Perihal Surat</th>
                                            <td style="width: 5px;">:</td>
                                            <td class="text-left"><?php echo $data["pengajuan"]["judul"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Jenis Pengajuan</th>
                                            <td>:</td>
                                            <td class="text-left"><?php echo $data["pengajuan"]["jenis_pengajuan_text"]; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <table id="detail_pengajuan" class="table table-borderless table-hover view-table" width="100%">
                                        <tr>
                                            <th class="text-left" style="width: 150px;">OPD</th>
                                            <td style="width: 5px;">:</td>
                                            <td class="text-left"><?php echo $data["pengajuan"]["user_full_name"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Jabatan</th>
                                            <td>:</td>
                                            <td class="text-left"><?php echo $data["pengajuan"]["jabatan"]; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table id="detail_pengajuan" class="table table-borderless table-hover view-table" width="100%">
                                        <tr>
                                            <th class="text-left" style="width: 150px;">Nama Pengusul</th>
                                            <td style="width: 5px;">:</td>
                                            <td class="text-left"><?php echo $data["pengajuan"]["nama"]; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Nomor HP</th>
                                            <td style="width: 5px;">:</td>
                                            <td class="text-left"><?php echo $data["pengajuan"]["nomor_hp"]; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="timeline">
                        <?php if (!empty($data["pengajuan"])) { ?>
                            <div class="time-label" style="margin-top: 0px;">
                                <span class="bg-purple"><i class="far fa-folder"></i> Pengajuan Produk Hukum</span>
                            </div>
                            <div>
                                <i class="far fa-folder bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["pengajuan"]["created_date"])); ?></span>
                                    <h3 class="timeline-header">
                                        <a href="<?= base_url("Pengajuan/detail?pengajuan=" . $data["pengajuan"]["id"]); ?>">Produk Hukum</a> diajukan.
                                    </h3>

                                    <div class="timeline-body">
                                        <?php $pdf = explode("!!!", $data["pengajuan"]["file_pengajuan_tambahan"]);
                                        if (!empty($pdf[0])) { ?>
                                            <button class="btn btn-info btn-xs view-pdf" data-file="<?= $pdf[0]; ?>">
                                                <i class="far fa-eye"></i> Lihat Surat Pengajuan
                                            </button> yang diajukan oleh <strong><?= $data["pengajuan"]["nama"]; ?> (<?= $data["pengajuan"]["jabatan"]; ?>)</strong>.
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="far fa-folder-open bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["pengajuan"]["modified_date"])); ?></span>
                                    <h3 class="timeline-header">
                                        <a href="<?= base_url("Pengajuan/detail?pengajuan=" . $data["pengajuan"]["id"]); ?>">Produk Hukum</a> diterima dan disusun.
                                    </h3>

                                    <div class="timeline-body">
                                        <strong><?= $data["pengajuan"]["judul"] ?></strong> diterima dan disusun oleh <strong><?= $data["pengajuan"]["modified_by"]; ?></strong>.
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!empty($data["penyusunan_list"])) { ?>
                            <div class="time-label">
                                <span class="bg-pink"><i class="far fa-clipboard"></i> Hasil Penyusunan</span>
                            </div>
                            <div>
                                <i class="far fa-copy bg-warning"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["penyusunan_list"][0]["created_date"])); ?></span>
                                    <h3 class="timeline-header">
                                        <a href="<?= base_url("Pengajuan/penyusunan_list?pengajuan=" . $data["pengajuan"]["id"]); ?>">Daftar Penyusunan</a> dibuat.
                                    </h3>
                                </div>
                            </div>

                            <?php if (!empty($data["penyusunan"])) {
                                $status = "";
                                if ($data["penyusunan"]["status"] == PENYUSUNAN_PROSES)
                                    $status = "Diproses";
                                elseif ($data["penyusunan"]["status"] == PENYUSUNAN_KEMBALI)
                                    $status = "Dikembalikan"; ?>

                                <div>
                                    <i class="far fa-file-alt bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["penyusunan"]["created_date"])); ?></span>
                                        <h3 class="timeline-header">
                                            Hasil Penyusunan : <a href="#" class="view" data-toggle="modal" data-target="#modal_view" data-urut="<?= $data["penyusunan"]["nomor_urut"]; ?>" data-judul="<?= $data["penyusunan"]["judul"]; ?>" data-status="<?= $status; ?>" data-keterangan="<?= $data["penyusunan"]["keterangan"]; ?>"><?= $data["penyusunan"]["judul"]; ?></a>.
                                        </h3>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                        <?php $ready = false;
                        if (
                            ($data["penyusunan"]["is_asisten"] or $data["penyusunan"]["is_sekda"] or $data["penyusunan"]["is_walikota"]) and
                            $data["penyusunan"]["status"] != PENYUSUNAN_KEMBALI
                        ) { ?>
                            <div class="time-label">
                                <span class="bg-info"><i class="fas fa-tasks"></i> Lacak Produk Hukum</span>
                            </div>

                            <?php if ($data["penyusunan"]["is_kabag"]) { ?>
                                <div>
                                    <i class="far fa-copy bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["penyusunan"]["kabag_date"])); ?></span>
                                        <h3 class="timeline-header">
                                            Telah diparaf Oleh <strong>Kabag</strong>.
                                        </h3>
                                    </div>
                                </div>
                            <?php }

                            if ($data["penyusunan"]["is_asisten"]) { ?>
                                <div>
                                    <i class="far fa-copy bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["penyusunan"]["asisten_date"])); ?></span>
                                        <h3 class="timeline-header">
                                            Telah diparaf Oleh <strong>Asisten</strong>.
                                        </h3>
                                    </div>
                                </div>
                            <?php }

                            if ($data["penyusunan"]["is_sekda"]) { ?>
                                <div>
                                    <i class="far fa-copy bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["penyusunan"]["sekda_date"])); ?></span>
                                        <h3 class="timeline-header">
                                            Telah diparaf/ditandatangani Oleh <strong>Sekretariat Daerah</strong>.
                                        </h3>
                                    </div>
                                </div>
                            <?php }

                            if ($data["penyusunan"]["is_walikota"]) { ?>
                                <div>
                                    <i class="far fa-copy bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= date("d/m/Y, H:i", strtotime($data["penyusunan"]["walikota_date"])); ?></span>
                                        <h3 class="timeline-header">
                                            Telah ditandatangani Oleh <strong>Walikota</strong>.
                                        </h3>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php if ($data["penyusunan"]["is_ready"]) {
                                $ready = true;
                            }
                        } ?>

                        <!-- PENUTUP -->
                        <?php if ($ready and $data["penyusunan"]["status"] != PENYUSUNAN_KEMBALI) { ?>
                            <div class="time-label">
                                <span class="bg-success"><i class="fas fa-archive"></i> Produk Hukum Siap Diambil</span>
                            </div>
                        <?php } elseif ($data["penyusunan"]["status"] == PENYUSUNAN_KEMBALI) { ?>
                            <div class="time-label">
                                <span class="bg-danger"><i class="fas fa-exclamation"></i></i> Produk Hukum Dibatalkan</span>
                            </div>
                        <?php } else { ?>
                            <div class="time-label">
                                <span class="bg-gray"><i class="fas fa-clock"></i> Produk Hukum Belum Siap Diambil</span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_pdf">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div id="view_pdf"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Penyusunan <small>(<span id="view_header"></span>)</small></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="view_table" class="table table-borderless table-hover" width="100%">
                            <tr>
                                <td class="text-left" style="width: 215px;">Judul</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_judul"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 215px;">Status</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_status"></span></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 215px;">Keterangan</td>
                                <td style="width: 5px;">:</td>
                                <td class="text-left"><span id="view_keterangan"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>