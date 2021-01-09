<?php
$tipe = "";
if (isset($_GET["tipe"])) {
    if ($_GET["tipe"] == "prokum_daerah") {
        $tipe = " Daerah";
    } elseif ($_GET["tipe"] == "prokum_pusat") {
        $tipe = " Pusat";
    }
} ?>

<style>
    .number {
        width: 15px;
    }
</style>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <?php if (isset($jenis)) { ?>
                <h2><?php echo $jenis; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">JDIH</a></li>
                    <li class="breadcrumb-item active"><?php echo $jenis; ?></li>
                </ul>
            <?php } else { ?>
                <h2>Produk Hukum <?php echo $tipe; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">JDIH</a></li>
                    <li class="breadcrumb-item active">Produk Hukum <?php echo $tipe; ?></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="table-responsive">
                    <table id="daftar" class="table table-striped table-aksi">
                        <thead>
                            <tr>
                                <th class="number">#</th>
                                <th>Nomor</th>
                                <th>Tentang</th>
                                <th>Fitur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($prokum)) {
                                $i = 1;
                                foreach ($prokum as $val) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <a href="<?php echo base_url("Detail?id=" . $val["id"]); ?>" style="color: green;"><?php echo $val["subjek_singkat"]; ?></a>
                                        </td>
                                        <td><?php echo $val["tentang"]; ?></td>
                                        <td>
                                            <button type="button" class="theam_btn view-pdf" data-id="<?php echo $val["id"]; ?>" data-status="<?php echo $val["is_upload"]; ?>" data-file="<?php echo $val["file"]; ?>" style="background-color: green;">
                                                <i class="fa fa-search"></i>
                                            </button>

                                            <?php if ($val["is_upload"]) { ?>
                                                <a href="<?php echo base_url("uploads/" . $val["file"]); ?>" download class="theam_btn" style="background-color: green;">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url("backup/app/datapdf/" . $val["file"]); ?>" download class="theam_btn" style="background-color: green;">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-3">
                <div class="table-responsive" style="border: none;">
                    <table id="cari" class="borderless">
                        <thead>
                            <tr>
                                <th>Pencarian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" id="nomor" name="nomor" placeholder="Nomor Peraturan">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="tahun" name="tahun" placeholder="Tahun Pencarian">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="tentang" name="tentang" placeholder="Tentang">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <style>
                                        .pilih {
                                            outline: none;
                                            font-size: 15px;
                                            font-weight: normal;
                                            line-height: normal;
                                            display: inline-block;
                                            vertical-align: middle;
                                            box-sizing: border-box;
                                            border: 1px solid #e4e3e3;
                                            -moz-box-sizing: border-box;
                                            -webkit-box-sizing: border-box;
                                            width: 100%;

                                            height: 48px;
                                            padding: 10px 15px;
                                            color: #666666;
                                        }
                                    </style>

                                    <select class="pilih" id="select_prokum">
                                        <?php $jenis = $_GET["jenis"]; ?>
                                        <option value="0" <?php echo empty($jenis) ? "selected" : ""; ?>>Jenis Prokum</option>

                                        <option value="perda" <?php echo ($jenis == "perda") ? "selected" : ""; ?>>Peraturan Daerah</option>
                                        <option value="perwali" <?php echo ($jenis == "perwali") ? "selected" : ""; ?>>Peraturan Walikota</option>
                                        <option value="kepwali" <?php echo ($jenis == "kepwali") ? "selected" : ""; ?>>Keputusan Walikota</option>
                                        <option value="instruksi" <?php echo ($jenis == "instruksi") ? "selected" : ""; ?>>Instruksi Walikota</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" id="btn_cari" class="theam_btn btn-block" style="background-color: #df193a;">CARI</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>