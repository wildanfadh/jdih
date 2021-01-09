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

    .chart-container {
        position: relative;
        margin: auto;
        height: 70vh;
        width: 60vw;
    }
</style>

<div class="sab_banner overlay">
    <div class="container">
        <div class="sab_banner_text">
            <h2>Grafik</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item active">Grafik</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h3> GRAFIK PRODUK HUKUM KOTA MOJOKERTO </h3>
                </center>

                <div class="chart-container">
                    <canvas id="myChart" style="margin-left: auto; margin-right: auto;"></canvas>
                </div>
            </div>
            <div class="col-md-12">
                <p>
                    Keterangan : Jumlah total data dimaksud adalah jumlah total data produk hukum yang <strong><u>sudah diupload ke dalam database JDIH Kota Mojokerto.</u></strong>
                    Klik <a href="<?php echo base_url("Statistik") ?>" style="color: #df193a;">di sini</a> untuk melihat Statistik.
                </p>
            </div>
        </div>
    </div>
</div>