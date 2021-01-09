<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skpd extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Skpd_model", "skp_model");
    }

    public function index()
    {
        $data["title"] = "Daftar Satuan Kerja Perangkat Daerah (SKPD)";
        $data["_view"] = "skpd/index";
        $data["_js"] = "skpd/index_js";

        $skpd = $this->skp_model->get_all();
        $data["skpd"] = $skpd;

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "nama" => $post["nama"],
                "is_active" => isset($post["is_active"]) ? true : false,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user_id,
            );

            echo $this->skp_model->save($save);
        } else {
            $data["title"] = "Tambah Satuan Kerja Perangkat Daerah (SKPD)";
            $data["_view"] = "skpd/add";
            $data["_js"] = "skpd/add_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "nama" => $post["nama"],
                "is_active" => isset($post["is_active"]) ? true : false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            echo $this->skp_model->update($save, $get["skpd"]);
        } else {
            $skpd = $this->skp_model->get_byid($get["skpd"]);
            $data["skpd"] = $skpd;

            $data["title"] = "Ubah SKPD <small>(" . $skpd["nama"] . ")</small>";
            $data["_view"] = "skpd/edit";
            $data["_js"] = "skpd/edit_js";


            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function delete()
    {
        $get = $this->input->get();
        echo $this->skp_model->delete($get["skpd"]);
    }
}
