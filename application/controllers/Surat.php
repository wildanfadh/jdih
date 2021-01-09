<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Surat_model", "sur_model");
    }

    public function index()
    {
        $get = $this->input->get();

        $data["title"] = "Daftar Pengajuan Surat";
        $data["_view"] = "surat/index";
        $data["_js"] = "surat/index_js";

        $surat = $this->sur_model->get_all();
        $data["surat"] = $surat;

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            $go_on = true;
            $berkas = array();

            $no_surat = str_replace("/", "", $post["no_surat"]);
            $no_surat = str_replace(".", "", $no_surat);
            $no_surat = str_replace("-", "", $no_surat);
            foreach ($_FILES as $key => $val) {
                $config[$key] = array(
                    "upload_path"       => "./uploads/"  . TIPE_4 . "/" . date("Y") . "/" . $no_surat . "/",
                    "allowed_types"     => "pdf|doc|docx|jpg|jpeg|png",
                    "overwrite"         => 1,
                );

                $this->load->library("upload", $config[$key]);
                $this->upload->initialize($config[$key]);

                if (!is_dir("uploads")) {
                    mkdir("./uploads", 0777, true);
                }

                $dir_exist = true;
                if (!is_dir("uploads/" . TIPE_4 . "/" . date("Y") . "/" . $no_surat)) {
                    mkdir("./uploads/" . TIPE_4 . "/" . date("Y") . "/" . $no_surat, 0777, true);
                    $dir_exist = false;
                }

                if ($this->upload->do_upload($key)) {
                    $this->upload->data();
                    $berkas[] = array(
                        "berkas" => strtolower($key),
                        "filename" => date("Y") . "/" . $no_surat . "/" . $val["name"],
                    );
                } else {
                    var_dump(array('error' => $this->upload->display_errors('<span>', '</span>')));
                    $go_on = false;
                }
            }

            if ($go_on) {
                $tanggal_surat = str_replace('/', '-', $post["tanggal_surat"]);
                $tanggal_surat = date("Y-m-d", strtotime($tanggal_surat));

                $tanggal_terima = str_replace('/', '-', $post["tanggal_terima"]);
                $tanggal_terima = date("Y-m-d", strtotime($tanggal_terima));

                $save = array(
                    "id_skpd" => $this->session->userdata("id_skpd"),
                    "no_lacak" => $this->counter(COUN_LACAK),
                    "nomor_surat" => $post["no_surat"],
                    "perihal" => $post["tentang"],
                    "tanggal_surat" => $tanggal_surat,
                    "tanggal_terima" => $tanggal_terima,

                    "is_deleted" => false,
                    "created_date" => date("Y-m-d H:i:s"),
                    "created_by" => $this->user_id,
                );

                foreach ($berkas as $val) {
                    $save[$val["berkas"]] = $val["filename"];
                }

                echo $this->sur_model->save($save);
            } else {
                echo 0;
            }
        } else {
            $data["title"] = "Tambah Surat Pengajuan";
            $data["_view"] = "surat/add";
            $data["_js"] = "surat/add_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus()
    {
        $get = $this->input->get();
        echo $this->sur_model->delete($get["surat"]);
    }

    public function ubah()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $go_on = true;
            $berkas = array();

            $no_surat = str_replace("/", "", $post["no_surat"]);
            $no_surat = str_replace(".", "", $no_surat);
            $no_surat = str_replace("-", "", $no_surat);
            foreach ($_FILES as $key => $val) {
                if ($key == "surat_pengajuan" && empty($post["is_change_surat"])) {
                    continue;
                } elseif ($key == "draft_prokum" && empty($post["is_change_draft"])) {
                    continue;
                }

                $config[$key] = array(
                    "upload_path"       => "./uploads/"  . TIPE_4 . "/" . date("Y") . "/" . $no_surat . "/",
                    "allowed_types"     => "pdf|doc|docx|jpg|jpeg|png",
                    "overwrite"         => 1,
                );

                $this->load->library("upload", $config[$key]);
                $this->upload->initialize($config[$key]);

                if (!is_dir("uploads")) {
                    mkdir("./uploads", 0777, true);
                }

                $dir_exist = true;
                if (!is_dir("uploads/" . TIPE_4 . "/" . date("Y") . "/" . $no_surat)) {
                    mkdir("./uploads/" . TIPE_4 . "/" . date("Y") . "/" . $no_surat, 0777, true);
                    $dir_exist = false;
                }

                if ($this->upload->do_upload($key)) {
                    $this->upload->data();
                    $berkas[] = array(
                        "berkas" => strtolower($key),
                        "filename" => date("Y") . "/" . $no_surat . "/" . $val["name"],
                    );
                } else {
                    var_dump(array('error' => $this->upload->display_errors('<span>', '</span>')));
                    $go_on = false;
                }
            }

            if ($go_on) {
                $tanggal_surat = str_replace('/', '-', $post["tanggal_surat"]);
                $tanggal_surat = date("Y-m-d", strtotime($tanggal_surat));

                $tanggal_terima = str_replace('/', '-', $post["tanggal_terima"]);
                $tanggal_terima = date("Y-m-d", strtotime($tanggal_terima));

                $save = array(
                    "nomor_surat" => $post["no_surat"],
                    "perihal" => $post["tentang"],
                    "tanggal_surat" => $tanggal_surat,
                    "tanggal_terima" => $tanggal_terima,

                    "is_deleted" => false,
                    "modified_date" => date("Y-m-d H:i:s"),
                    "modified_by" => $this->user_id,
                );

                foreach ($berkas as $val) {
                    $save[$val["berkas"]] = $val["filename"];
                }

                echo $this->sur_model->update($save, $get["surat"]);
            } else {
                echo 0;
            }
        } else {
            $surat = $this->sur_model->get_byid($get["surat"]);
            $data["surat"] = $surat;

            $data["title"] = "Ubah Surat Pengajuan <small>(" . $surat["nomor_surat"] . ")</small>";
            $data["_view"] = "surat/edit";
            $data["_js"] = "surat/edit_js";

            // $this->print_out_data($data);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }
}
