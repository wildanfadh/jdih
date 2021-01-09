<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();
    }

    private function upload_file($tipe, $file)
    {
        $upload_config = array(
            'upload_path' => './uploads/' . $tipe,
            'allowed_types' => 'pdf|doc|docx',
        );

        $this->load->library("upload", $upload_config);

        // create an album if not already exist in uploads dir
        // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
        if (!is_dir("uploads")) {
            mkdir("./uploads", 0777, true);
        }

        $dir_exist = true; // flag for checking the directory exist or not
        if (!is_dir("uploads/" . $tipe)) {
            mkdir("./uploads/" . $tipe, 0777, true);
            $dir_exist = false; // dir not exist
        }

        if (!$this->upload->do_upload($file)) {
            // upload failed
            //delete dir if not exist before upload
            if (!$dir_exist)
                rmdir('./uploads/' . $tipe);

            return array('error' => $this->upload->display_errors('<span>', '</span>'));
        } else {
            // upload success
            $upload_data = $this->upload->data();
            return "true";
        }
    }

    public function jenis()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "setting/jenis";
        $data["_js"] = "setting/jenis_js";

        $data["jenis"] = $this->set_model->all_jenis();
        foreach ($data["jenis"] as $key => $val) {
            $data["jenis"][$key]["tipe_texted"] = ucwords($this->ini_tipe_prokum($val["tipe"])["texted"]);
        }

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_jenis()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "tipe" => $post["tipe"],
                "nama" => $post["nama"],
                "singkatan" => $post["singkatan"],
                "is_deleted" => 0,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user_id,
            );

            echo $this->set_model->save_jenis($save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/tambah_jenis";
            $data["_js"] = "setting/tambah_jenis_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_jenis()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "tipe" => $post["tipe"],
                "nama" => $post["nama"],
                "singkatan" => $post["singkatan"],

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            echo $this->set_model->update_jenis($post["id"], $save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/ubah_jenis";
            $data["_js"] = "setting/ubah_jenis_js";

            $data["jenis"] = $this->set_model->get_jenis_byid($get["id"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus_jenis()
    {
        $get = $this->input->get();
        // echo $this->set_model->delete_jenis($get["id"]);
        if ($this->set_model->delete_jenis($get["id"])) {
            redirect(base_url("Setting/jenis"));
        }
    }

    // KABINET
    public function lemari()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "setting/kabinet";
        $data["_js"] = "setting/kabinet_js";
        $data["_aside"] = "setting/aside";

        $data["kabinet"] = $this->set_model->all_kabinet();

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_lemari()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "macam" => $post["macam"],
                "keterangan" => $post["keterangan"],
                "posisi" => $post["posisi"],
                "is_deleted" => 0,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user_id,
            );

            echo $this->set_model->save_kabinet($save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/tambah_kabinet";
            $data["_js"] = "setting/tambah_kabinet_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_lemari()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "macam" => $post["macam"],
                "keterangan" => $post["keterangan"],
                "posisi" => $post["posisi"],

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            echo $this->set_model->update_kabinet($post["id"], $save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/ubah_kabinet";
            $data["_js"] = "setting/ubah_kabinet_js";

            $data["kabinet"] = $this->set_model->get_kabinet_byid($get["id"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus_lemari()
    {
        $get = $this->input->get();
        // echo $this->set_model->delete_kabinet($get["id"]);
        if ($this->set_model->delete_kabinet($get["id"])) {
            redirect(base_url("Setting/lemari"));
        }
    }

    // PROFIL
    public function profil()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "setting/profil";
        $data["_js"] = "setting/profil_js";

        $data["profil"] = $this->set_model->all_profile();

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_profil()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $filename = str_replace(" ", "_", $post["walikota"]) . ".jpg";
            $directory = "IMAGES/WALIKOTA";
            if ($this->upload_file2($directory, $filename)) {
                $profil = array(
                    "walikota" => $post["walikota"],
                    "foto" => $directory . "/" . $filename,
                    "periode_awal" => $post["periode_awal"],
                    "periode_akhir" => !empty($post["periode_akhir"]) ? $post["periode_akhir"] : "",
                    "is_active" => !empty($post["active"]) ? $post["active"] : false,
                    "is_deleted" => false,

                    "created_date" => date("Y-m-d H:i:s"),
                    "created_by" => $this->user_id,
                );

                echo $this->set_model->save_profil($profil, $post["visi"], $post["misi"]);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/tambah_profil";
            $data["_js"] = "setting/tambah_profil_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_profil()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $profil = array(
                "walikota" => $post["walikota"],
                "periode_awal" => $post["periode_awal"],
                "periode_akhir" => !empty($post["periode_akhir"]) ? $post["periode_akhir"] : "",
                "is_active" => !empty($post["active"]) ? $post["active"] : false,
                "is_deleted" => false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            if ($post["is_changed"] == "1") {
                $filename = str_replace(" ", "_", $post["walikota"]) . ".jpg";
                $directory = "IMAGES/WALIKOTA";

                if ($this->upload_file2($directory, $filename)) {
                    $profil["foto"] = $directory . "/" . $filename;

                    echo $this->set_model->update_profil($post["id"], $profil, $post["visi"], $post["misi"]);
                }
            } else {
                echo $this->set_model->update_profil($post["id"], $profil, $post["visi"], $post["misi"]);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/ubah_profil";
            $data["_js"] = "setting/ubah_profil_js";

            $data["profil"] = $this->set_model->get_profile_byid($get["id"]);
            $data["profil"]["visi"] = $this->set_model->get_visi_byprofil($get["id"]);
            $data["profil"]["misi"] = $this->set_model->get_misi_byprofil($get["id"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus_profil()
    {
        $get = $this->input->get();
        // echo $this->set_model->delete_profil($get["id"]);
        if ($this->set_model->delete_profil($get["id"])) {
            redirect(base_url("Setting/profil"));
        }
    }

    public function personil()
    {
        $get = $this->input->get();
        $data["title"] = "JDIH";
        $data["_view"] = "setting/personil";
        $data["_js"] = "setting/personil_js";

        $data["personil"] = $this->set_model->get_personil_byprofile($get["id"]);
        $data["id_profil"] = $this->input->get("id");
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_personil()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $filename = str_replace(" ", "_", $post["nama"]) . ".jpg";
            $directory = "IMAGES/PERSONIL";
            if ($this->upload_file2($directory, $filename)) {
                $personil = array(
                    "id_profil" => $post["id_profil"],
                    "nama" => $post["nama"],
                    "gelar" => $post["gelar"],
                    "posisi" => $post["posisi"],
                    "foto" => $directory . "/" . $filename,
                    "jabatan" => $post["jabatan"],
                    "is_deleted" => false,

                    "created_date" => date("Y-m-d H:i:s"),
                    "created_by" => $this->user_id,
                );

                echo $this->set_model->save_personil($personil);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/tambah_personil";
            $data["_js"] = "setting/tambah_personil_js";

            $data["id_profil"] = $this->input->get("id");
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_personil()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $personil = array(
                "nama" => $post["nama"],
                "gelar" => $post["gelar"],
                "posisi" => $post["posisi"],
                "jabatan" => $post["jabatan"],
                "is_deleted" => false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            if ($post["is_changed"] == "1") {
                $filename = str_replace(" ", "_", $post["nama"]) . ".jpg";
                $directory = "IMAGES/PERSONIL";

                if ($this->upload_file2($directory, $filename)) {
                    $personil["foto"] = $directory . "/" . $filename;

                    echo $this->set_model->update_personil($post["id"], $personil);
                }
            } else {
                echo $this->set_model->update_personil($post["id"], $personil);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/ubah_personil";
            $data["_js"] = "setting/ubah_personil_js";

            $data["personil"] = $this->set_model->get_personil_byid($get["id"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus_personil()
    {
        $get = $this->input->get();
        echo $this->set_model->delete_personil($get["id"]);
    }

    public function agenda()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "setting/agenda";
        $data["_js"] = "setting/agenda_js";

        $data["agenda"] = $this->set_model->all_agenda();
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_agenda()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $tanggal_mulai = str_replace('/', '-', $post["tg_mulai"]);
            $tanggal_mulai = date("Y-m-d", strtotime($tanggal_mulai));

            $tanggal_selesai = str_replace('/', '-', $post["tg_selesai"]);
            $tanggal_selesai = date("Y-m-d", strtotime($tanggal_selesai));

            $save = array(
                "judul" => $post["judul"],
                "isi_agenda" => $post["isi"],
                "tanggal_mulai" => $tanggal_mulai,
                "tanggal_selesai" => $tanggal_selesai,
                "waktu" => $post["waktu"],
                "tempat" => $post["tempat"],
                "is_online" => isset($post["publish"]) ? true : false,

                "is_deleted" => false,
                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user_id,
            );

            echo $this->set_model->save_agenda($save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/tambah_agenda";
            $data["_js"] = "setting/tambah_agenda_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_agenda()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            $tanggal_mulai = str_replace('/', '-', $post["tg_mulai"]);
            $tanggal_mulai = date("Y-m-d", strtotime($tanggal_mulai));

            $tanggal_selesai = str_replace('/', '-', $post["tg_selesai"]);
            $tanggal_selesai = date("Y-m-d", strtotime($tanggal_selesai));

            $save = array(
                "judul" => $post["judul"],
                "isi_agenda" => $post["isi"],
                "tanggal_mulai" => $tanggal_mulai,
                "tanggal_selesai" => $tanggal_selesai,
                "waktu" => $post["waktu"],
                "tempat" => $post["tempat"],
                "is_online" => isset($post["publish"]) ? true : false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            echo $this->set_model->update_agenda($post["id"], $save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/ubah_agenda";
            $data["_js"] = "setting/ubah_agenda_js";

            $data["agenda"] = $this->set_model->get_agenda($get["id"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus_agenda()
    {
        $get = $this->input->get();
        echo $this->set_model->delete_agenda($get["id"]);
    }

    public function tupoksi()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "setting/tupoksi";
        $data["_js"] = "setting/tupoksi_js";

        $data["tupoksi"] = $this->set_model->all_tupoksi();

        // $this->print_out_data($data);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_tupoksi()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $go_on = true;
            $filename = "";

            if (!empty($_FILES["file_upload"])) {
                $upload = $this->upload_file("TUPOKSI/", "file_upload");
                $filename = "TUPOKSI/" . $_FILES['file_upload']['name'];

                $filename = str_replace(" ", "_", $filename);
                if ($upload == false) {
                    $go_on = false;
                }
            }

            if ($go_on) {
                $save = array(
                    "tahun" => $post["tahun"],
                    "is_active" => isset($post["active"]) ? true : false,

                    "is_deleted" => false,
                    "created_date" => date("Y-m-d H:i:s"),
                    "created_by" => $this->user_id,
                );

                if (!empty($filename)) {
                    $save["file"] = $filename;
                }

                echo $this->set_model->save_tupoksi($save);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/tambah_tupoksi";
            $data["_js"] = "setting/tambah_tupoksi_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_tupoksi()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $go_on = true;
            $filename = "";

            if (!empty($_FILES["file_upload"])) {
                $upload = $this->upload_file("TUPOKSI/", "file_upload");
                $filename = "TUPOKSI/" . $_FILES['file_upload']['name'];

                $filename = str_replace(" ", "_", $filename);
                if ($upload == false) {
                    $go_on = false;
                }
            }

            if ($go_on) {
                $save = array(
                    "tahun" => $post["tahun"],
                    "is_active" => isset($post["active"]) ? true : false,

                    "modified_date" => date("Y-m-d H:i:s"),
                    "modified_by" => $this->user_id,
                );

                if (!empty($filename)) {
                    $save["file"] = $filename;
                }

                echo $this->set_model->update_tupoksi($post["id"], $save);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "setting/ubah_tupoksi";
            $data["_js"] = "setting/ubah_tupoksi_js";

            $data["tupoksi"] = $this->set_model->get_tupoksi_byid($get["id"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus_tupoksi()
    {
        $get = $this->input->get();
        echo $this->set_model->delete_tupoksi($get["id"]);
    }
}
