<!DOCTYPE html>
<html>

<?php
$path = site_url("assets/images/check-box.png");
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$checked = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path = site_url("assets/images/stop.png");
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$unchecked = 'data:image/' . $type . ';base64,' . base64_encode($data);

$tanggal = date("m", strtotime($disposisi["created_date"]));
$hari = date("d", strtotime($disposisi["created_date"]));
$bulan = "";
$tahun = date("Y", strtotime($disposisi["created_date"]));
switch ($tanggal) {
    case 1:
        $bulan = "Januari";
        break;
    case 2:
        $bulan = "Februari";
        break;
    case 3:
        $bulan = "Maret";
        break;
    case 4:
        $bulan = "April";
        break;
    case 5:
        $bulan = "Mei";
        break;
    case 6:
        $bulan = "Juni";
        break;
    case 7:
        $bulan = "Juli";
        break;
    case 8:
        $bulan = "Agustus";
        break;
    case 9:
        $bulan = "September";
        break;
    case 10:
        $bulan = "Oktober";
        break;
    case 1:
        $bulan = "November";
        break;
    case 12:
        $bulan = "Desember";
        break;
}

$tanggal = "$hari $bulan $tahun";
?>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>

    <style>
        h3 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .text-center {
            text-align: center;
        }

        table.parent {
            margin: 0 auto;
            border-collapse: collapse;
            /* border-style: hidden; */
        }

        table.parent .parent-td {
            border: 1px solid #000000;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .child-row,
        .isi-row {
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <h3 class="text-center">PEMERINTAH KOTA MOJOKERTO</h3>
    <h3 class="text-center">
        <ins>BAGIAN HUKUM SEKRETARIAT DAERAH</ins>
    </h3>

    <h4 class="text-center">LEMBAR DISPOSISI</h4>

    <table class="parent" style="width: 100%;">
        <tr>
            <td class="parent-td" style="width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 100px;">Surat Dari</td>
                        <td style="width: 10px;">:</td>
                        <td>Kepala Bagian Hukum</td>
                    </tr>
                </table>
            </td>
            <td class="parent-td">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 130px;">Diterima Tanggal</td>
                        <td style="width: 10px;">:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="parent-td" style="width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 100px;">Tanggal Surat</td>
                        <td style="width: 10px;">:</td>
                        <td><?php echo $tanggal; ?></td>
                    </tr>
                </table>
            </td>
            <td class="parent-td">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 130px;">Nomor Agenda</td>
                        <td style="width: 10px;">:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="parent-td" style="width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 100px;">Nomor Surat</td>
                        <td style="width: 10px;">:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td class="parent-td">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 130px;">Diteruskan Kepada</td>
                        <td style="width: 10px;">:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="parent-td" style="width: 50%;">
                <table style="width: 100%; height: 125px;">
                    <tr>
                        <td style="width: 100px; vertical-align: top;">Perihal</td>
                        <td style="width: 10px; vertical-align: top;">:</td>
                        <td style="vertical-align: top;"><?php echo $disposisi["pengajuan_judul"]; ?></td>
                    </tr>
                </table>
            </td>
            <td class="parent-td">
                <table style="width: 100%;">
                    <tr>
                        <td class="child-row" style="width: 1%;">1.</td>
                        <td style="width: 79%;">KASUBBAG. PERUNDANG-UNDANGAN</td>
                        <td style="width: 10%;">
                            <img src="<?php echo $disposisi["is_penyusunan"] ? $checked : $unchecked ?>" width="20" height="20" />
                        </td>
                    </tr>
                    <tr>
                        <td class="child-row">2.</td>
                        <td>KASUBBAG. BANTUAN HUKUM</td>
                        <td>
                            <img src="<?php echo $disposisi["is_bantuan"] ? $checked : $unchecked ?>" width="20" height="20" />
                        </td>
                    </tr>
                    <tr>
                        <td class="child-row">3.</td>
                        <td>KASUBBAG. DOKUMENTASI DAN INFORMASI</td>
                        <td>
                            <img src="<?php echo $disposisi["is_administrasi"] ? $checked : $unchecked ?>" width="20" height="20" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <h4 class="text-center">
        <ins>ISI DISPOSISI</ins>
    </h4>

    <table>
        <tr>
            <td class="isi-row" style="width: 20px;">1.</td>
            <td style="width: 300px;">Koordinasikan</td>
            <td style="width: 20px;">
                <img src="<?php echo $disposisi["is_kordinasikan"] ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
        <tr>
            <td class="isi-row">2.</td>
            <td>Selesaikan</td>
            <td>
                <img src="<?php echo $disposisi["is_selesaikan"] ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
        <tr>
            <td class="isi-row">3.</td>
            <td>Tindak lanjuti</td>
            <td>
                <img src="<?php echo $disposisi["is_tindak_lanjuti"] ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
        <tr>
            <td class="isi-row">4.</td>
            <td>Proses sesuai ketentuan</td>
            <td>
                <img src="<?php echo $disposisi["is_proses_ketentuan"] ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
        <tr>
            <td class="isi-row">5.</td>
            <td>Buatkan laporan</td>
            <td>
                <img src="<?php echo $disposisi["is_laporan"] ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
        <tr>
            <td class="isi-row">6.</td>
            <td>Bicarakan dengan saya</td>
            <td>
                <img src="<?php echo $disposisi["is_bicarakan"] ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
        <tr>
            <td class="isi-row">7.</td>
            <td><?php echo (!empty($disposisi["keterangan"])) ? $disposisi["keterangan"] : "......................................................" ?></td>
            <td>
                <img src="<?php echo (!empty($disposisi["keterangan"])) ? $checked : $unchecked ?>" width="20" height="20" />
            </td>
        </tr>
    </table>
</body>

</html>