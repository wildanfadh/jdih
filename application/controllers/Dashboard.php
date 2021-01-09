<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends WH_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->login_check();
    }

    public function index()
    {
        $this->load->model("Menu_model", "men_model");

        $data['title'] = "JDIH";
        $data['_view'] = "dashboard/index";
        $data['_js'] = "dashboard/index_js";

        $data["dashboard"] = $this->men_model->dashboard();
        $data["file"] = $this->get_dir_contents("../jdih/backup/app/datapdf");
        $data["_aside"] = "dashboard/aside";

        // $this->print_out_data($data);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }
}
