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
            <h2>Statistik</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">JDIH</a></li>
                <li class="breadcrumb-item active">Statistik</li>
            </ul>
        </div>
    </div>
</div>

<div class="city_services2_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h3> REKAPITULASI JUMLAH PRODUK HUKUM </h3>
                    <h3> KOTA MOJOKERTO </h3>
                </center>

                <div class="table-responsive" style="margin-bottom: 10px;">
                    <table id="jenis" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="number" rowspan="2">#</th>
                                <th rowspan="2">Jenis Prokum Daerah</th>
                                <th colspan="<?php echo count($tahun); ?>">Tahun</th>
                                <th rowspan="2">Jumlah</th>
                            </tr>
                            <tr>
                                <?php if (!empty($tahun)) {
                                    foreach ($tahun as $val) {
                                        echo "<th>$val</th>";
                                    }
                                } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $total = 0;
                            $colspan = 3;
                            if (!empty($prokum)) {
                                foreach ($prokum as $k_pro => $v_pro) {
                                    $jumlah = 0;
                                    $colspan = 2;

                                    echo "<tr>";
                                    echo "<td>$i</td>";
                                    echo "<td>" . $k_pro . "</td>";
                                    foreach ($v_pro as $k_v => $v_v) {
                                        echo "<td>$v_v</td>";
                                        $jumlah += $v_v;
                                        $colspan++;
                                    }

                                    echo "<td>$jumlah</td>";
                                    echo "</tr>";

                                    $total += $jumlah;
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="<?php echo $colspan; ?>">Jumlah Total Data</th>
                                <th><?php echo $total; ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <p>
                    Keterangan : Jumlah total data dimaksud adalah jumlah total data produk hukum yang <strong><u>sudah diupload ke dalam database JDIH Kota Mojokerto</u></strong>
                    Klik <a href="<?php echo base_url("Grafik") ?>" style="color: green;">di sini</a> untuk melihat Grafik.
                </p>

                <hr>


                <!-- Semua Produk Hukum -->
                <center>
                    <h3> REKAPITULASI STATUS PRODUK HUKUM </h3>
                    <h3> KOTA MOJOKERTO </h3>
                </center>

                <div class="table-responsive" style="margin-bottom: 50px;">
                    <table id="status" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="number">#</th>
                                <th>Status Peraturan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Berlaku</td>
                                <td><?php echo $status["berlaku"]; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mengubah</td>
                                <td><?php echo $status["mengubah"]; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mencabut</td>
                                <td><?php echo $status["mencabut"]; ?></td>
                            </tr>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>

                <div class="row text-center" id="row_modal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3 col-sm-12">
                                <button type="button" class="fourth inline btn-block" id="button_modal" data-toggle="modal" data-target="#modal_perda">
                                    Peraturan Daerah
                                </button>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <button type="button" class="fourth inline btn-block" id="button_modal" data-toggle="modal" data-target="#modal_perwali">
                                    Peraturan Walikota
                                </button>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <button type="button" class="fourth inline btn-block" id="button_modal" data-toggle="modal" data-target="#modal_kepwali">
                                    Keputusan Walikota
                                </button>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <button type="button" class="fourth inline btn-block" id="button_modal" data-toggle="modal" data-target="#modal_inswali">
                                    Instruksi Walikota
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    table {
        margin-bottom: 0px !important;
    }
</style>

<!-- Modal Peraturan Daerah -->
<div class="modal fade" id="modal_perda" tabindex="-1" role="dialog" aria-labelledby="modal_perda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <h3> REKAPITULASI STATUS PERATURAN DAERAH </h3>
                    <h3> KOTA MOJOKERTO </h3>
                </div>

                <div class="table-responsive" style="margin-top: 20px;">
                    <table id="status" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="number">#</th>
                                <th>Status Peraturan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Berlaku</td>
                                <td><?php echo $jenisperda["berlaku"]; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mengubah</td>
                                <td><?php echo $jenisperda["mengubah"]; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mencabut</td>
                                <td><?php echo $jenisperda["mencabut"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Peraturan Perwali -->
<div class="modal fade" id="modal_perwali" tabindex="-1" role="dialog" aria-labelledby="modal_perwali" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <h3> REKAPITULASI STATUS PERATURAN WALIKOTA </h3>
                    <h3> KOTA MOJOKERTO </h3>
                </div>

                <div class="table-responsive" style="margin-top: 20px;">
                    <table id="status" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="number">#</th>
                                <th>Status Peraturan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Berlaku</td>
                                <td><?php echo $jenisperwali["berlaku"]; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mengubah</td>
                                <td><?php echo $jenisperwali["mengubah"]; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mencabut</td>
                                <td><?php echo $jenisperwali["mencabut"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Keputusan Walikota -->
<div class="modal fade" id="modal_kepwali" tabindex="-1" role="dialog" aria-labelledby="modal_kepwali" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <h3> REKAPITULASI STATUS KEPUTUSAN WALIKOTA </h3>
                    <h3> KOTA MOJOKERTO </h3>
                </div>

                <div class="table-responsive" style="margin-top: 20px;">
                    <table id="status" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="number">#</th>
                                <th>Status Peraturan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Berlaku</td>
                                <td><?php echo $jeniskepwali["berlaku"]; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mengubah</td>
                                <td><?php echo $jeniskepwali["mengubah"]; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mencabut</td>
                                <td><?php echo $jeniskepwali["mencabut"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Keputusan Walikota -->
<div class="modal fade" id="modal_inswali" tabindex="-1" role="dialog" aria-labelledby="modal_inswali" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <h3> REKAPITULASI STATUS INSTRUKSI WALIKOTA </h3>
                    <h3> KOTA MOJOKERTO </h3>
                </div>

                <div class="table-responsive" style="margin-top: 20px;">
                    <table id="status" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="number">#</th>
                                <th>Status Peraturan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Berlaku</td>
                                <td><?php echo $jenisinswali["berlaku"]; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mengubah</td>
                                <td><?php echo $jenisinswali["mengubah"]; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mencabut</td>
                                <td><?php echo $jenisinswali["mencabut"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>