<?php

class Group_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $result = $this->db->get("groups");

        return $result->result_array();
    }

    function get_byid($group)
    {
        $result = $this->db->get_where("groups", array(
            "id" => $group,
        ));

        return $result->row_array();
    }

    function save($data)
    {
        $result = true;
        $this->db->trans_begin();

        $this->db->insert("groups", $data);
        $group_id = $this->db->insert_id();
        if ($data["is_skpd"]) {
            $this->db->insert("m_skpd", array(
                "id_group" => $group_id,
                "nama" => $data["name"],
                "is_active" => $data["is_active"],

                "is_deleted" => false,
                "created_date" => $data["created_date"],
                "created_by" => $data["created_by"],
            ));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = false;
        } else {
            $this->db->trans_commit();
        }

        return $result;
    }

    function update($data, $group)
    {
        $this->db->where("id", $group);
        $result = $this->db->update("groups", $data);

        return $result;
    }
}
