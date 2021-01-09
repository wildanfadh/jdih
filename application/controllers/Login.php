<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->ion_auth->logged_in()) {
            redirect(base_url("Dashboard"));
        }

        $data['title'] = "JDIH";
        $data['_view'] = "web/login";
        $data['_js'] = "web/login_js";

        $this->show_layout($data);
    }

    public function login_proc()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $err_message = "";
            if ($this->ion_model->login($this->input->post('username'), $this->input->post('password'))) {
                $group = $this->ion_auth->get_users_groups()->row();
                $this->session->set_userdata("group", $group->id);
                $this->session->set_userdata("group_name", $group->description);

                // jika login sukses, redirect ke dashboard
                $result = $this->ion_model->messages();

                echo base_url("");
            } else {
                // jika login gagal, redirect kembali ke halaman login

                $err_message = str_replace("<p>", "", $this->ion_model->errors());
                $err_message = str_replace("</p>", "", $err_message);

                // echo 'gagal,Username atau password salah';
                // echo 'gagal,' . $err_message;
                echo 0;
            }

            // $this->print_out_data($err_message);
        } else {
            // user tidak login, tampilkan halaman login
            $this->load->view('login');
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('');
    }
}
