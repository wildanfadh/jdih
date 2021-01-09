<?php

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    private function print_out_data($data)
    {
        echo "<pre>";
        var_dump($data);
        exit;
    }

    public function count_all_ajax()
    {
        $this->db->where("user_active", true);

        return $this->db->count_all('v_user_group');
    }

    public function filter_ajax($search, $limit, $start, $order_field, $order_ascdesc)
    {
        $this->db->where("(user_username LIKE '%$search%'", NULL);
        $this->db->where("user_email LIKE '%$search%'", NULL);
        $this->db->where("group_description LIKE '%$search%'", NULL);
        $this->db->where("user_full_name LIKE '%$search%')", NULL);

        $this->db->where("user_active", true);

        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);

        $result = $this->db->get('v_user_group')->result_array();

        return $result;
    }

    public function count_filter_ajax($search)
    {
        $this->db->where("(user_username LIKE '%$search%'", NULL);
        $this->db->where("user_email LIKE '%$search%'", NULL);
        $this->db->where("group_description LIKE '%$search%'", NULL);
        $this->db->where("user_full_name LIKE '%$search%')", NULL);

        $this->db->where("user_active", true);

        return $this->db->get('v_user_group')->num_rows();
    }

    public function nonactive($user)
    {
        $this->db->where("id", $user);
        $result = $this->db->update("users", array(
            "active" => 0,
        ));

        return $result;
    }
}
