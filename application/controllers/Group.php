<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Group_model", "gro_model");
    }

    public function index()
    {
        $data["title"] = "Daftar Group";
        $data["_view"] = "group/index";
        $data["_js"] = "group/index_js";

        $group = $this->gro_model->get_all();
        $data["group"] = $group;

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function tambah()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "name" => $post["name"],
                "description" => $post["description"],
                "is_active" => isset($post["is_active"]) ? true : false,
                "is_skpd" => isset($post["is_skpd"]) ? true : false,
                "is_permanent" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user_id,
            );

            echo $this->gro_model->save($save);
        } else {
            $data["title"] = "Tambah Group";
            $data["_view"] = "group/add";
            $data["_js"] = "group/add_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "name" => $post["name"],
                "description" => $post["description"],
                "is_active" => isset($post["is_active"]) ? true : false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user_id,
            );

            echo $this->gro_model->update($save, $get["group"]);
        } else {
            $group = $this->gro_model->get_byid($get["group"]);
            $data["group"] = $group;

            $data["title"] = "Ubah Group <small>(" . $group["name"] . ")</small>";
            $data["_view"] = "group/edit";
            $data["_js"] = "group/edit_js";


            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function delete()
    {
        $get = $this->input->get();
        echo $this->skp_model->delete($get["skpd"]);
    }
}
