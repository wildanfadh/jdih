<style>
    .number {
        width: 15px;
    }
</style>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Detail Produk Hukum</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">JDIH</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url("Daftar?jenis=" . $prokum["singkatan"]); ?>">Produk Hukum</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="city_emergency_info">
                    <div class="city_emergency_call">
                        <h5>Detail Produk Hukum</h5>
                        <ul>
                            <li><a href="#">Jenis Peraturan</a></li>
                            <li><a href="#"><?php echo !empty($prokum["nama"]) ? $prokum["nama"] : "-"; ?></a></li>

                            <li><a href="#">Nomor Peraturan</a></li>
                            <li><a href="#"><?php echo !empty($prokum["no_peraturan"]) ? $prokum["no_peraturan"] : "-"; ?></a></li>

                            <li><a href="#">Tahun Peraturan</a></li>
                            <li><a href="#"><?php echo !empty($prokum["tahun_peraturan"]) ? $prokum["tahun_peraturan"] : "-"; ?></a></li>

                            <li><a href="#">Tentang</a></li>
                            <li><a href="#"><?php echo !empty($prokum["tentang"]) ? $prokum["tentang"] : "-"; ?></a></li>

                            <li><a href="#">Tanggal Ditetapkan</a></li>
                            <li><a href="#"><?php echo !empty($prokum["tanggal_penetapan"]) ? date("d M Y", strtotime($prokum["tanggal_penetapan"])) : "-"; ?></a></li>

                            <li><a href="#">Nomor LD</a></li>
                            <li><a href="#"><?php echo !empty($prokum["noreg_daerah"]) ? $prokum["noreg_daerah"] : "-"; ?></a></li>

                            <li><a href="#">Nomor TLD</a></li>
                            <li><a href="#"><?php echo !empty($prokum["noreg_daerah"]) ? $prokum["noreg_daerah"] : "-"; ?></a></li>

                            <li><a href="#">Tanggal Diundangkan</a></li>
                            <li><a href="#"><?php echo !empty($prokum["tanggal_pengundangan"]) ? date("d M Y", strtotime($prokum["tanggal_pengundangan"])) : "-"; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="city_notice">
                    <h4>DOKUMEN</h4>
                    <?php if ($prokum["is_upload"]) { ?>
                        <a href="<?php echo base_url("uploads/" . $prokum["file"]); ?>" download class="theam_btn" style="background-color: #df193a;">
                            Download PDF
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo base_url("backup/app/datapdf/" . $prokum["file"]); ?>" download class="theam_btn" style="background-color: #df193a;">
                            Download PDF
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>