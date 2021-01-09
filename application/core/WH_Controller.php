<?php

class WH_Controller extends CI_Controller
{
    var $user_id;
    var $group;

    function __construct()
    {
        parent::__construct();

        $this->load->model('Ion_auth_model', 'ion_model');
        $this->load->model("Setting_model", "set_model");

        $this->user_id = $this->session->userdata("user_id");
        $this->group = $this->session->userdata("group");
    }

    public function login_check()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url("Login"));
        }
    }

    public function print_out_data($data)
    {
        echo "<pre>";
        var_dump($data);
        exit;
    }

    public function set_nav()
    {
        $nav = current_url();
        $params = $_SERVER['QUERY_STRING'];
        $nav = $nav . '?' . $params;
        // $this->print_out_data($nav);

        $nav = strtolower($nav);
        $nav = explode("/", $nav);
        $count_nav = count($nav);

        $active = "";
        if ($count_nav > 5) {
            $nav = $nav[4] . "/" . $nav[5];
            // $this->print_out_data($nav);

            // MENU WEB
            if (strpos($nav, 'text_jalan') !== false) {
                $active = NAVP_MENU_WEB;
                $nav = NAVC_MENU_WEB_1;
            } elseif (strpos($nav, 'profil') !== false) {
                $active = NAVP_MENU_WEB;
                $nav = NAVC_MENU_WEB_2;
            } elseif (strpos($nav, 'agenda') !== false) {
                $active = NAVP_MENU_WEB;
                $nav = NAVC_MENU_WEB_3;
            } elseif (strpos($nav, 'tupoksi') !== false) {
                $active = NAVP_MENU_WEB;
                $nav = NAVC_MENU_WEB_4;
            }
            // SETTING
            elseif (strpos($nav, 'lemari') !== false) {
                $active = NAVP_PENGATURAN;
                $nav = NAVC_PENGATURAN_2;
            }
            // REPORT PRODUK HUKUM
            elseif (strpos($nav, 'report') !== false) {
                $active = NAVP_REPORT;
                if (strpos($nav, 'penyusunan') !== false) {
                    $nav = NAVC_REPORT_2;
                    if ($this->group == PERM_SKPD) {
                        $active = NAVP_PROKUM;
                    }
                } else {
                    $nav = NAVC_REPORT_1;
                }
            }
            // PENGAJUAN
            elseif (strpos($nav, 'pengajuan') !== false) {
                $active = NAVP_PROKUM;
                if (strpos($nav, 'penyusunan') !== false) {
                    $nav = NAVC_PROKUM_2;
                } else {
                    $nav = NAVC_PROKUM_1;
                }
            }
            // KONSULTASI
            elseif (strpos($nav, 'konsultasi') !== false) {
                $active = "";
                $nav = NAVC_KONSULTASI;
            }
        } else {
            $nav  = $nav[4];
            // $this->print_out_data($nav);

            // DASHBOARD
            if (strpos($nav, 'dashboard') !== false) {
                $active = "";
                $nav = NAVC_DASHBOARD;
            }
            // SETTING
            elseif (strpos($nav, 'user') !== false) {
                $active = NAVP_PENGATURAN;
                $nav = NAVC_PENGATURAN_1;
            }
            // DOKUMENTASI HUKUM
            elseif (strpos($nav, 'prokum') !== false) {
                $active = NAVP_DOKUM;
                if (strpos($nav, 'daerah') !== false) {
                    $nav = NAVC_DOKUM_1;
                } elseif (strpos($nav, 'pusat') !== false) {
                    $nav = NAVC_DOKUM_2;
                } elseif (strpos($nav, 'non') !== false) {
                    $nav = NAVC_DOKUM_3;
                }
            }
            // PENGAJUAN
            elseif (strpos($nav, 'pengajuan') !== false) {
                $active = NAVP_PROKUM;
                $nav = NAVC_PROKUM_1;
            }
            // KONSULTASI
            elseif (strpos($nav, 'konsultasi') !== false) {
                $active = "";
                $nav = NAVC_KONSULTASI;
            }
        }

        return array(
            "active" => $active,
            "nav" => $nav,
        );
    }

    public function show_layout($data, $layout = LAYOUT_WEB)
    {
        $ip = $this->input->ip_address(); // Mendapatkan IP user
        $counter = $this->set_model->visitor($ip);
        $data["counter"] = $counter;

        if ($layout == LAYOUT_WEB) {
            $this->load->model("Menu_model", "men_model");

            $data["text_jalan"] = $this->men_model->get_text_jalanactive();
            $this->load->view('layout/layout_web', $data);
        } elseif ($layout == LAYOUT_DASHBOARD) {
            $group = $this->session->userdata("group");

            $data["group"] = $group;
            $data["group_name"] = $this->session->userdata("group_name");

            $nav = $this->set_nav();
            // $this->print_out_data($nav);

            $data["active"] = $nav["active"];
            $data["nav"] = $nav["nav"];

            $this->load->view('layout/layout_dash', $data);
        }
    }

    public function ini_tipe_prokum($tipe)
    {
        $result = array();
        if ($tipe == PROK_DAERAH) {
            $result = array(
                "default" => "daerah",
                "full" => "prokum_daerah",
                "texted" => "produk hukum daerah",
                "texted_prokum" => "prokum daerah",
            );
        } elseif ($tipe == PROK_PUSAT) {
            $result = array(
                "default" => "pusat",
                "full" => "prokum_pusat",
                "texted" => "produk hukum pusat",
                "texted_prokum" => "prokum pusat",
            );
        } elseif ($tipe == PROK_NON) {
            $result = array(
                "default" => "non",
                "full" => "prokum_non",
                "texted" => "produk non hukum",
                "texted_prokum" => "non prokum",
            );
        }

        return $result;
    }

    public function upload_file2($tipe, $file)
    {
        // create an album if not already exist in uploads dir
        // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
        if (!is_dir("uploads")) {
            mkdir("./uploads", 0777, true);
        }

        if (!is_dir("uploads/" . $tipe)) {
            mkdir("./uploads/" . $tipe, 0777, true);
        }

        return move_uploaded_file($_FILES['blob']['tmp_name'], "./uploads/" . $tipe . "/" . $file);
    }

    public function get_dir_contents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);

            if (!is_dir($path)) {
                // $results[] = $path;
                $results[] = $value;
            } else if ($value != "." && $value != "..") {
                // getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;

        // echo "<pre>";
        // // var_dump(getDirContents('../pemkot/backup/app/datapdf'));
        // var_dump(getDirContents('../jdih/assets/extra-images'));}
    }

    public function counter_old($counter)
    {
        $counter = $this->set_model->counter($counter)["counter"];
        if ($counter == 0) {
            $counter = 1;
        } else {
            $counter++;
        }

        $counter = str_pad($counter, 3, "0", STR_PAD_LEFT);
        $counter_m = "";
        switch (date("m")) {
            case 1:
                $counter_m = "I";
                break;
            case 2:
                $counter_m = "II";
                break;
            case 3:
                $counter_m = "III";
                break;
            case 4:
                $counter_m = "IV";
                break;
            case 5:
                $counter_m = "V";
                break;
            case 6:
                $counter_m = "VI";
                break;
            case 7:
                $counter_m = "VII";
                break;
            case 8:
                $counter_m = "VIII";
                break;
            case 9:
                $counter_m = "IX";
                break;
            case 10:
                $counter_m = "X";
                break;
            case 11:
                $counter_m = "XI";
                break;
            case 12:
                $counter_m = "XII";
                break;
        }

        $counter = $counter . "/" . $counter_m;
        return $counter;
    }

    public function counter($counter)
    {
        $data = $counter;
        $counter = $this->set_model->counter($counter)["counter"];
        $counter_result = $counter;

        if ($counter == 0) {
            $counter = 1;
        } else {
            $counter++;
        }

        $counter = str_pad($counter, 4, "0", STR_PAD_LEFT);
        $counter_m = "";
        switch (date("m")) {
            case 1:
                $counter_m = "I";
                break;
            case 2:
                $counter_m = "II";
                break;
            case 3:
                $counter_m = "III";
                break;
            case 4:
                $counter_m = "IV";
                break;
            case 5:
                $counter_m = "V";
                break;
            case 6:
                $counter_m = "VI";
                break;
            case 7:
                $counter_m = "VII";
                break;
            case 8:
                $counter_m = "VIII";
                break;
            case 9:
                $counter_m = "IX";
                break;
            case 10:
                $counter_m = "X";
                break;
            case 11:
                $counter_m = "XI";
                break;
            case 12:
                $counter_m = "XII";
                break;
        }

        $year = date("Y");
        $counter = "$year/$counter_m/$counter";

        $counter = array(
            "result" => $counter,
            "counter" => $counter_result,
        );

        return $counter;
    }
}
