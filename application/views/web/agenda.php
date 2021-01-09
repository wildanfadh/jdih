<?php
$tipe = "";
if (isset($_GET["tipe"])) {
    if ($_GET["tipe"] == "prokum_daerah") {
        $tipe = " Daerah";
    } elseif ($_GET["tipe"] == "prokum_pusat") {
        $tipe = " Pusat";
    }
} ?>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Kegiatan</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item active">Kegiatan</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="daftar" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text">#</th>
                                <th>Judul Kegiatan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($agenda)) {
                                $i = 1;
                                foreach ($agenda as $val) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val["judul"]; ?></td>
                                        <td><?php echo date("d M Y", strtotime($val["tanggal_mulai"])); ?></td>
                                        <td><?php echo date("d M Y", strtotime($val["tanggal_selesai"])); ?></td>
                                        <td><?php echo $val["waktu"]; ?></td>
                                        <td><?php echo $val["tempat"]; ?></td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>