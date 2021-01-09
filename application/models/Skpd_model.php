<?php

class Skpd_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $result = $this->db->get_where("m_skpd", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function save($skpd)
    {
        $result = $this->db->insert("m_skpd", $skpd);

        return $result;
    }

    function get_byid($skpd)
    {
        $result = $this->db->get("m_skpd", array(
            "id" => $skpd,
            "is_deleted" => false,
        ));

        return $result->row_array();
    }

    function update($data, $skpd)
    {
        $this->db->where("id", $skpd);
        $result = $this->db->update("m_skpd", $data);

        return $result;
    }

    function delete($skpd)
    {
        $this->db->where("id", $skpd);
        $result = $this->db->update("m_skpd", array(
            "is_deleted" => true,
        ));

        return $result;
    }
}
