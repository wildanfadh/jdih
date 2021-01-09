<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends WH_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model("Disposisi_model", "dis_model");
    }

    public function index()
    {
        $get = $this->input->get();
        $this->load->library('pdf');

        $disposisi = $this->dis_model->get_disposisi_bypengajuan($get["pengajuan"]);
        $data["disposisi"] = $disposisi;

        // $this->print_out_data($data);

        $html = $this->load->view('template/export', $data, true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }
}
