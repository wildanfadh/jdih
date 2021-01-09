<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prokum extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Prokum_model", "pro_model");
    }

    private function upload_file($tipe, $file, $filename = "")
    {
        $upload_config = array(
            'upload_path' => './uploads/' . $tipe,
            'allowed_types' => 'pdf|doc|docx',
        );

        if (!empty($filename)) {
            $upload_config['file_name'] = $filename;
        }

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

    public function index()
    {
        $get = $this->input->get();
        $data["tipe"] = $this->ini_tipe_prokum(strtoupper($get["tipe"]));

        $data['title'] = "JDIH";
        $data['_view'] = "prokum/index";
        $data['_js'] = "prokum/index_js";

        $data["prokum"] = $this->pro_model->get_prokum_bytipe($get["tipe"]);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            $go_on = true;
            $filename = "";

            if (!empty($_FILES["file_upload"])) {
                $filename = str_replace(".pdf", "", $_FILES["file_upload"]["name"]);
                $filename = str_replace(" ", "_", $filename);
                $filename = str_replace(".", "_", $filename);
                $filename .= ".pdf";

                $upload = $this->upload_file($post["tipe"], "file_upload", $filename);
                $filename = $post["tipe"] . "/" . $filename;
                if ($upload == false) {
                    $go_on = false;
                }
            }

            if ($go_on) {
                $status_sesuai = "";
                if ($post["status"] == "Berlaku") {
                    $status_sesuai = $post["status_sesuai"];
                } else {
                    $status_sesuai = $post["status_judul"];
                }

                $tg_penetapan = str_replace('/', '-', $post["tg_penetapan"]);
                $tg_penetapan = date("Y-m-d", strtotime($tg_penetapan));

                $tg_pengundangan = str_replace('/', '-', $post["tg_pengundangan"]);
                $tg_pengundangan = date("Y-m-d", strtotime($tg_pengundangan));

                $save = array(
                    "id_jenis" => $post["jenis"],
                    "id_kabinet" => $post["lemari"],
                    "is_online" => isset($post["publish"]) ? true : false,
                    "no_peraturan" => $post["noper"],
                    "tentang" => $post["tentang"],
                    "tahun_peraturan" => $post["tahun"],
                    "jumlah_halaman" => $post["halaman"],
                    "seri_peraturan" => $post["seri"],
                    "subjek_singkat" => $post["subjek"],
                    "dasar_pertimbangan" => strip_tags($post["pertimbangan"]),
                    "dasar_hukum" => strip_tags($post["hukum"]),
                    "catatan_penting" => strip_tags($post["catatan"]),
                    "status_peraturan" => $post["status"],
                    "detail_status_peraturan" => $status_sesuai,
                    "tanggal_penetapan" => $tg_penetapan,
                    "tanggal_pengundangan" => $tg_pengundangan,
                    "noreg_provinsi" => $post["reg_provinsi"],
                    "noreg_daerah" => $post["reg_daerah"],
                    // "file" => $filename,
                    "pihak1" => $post["pihak1"],
                    "pihak2" => $post["pihak2"],
                    "masa_berlaku" => $post["masa_berlaku"],

                    "is_deleted" => false,
                    "created_date" => date("Y-m-d H:i:s"),
                    "created_by" => $this->user_id,
                );

                if (isset($post["is_upload"])) {
                    if (!empty($filename)) {
                        $save["file"] = $filename;
                        $save["is_upload"] = true;
                    }
                } else {
                    $save["file"] = $post["file_select"];
                    $save["is_upload"] = false;
                }

                // $this->print_out_data($save);
                echo $this->pro_model->save_prokum($save);
            } else {
                echo 0;
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "prokum/tambah";
            $data["_js"] = "prokum/tambah_js";

            $data["tipe"] = $this->ini_tipe_prokum(strtoupper($get["tipe"]));
            $data["jenis"] = $this->set_model->get_jenis_bytipe(isset($get["tipe"]) ? $get["tipe"] : $post["tipe"]);
            $data["lemari"] = $this->set_model->all_kabinet();
            $data["file"] = $this->get_dir_contents("../pemkot/backup/app/datapdf");

            // $data["file"] = $this->get_dir_contents("../jdih/backup/app/datapdf");
            // $data["file"] = $this->get_dir_contents("../jdih/dok-jdih-serverlama/datapdf");

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            $go_on = true;
            $filename = "";

            // if (!empty($_FILES["file_upload"])) {
            //     $upload = $this->upload_file($post["tipe"], "file_upload");
            //     $filename = $post["tipe"] . "/" . $_FILES['file_upload']['name'];

            //     $filename = str_replace(" ", "_", $filename);
            //     // $filename = str_replace(".", "_", $filename);
            //     $filename = str_replace("__", "_", $filename);
            //     if ($upload == false) {
            //         $go_on = false;
            //     }
            // }

            if (!empty($_FILES["file_upload"])) {
                $filename = str_replace(".pdf", "", $_FILES["file_upload"]["name"]);
                $filename = str_replace(" ", "_", $filename);
                $filename = str_replace(".", "_", $filename);
                $filename .= ".pdf";

                $upload = $this->upload_file($post["tipe"], "file_upload", $filename);
                $filename = $post["tipe"] . "/" . $filename;
                if ($upload == false) {
                    $go_on = false;
                }
            }

            if ($go_on) {
                $status_sesuai = "";
                if ($post["status"] == "Berlaku") {
                    $status_sesuai = $post["status_sesuai"];
                } else {
                    $status_sesuai = $post["status_judul"];
                }

                $tg_penetapan = str_replace('/', '-', $post["tg_penetapan"]);
                $tg_penetapan = date("Y-m-d", strtotime($tg_penetapan));

                $tg_pengundangan = str_replace('/', '-', $post["tg_pengundangan"]);
                $tg_pengundangan = date("Y-m-d", strtotime($tg_pengundangan));

                $save = array(
                    "id_jenis" => $post["jenis"],
                    "id_kabinet" => $post["lemari"],
                    "is_online" => isset($post["publish"]) ? true : false,
                    "no_peraturan" => $post["noper"],
                    "tentang" => $post["tentang"],
                    "tahun_peraturan" => $post["tahun"],
                    "jumlah_halaman" => $post["halaman"],
                    "seri_peraturan" => $post["seri"],
                    "subjek_singkat" => $post["subjek"],
                    "dasar_pertimbangan" => strip_tags($post["pertimbangan"]),
                    "dasar_hukum" => strip_tags($post["hukum"]),
                    "catatan_penting" => strip_tags($post["catatan"]),
                    "status_peraturan" => $post["status"],
                    "detail_status_peraturan" => $status_sesuai,
                    "tanggal_penetapan" => $tg_penetapan,
                    "tanggal_pengundangan" => $tg_pengundangan,
                    "noreg_provinsi" => $post["reg_provinsi"],
                    "noreg_daerah" => $post["reg_daerah"],
                    "pihak1" => $post["pihak1"],
                    "pihak2" => $post["pihak2"],
                    "masa_berlaku" => $post["masa_berlaku"],

                    "is_deleted" => false,
                    "modified_date" => date("Y-m-d H:i:s"),
                    "modified_by" => $this->user_id,
                );

                if (isset($post["is_upload"])) {
                    if (!empty($filename)) {
                        $save["file"] = $filename;
                        $save["is_upload"] = true;
                    }
                } else {
                    $save["file"] = $post["file_select"];
                    $save["is_upload"] = false;
                }

                // $this->print_out_data($save);
                echo $this->pro_model->update_prokum($post["id"], $save);
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "prokum/ubah";
            $data["_js"] = "prokum/ubah_js";

            $data["tipe"] = $this->ini_tipe_prokum(strtoupper($get["tipe"]));
            $data["jenis"] = $this->set_model->get_jenis_bytipe($get["tipe"]);
            $data["lemari"] = $this->set_model->all_kabinet();
            $data["prokum"] = $this->pro_model->get_prokum_byid($get["id"]);

            $data["prokum"]["tanggal_penetapan"] = date("d/m/Y", strtotime($data["prokum"]["tanggal_penetapan"]));
            $data["prokum"]["tanggal_pengundangan"] = date("d/m/Y", strtotime($data["prokum"]["tanggal_pengundangan"]));
            $data["file"] = $this->get_dir_contents("../pemkot/backup/app/datapdf");
            // $data["file"] = $this->get_dir_contents("../jdih/backup/app/datapdf");

            // $this->print_out_data($data["prokum"]);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus()
    {
        $get = $this->input->get();
        if ($this->pro_model->delete_prokum($get["id"])) {
            redirect(base_url("Prokum?tipe=" . $get["tipe"]));
        }
    }
}
