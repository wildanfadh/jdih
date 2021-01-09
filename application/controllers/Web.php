<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends WH_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model("Prokum_model", "pro_model");
        $this->load->model("Menu_model", "men_model");
    }

    public function index()
    {
        $data['title'] = "JDIH";
        $data['_view'] = "web/main";
        $data['_js'] = "web/main_js";

        $data["prokum1"] = $this->pro_model->all_prokum(true, 0, 6);
        foreach ($data["prokum1"] as $key => $val) {
            $data["prokum1"][$key]["tipe_texted"] = ucwords($this->ini_tipe_prokum($val["tipe"])["texted_prokum"]);
        }

        $data["prokum2"] = $this->pro_model->all_prokum(true, 6, 6);
        if (!empty($data["prokum2"])) {
            foreach ($data["prokum2"] as $key => $val) {
                $data["prokum2"][$key]["tipe_texted"] = ucwords($this->ini_tipe_prokum($val["tipe"])["texted_prokum"]);
            }
        }

        $this->show_layout($data);
    }

    public function daftar()
    {
        $get = $this->input->get();

        $data['title'] = "JDIH";
        $data['_view'] = "web/daftar";
        $data['_js'] = "web/daftar_js";

        $data["prokum"] = $this->pro_model->all_prokum();

        if (isset($get["tipe"])) {
            $data["tipe"] = $this->ini_tipe_prokum(strtoupper($get["tipe"]));
            $data["prokum"] = $this->pro_model->get_prokum_bytipe($get["tipe"]);
        }

        if (isset($get["jenis"])) {
            if ($get["jenis"] == "instruksi") {
                $get["jenis"] = "instruksi walikota";
            }

            $data["prokum"] = $this->pro_model->get_prokum_byjenis($get["jenis"]);
            if ($get["jenis"] == "perwali") {
                $data["jenis"] = "Peraturan Walikota";
            } elseif ($get["jenis"] == "perda") {
                $data["jenis"] = "Peraturan Daerah";
            } elseif ($get["jenis"] == "kepwali") {
                $data["jenis"] = "Keputusan Walikota";
            } elseif ($get["jenis"] == "instruksi walikota") {
                $data["jenis"] = "Instruksi Walikota";
            }
        }

        if (isset($get["search"])) {
            $data["prokum"] = $this->pro_model->all_prokum(false, 0, 0, $get["search"]);
        }

        if (isset($get["search2"])) {
            $data["prokum"] = $this->pro_model->filter_prokum($get["jenis"], $get["nomor"], $get["tahun"], $get["tentang"]);
        }

        $this->show_layout($data);
    }

    public function pelayanan()
    {

        $data["nav"] = $this->input->get("p");

        $data['title'] = "JDIH";
        $data['_view'] = "web/pelayanan";
        $data['_js'] = "web/pelayanan_js";

        // $this->print_out_data($data);

        $this->show_layout($data);
    }

    public function profil()
    {
        $data['title'] = "JDIH";
        $data['_view'] = "web/profil";
        $data['_js'] = "web/profil_js";

        $profil = $this->set_model->get_active_profil();
        $data["profil"] = $profil;
        $data["visi"] = $this->set_model->get_visi_byprofil($profil["id"]);
        $data["misi"] = $this->set_model->get_misi_byprofil($profil["id"]);
        $data["personil"] = $this->set_model->get_personil_byprofile($profil["id"]);
        $data["wakil"] = $this->set_model->get_wakil($profil["id"]);

        // $this->print_out_data($data);
        $this->show_layout($data);
    }

    private function initiate_survey()
    {
        $result = array(
            "Sangat Baik" => 0,
            "Baik" => 0,
            "Cukup" => 0,
            "Buruk" => 0,
            "Sangat Buruk" => 0,
        );

        return $result;
    }

    private function initiate_chart($data)
    {
        $result = array();
        for ($i = 1; $i <= 5; $i++) {
            if ($i == 1) {
                $result[] = array(
                    "label" => "Sangat Baik",
                    "backgroundColor" => "rgba(255, 99, 132, 0.2)",
                    "borderColor" => "rgba(255,99,132,1)",
                );
            } elseif ($i == 2) {
                $result[] = array(
                    "label" => "Baik",
                    "backgroundColor" => "rgba(54, 162, 235, 0.2)",
                    "borderColor" => "rgba(54, 162, 235, 1)",
                );
            } elseif ($i == 3) {
                $result[] = array(
                    "label" => "Cukup",
                    "backgroundColor" => "rgba(255, 206, 86, 0.2)",
                    "borderColor" => "rgba(255, 206, 86, 1)",
                );
            } elseif ($i == 4) {
                $result[] = array(
                    "label" => "Buruk",
                    "backgroundColor" => "rgba(75, 192, 192, 0.2)",
                    "borderColor" => "rgba(75, 192, 192, 1)",
                );
            } elseif ($i == 5) {
                $result[] = array(
                    "label" => "Sangat Buruk",
                    "backgroundColor" => "rgba(153, 102, 255, 0.2)",
                    "borderColor" => "rgba(153, 102, 255, 1)",
                );
            }
        }

        foreach ($data as $key => $pro) {
            foreach ($result as $r_key => $res) {
                if ($res["label"] == $key) {
                    $result[$r_key]["data"] = $pro;
                }
            }
        }

        return $result;
    }

    public function survei()
    {
        $data['title'] = "JDIH";
        $data['_view'] = "web/survei";
        $data['_js'] = "web/survei_js";

        $survei = $this->men_model->all_survei();
        $prokum = $this->initiate_survey();
        $bagkum = $this->initiate_survey();
        $dokkum = $this->initiate_survey();

        foreach ($survei as $key => $val) {
            if ($val["tipe"] == TIPE_1) {
                if ($val["nilai"] == 5) {
                    $prokum["Sangat Baik"]++;
                } elseif ($val["nilai"] == 4) {
                    $prokum["Baik"]++;
                } elseif ($val["nilai"] == 3) {
                    $prokum["Cukup"]++;
                } elseif ($val["nilai"] == 2) {
                    $prokum["Buruk"]++;
                } elseif ($val["nilai"] == 1) {
                    $prokum["Sangat Buruk"]++;
                }
            } elseif ($val["tipe"] == TIPE_2) {
                if ($val["nilai"] == 5) {
                    $bagkum["Sangat Baik"]++;
                } elseif ($val["nilai"] == 4) {
                    $bagkum["Baik"]++;
                } elseif ($val["nilai"] == 3) {
                    $bagkum["Cukup"]++;
                } elseif ($val["nilai"] == 2) {
                    $bagkum["Buruk"]++;
                } elseif ($val["nilai"] == 1) {
                    $bagkum["Sangat Buruk"]++;
                }
            } elseif ($val["tipe"] == TIPE_3) {
                if ($val["nilai"] == 5) {
                    $dokkum["Sangat Baik"]++;
                } elseif ($val["nilai"] == 4) {
                    $dokkum["Baik"]++;
                } elseif ($val["nilai"] == 3) {
                    $dokkum["Cukup"]++;
                } elseif ($val["nilai"] == 2) {
                    $dokkum["Buruk"]++;
                } elseif ($val["nilai"] == 1) {
                    $dokkum["Sangat Buruk"]++;
                }
            }
        }

        $prokum_res = $this->initiate_chart($prokum);
        $bagkum_res = $this->initiate_chart($bagkum);
        $dokkum_res = $this->initiate_chart($dokkum);

        $data["prokum"] = $prokum_res;
        $data["bagkum"] = $bagkum_res;
        $data["dokkum"] = $dokkum_res;

        // $this->print_out_data($prokum_res);
        $this->show_layout($data);
    }

    public function save_survei()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "tipe" => $post["tipe"],
                "nilai" => $post["nilai"],
                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $post["nama"],
            );

            echo $this->men_model->save_survei($save);
        } else {
            echo 0;
        }
    }

    public function agenda()
    {
        $data['title'] = "JDIH";
        $data['_view'] = "web/agenda";
        $data['_js'] = "web/agenda_js";

        $data["agenda"] = $this->set_model->all_agenda(true);
        $this->show_layout($data);
    }

    public function detail()
    {
        $get = $this->input->get();

        $data['title'] = "JDIH";
        $data['_view'] = "web/detail";
        $data['_js'] = "web/detail_js";

        $data["prokum"] = $this->pro_model->get_prokum_byid($get["id"]);
        $this->show_layout($data);
    }

    public function struktur()
    {
        $data['title'] = "JDIH";
        $data['_view'] = "web/struktur";
        $data['_js'] = "web/struktur_js";

        $profil = $this->set_model->get_active_profil();
        $data["profil"] = $profil;
        $data["personil"] = $this->set_model->get_personil_byprofile($profil["id"]);

        $data["kepala"] = array();
        $data["sub"] = array();
        $data["staff"] = array();
        foreach ($data["personil"] as $key => $val) {
            if ($val["posisi"] == POS_KEPALA) {
                $data["kepala"][] = $val;
            } elseif ($val["posisi"] == POS_SUB) {
                $data["sub"][] = $val;
            } elseif ($val["posisi"] == POS_STAFF) {
                $data["staff"][] = $val;
            }
        }

        // $this->print_out_data($data);
        $this->show_layout($data);
    }

    public function statistik()
    {
        $prokum = $this->pro_model->all_prokum();
        $tahun = array();
        $jenis = array();
        $jenis_arr = array();

        $jenis_perda = array(
            "berlaku" => 0,
            "mengubah" => 0,
            "mencabut" => 0,
        );

        $jenis_perwali = array(
            "berlaku" => 0,
            "mengubah" => 0,
            "mencabut" => 0,
        );

        $jenis_kep_wali = array(
            "berlaku" => 0,
            "mengubah" => 0,
            "mencabut" => 0,
        );

        $jenis_ins_wali = array(
            "berlaku" => 0,
            "mengubah" => 0,
            "mencabut" => 0,
        );

        $status = array(
            "berlaku" => 0,
            "mengubah" => 0,
            "mencabut" => 0,
        );

        array_multisort(array_column($prokum, "tahun_peraturan"), SORT_ASC, $prokum);


        foreach ($prokum as $key => $val) {
            $jenis_arr[$val["nama"]] = array();

            if (!in_array($val["tahun_peraturan"], $tahun)) {
                array_push($tahun, $val["tahun_peraturan"]);
            }

            if ($val["status_peraturan"] == "Berlaku") {
                $status["berlaku"]++;
            } elseif ($val["status_peraturan"] == "Mengubah") {
                $status["mengubah"]++;
            } elseif ($val["status_peraturan"] == "Mencabut") {
                $status["mencabut"]++;
            }
        }

        // Jenis Perda
        foreach ($prokum as $key => $val) {

            if (!in_array($val["id_jenis"], $jenis)) {
                array_push($jenis, $val["id_jenis"]);
            }

            if (!in_array($val["tahun_peraturan"], $tahun)) {
                array_push($tahun, $val["tahun_peraturan"]);
            }

            if ($val["id_jenis"] == JENIS_PERDA and $val["status_peraturan"] == "Berlaku") {
                $jenis_perda["berlaku"]++;
            } elseif ($val["id_jenis"] == JENIS_PERDA and $val["status_peraturan"] == "Mengubah") {
                $jenis_perda["mengubah"]++;
            } elseif ($val["id_jenis"] == JENIS_PERDA and $val["status_peraturan"] == "Mencabut") {
                $jenis_perda["mencabut"]++;
            }
        }

        // Jenis Perwali
        foreach ($prokum as $key => $val) {

            if (!in_array($val["id_jenis"], $jenis)) {
                array_push($jenis, $val["id_jenis"]);
            }

            if (!in_array($val["tahun_peraturan"], $tahun)) {
                array_push($tahun, $val["tahun_peraturan"]);
            }

            if ($val["id_jenis"] == JENIS_PERWALI and $val["status_peraturan"] == "Berlaku") {
                $jenis_perwali["berlaku"]++;
            } elseif ($val["id_jenis"] == JENIS_PERWALI and $val["status_peraturan"] == "Mengubah") {
                $jenis_perwali["mengubah"]++;
            } elseif ($val["id_jenis"] == JENIS_PERWALI and $val["status_peraturan"] == "Mencabut") {
                $jenis_perwali["mencabut"]++;
            }
        }

        // Jenis Keputusan Perwali
        foreach ($prokum as $key => $val) {

            if (!in_array($val["id_jenis"], $jenis)) {
                array_push($jenis, $val["id_jenis"]);
            }

            if (!in_array($val["tahun_peraturan"], $tahun)) {
                array_push($tahun, $val["tahun_peraturan"]);
            }

            if ($val["id_jenis"] == JENIS_KEP_WALI and $val["status_peraturan"] == "Berlaku") {
                $jenis_kep_wali["berlaku"]++;
            } elseif ($val["id_jenis"] == JENIS_KEP_WALI and $val["status_peraturan"] == "Mengubah") {
                $jenis_kep_wali["mengubah"]++;
            } elseif ($val["id_jenis"] == JENIS_KEP_WALI and $val["status_peraturan"] == "Mencabut") {
                $jenis_kep_wali["mencabut"]++;
            }
        }

        // Jenis Keputusan Perwali
        foreach ($prokum as $key => $val) {

            if (!in_array($val["id_jenis"], $jenis)) {
                array_push($jenis, $val["id_jenis"]);
            }

            if (!in_array($val["tahun_peraturan"], $tahun)) {
                array_push($tahun, $val["tahun_peraturan"]);
            }

            if ($val["id_jenis"] == JENIS_INS_WALI and $val["status_peraturan"] == "Berlaku") {
                $jenis_ins_wali["berlaku"]++;
            } elseif ($val["id_jenis"] == JENIS_INS_WALI and $val["status_peraturan"] == "Mengubah") {
                $jenis_ins_wali["mengubah"]++;
            } elseif ($val["id_jenis"] == JENIS_INS_WALI and $val["status_peraturan"] == "Mencabut") {
                $jenis_ins_wali["mencabut"]++;
            }
        }

        foreach ($jenis_arr as $k_jen => $jen) {
            foreach ($tahun as $tah) {
                $jenis_arr[$k_jen][$tah] = 0;
            }
        }

        array_multisort(array_column($prokum, "tahun_peraturan"), SORT_ASC, $prokum);
        foreach ($prokum as $k_pro => $v_pro) {
            $jenis_arr[$v_pro["nama"]][$v_pro["tahun_peraturan"]]++;
        }

        $data['title'] = "JDIH";
        $data['_view'] = "web/statistik";
        $data['_js'] = "web/statistik_js";

        $data["tahun"] = $tahun;
        $data["prokum"] = $jenis_arr;
        $data["status"] = $status;
        $data["jenisperda"] = $jenis_perda;
        $data["jenisperwali"] = $jenis_perwali;
        $data["jeniskepwali"] = $jenis_kep_wali;
        $data["jenisinswali"] = $jenis_ins_wali;

        // $this->print_out_data($data);
        $this->show_layout($data);
    }

    public function grafik()
    {
        $prokum = $this->pro_model->all_prokum();
        $tahun = array();
        $jenis_arr = array();

        array_multisort(array_column($prokum, "tahun_peraturan"), SORT_ASC, $prokum);
        foreach ($prokum as $key => $val) {
            $jenis_arr[$val["nama"]] = array();
            if (!in_array($val["tahun_peraturan"], $tahun)) {
                array_push($tahun, $val["tahun_peraturan"]);
            }
        }

        foreach ($jenis_arr as $k_jen => $jen) {
            foreach ($tahun as $tah) {
                $jenis_arr[$k_jen][$tah] = 0;
            }
        }

        array_multisort(array_column($prokum, "tahun_peraturan"), SORT_ASC, $prokum);
        foreach ($prokum as $k_pro => $v_pro) {
            $jenis_arr[$v_pro["nama"]][$v_pro["tahun_peraturan"]]++;
        }

        $data["tahun"] = $tahun;
        $data["prokum"] = $jenis_arr;

        // INITIATE
        $perda = 0;
        $perwali = 0;
        $kepwali = 0;
        $instruksi = 0;
        $peraturan_bersama = 0;
        $peraturan_dprd = 0;
        foreach ($jenis_arr as $k_pro => $v_pro) {
            foreach ($v_pro as $k_v => $v_v) {
                if ($k_pro == "Peraturan Daerah Kota Mojokerto") {
                    $perda += $v_v;
                } elseif ($k_pro == "Peraturan Walikota Mojokerto") {
                    $perwali += $v_v;
                } elseif ($k_pro == "Keputusan Walikota Mojokerto") {
                    $kepwali += $v_v;
                } elseif ($k_pro == "Instruksi Walikota Mojokerto") {
                    $instruksi += $v_v;
                } elseif ($k_pro == "Peraturan Bersama Walikota Mojokerto") {
                    $peraturan_bersama += $v_v;
                } elseif ($k_pro == "Peraturan DPRD Kota Mojokerto") {
                    $peraturan_dprd += $v_v;
                }
            }
        }

        $chart = [$perda, $perwali, $kepwali, $instruksi, $peraturan_bersama, $peraturan_dprd];
        $chart_res = array();
        $chart_res[] = array(
            "label" => "Peraturan Daerah",
            "backgroundColor" => "rgba(255, 99, 132, 0.2)",
            "borderColor" => "rgba(255,99,132,1)",
            "data" => $perda,
        );

        $chart_res[] = array(
            "label" => "Peraturan Walikota",
            "backgroundColor" => "rgba(54, 162, 235, 0.2)",
            "borderColor" => "rgba(54, 162, 235, 1)",
            "data" => $perwali,
        );

        $chart_res[] = array(
            "label" => "Keputusan Walikota",
            "backgroundColor" => "rgba(255, 206, 86, 0.2)",
            "borderColor" => "rgba(255, 206, 86, 1)",
            "data" => $kepwali,
        );

        $chart_res[] = array(
            "label" => "Instruksi Walikota",
            "backgroundColor" => "rgba(75, 192, 192, 0.2)",
            "borderColor" => "rgba(75, 192, 192, 1)",
            "data" => $instruksi,
        );

        $chart_res[] = array(
            "label" => "Peraturan Bersama Walikota",
            "backgroundColor" => "rgba(153, 102, 255, 0.2)",
            "borderColor" => "rgba(153, 102, 255, 1)",
            "data" => $peraturan_bersama,
        );

        $chart_res[] = array(
            "label" => "Peraturan DPRD",
            "backgroundColor" => "rgba(255, 159, 64, 0.2)",
            "borderColor" => "rgba(255, 159, 64, 1)",
            "data" => $peraturan_dprd,
        );


        $data['title'] = "JDIH";
        $data['_view'] = "web/grafik";
        $data['_js'] = "web/grafik_js";

        $data["chart"] = $chart_res;
        $data["tahun"] = $tahun;
        $data["prokum"] = $jenis_arr;

        // $this->print_out_data($chart_res);
        $this->show_layout($data);
    }

    public function tupoksi()
    {
        $data['title'] = "JDIH";
        $data['_view'] = "web/tupoksi";
        $data['_js'] = "web/tupoksi_js";

        $data["tupoksi"] = $this->set_model->get_tupoksi_active();
        $this->show_layout($data);
    }
}
