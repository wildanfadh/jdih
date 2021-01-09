<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Menu_model", "men_model");
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

    public function text_jalan()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "menu/text_jalan";
        $data["_js"] = "menu/text_jalan_js";

        $data["text"] = $this->men_model->get_text_jalan();
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_text_jalan()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "text" => $post["text"],
                "is_active" => isset($post["active"]) ? true : false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user_id,
            );

            echo $this->men_model->save_text_jalan($save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "menu/tambah_text_jalan";
            $data["_js"] = "menu/tambah_text_jalan_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_text_jalan()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            $save = array(
                "text" => $post["text"],
                "is_active" => isset($post["active"]) ? true : false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            echo $this->men_model->update_text_jalan($post["id"], $save);
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "menu/ubah_text_jalan";
            $data["_js"] = "menu/ubah_text_jalan_js";

            $data["text_jalan"] = $this->men_model->get_text_jalan_byid($get["id"]);

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function promperda()
    {
        $data["title"] = "JDIH";
        $data["_view"] = "menu/promperda";
        $data["_js"] = "menu/promperda_js";

        $data["promperda"] = $this->men_model->all_promperda();
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah_promperda()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            // $this->print_out_data($post);
            $go_on = true;
            $filename = "";

            if (!empty($_FILES["file_upload"])) {
                $filename = str_replace(".pdf", "", $_FILES["file_upload"]["name"]);
                $filename = str_replace(" ", "_", $filename);
                $filename = str_replace(".", "_", $filename);
                $filename .= ".pdf";

                $upload = $this->upload_file("PROMPERDA", "file_upload", $filename);
                $filename = "PROMPERDA/" . $filename;
                if ($upload == false) {
                    $go_on = false;
                }
            }

            if ($go_on) {
                $save = array(
                    "tahun" => $post["tahun"],
                    "keterangan" => $post["keterangan"],
                    "realisasi" => $post["realisasi"],
                    "persentase" => $post["persentase"],

                    "filename" => $filename,

                    "is_deleted" => false,
                    "created_date" => date("Y-m-d H:i:s"),
                    "created_by" => $this->user_id,
                );

                echo $this->men_model->save_promperda($save);
            } else {
                echo 0;
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "menu/tambah_promperda";
            $data["_js"] = "menu/tambah_promperda_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah_promperda()
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

                $upload = $this->upload_file("PROMPERDA", "file_upload", $filename);
                $filename = "PROMPERDA/" . $filename;
                if ($upload == false) {
                    $go_on = false;
                }
            }

            if ($go_on) {
                $save = array(
                    "tahun" => $post["tahun"],
                    "keterangan" => $post["keterangan"],
                    "realisasi" => $post["realisasi"],
                    "persentase" => $post["persentase"],

                    "modified_date" => date("Y-m-d H:i:s"),
                    "modified_by" => $this->user_id,
                );

                if (!empty($filename)) {
                    $save["filename"] = $filename;
                }

                echo $this->men_model->update_promperda($post["id"], $save);
            } else {
                echo 0;
            }
        } else {
            $data["title"] = "JDIH";
            $data["_view"] = "menu/ubah_promperda";
            $data["_js"] = "menu/ubah_promperda_js";

            $data["promperda"] = $this->men_model->get_promperdabyid($get["id"]);

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function delete_promperda()
    {
        $get = $this->input->get();

        echo $this->men_model->delete_promperda($get["id"], array(
            "is_deleted" => true,
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->user_id,
        ));
    }
}
