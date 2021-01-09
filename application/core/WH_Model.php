<?php

class WH_Model extends CI_Model
{
    var $user_id;
    var $group;

    function __construct()
    {
        parent::__construct();

        $this->user_id = $this->session->userdata("user_id");
        $this->group = $this->session->userdata("group");
    }

    public function print_out_data($data)
    {
        echo "<pre>";
        var_dump($data);
        exit;
    }
}
