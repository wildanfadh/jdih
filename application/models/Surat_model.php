<?php

class Surat_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $result = $this->db->get_where("v_surat", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function get_byid($surat)
    {
        $result = $this->db->get_where("t_surat", array(
            "id" => $surat,
        ));

        return $result->row_array();
    }

    function save($data)
    {
        $result = true;
        $this->db->trans_begin();

        // SURAT
        $this->db->insert("t_surat", $data);
        // SURAT

        // COUNTER
        $counter =  $this->db->get("t_counter", array(
            "id" => COUN_LACAK,
        ))->row_array();

        if (!empty($counter["counter"])) {
            $counter = $counter["counter"] + 1;
        } else {
            $counter = 1;
        }

        $this->db->where("id", COUN_LACAK);
        $this->db->update("t_counter", array(
            "counter" => $counter,
        ));
        // COUNTER

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = false;
        } else {
            $this->db->trans_commit();
        }

        return $result;
    }

    function delete($surat)
    {
        $this->db->where("id", $surat);
        $result = $this->db->update("t_surat", array(
            "is_deleted" => true,

            "modified_by" => $this->session->userdata("user_id"),
            "modified_date" => date("Y-m-d H:i:s"),
        ));

        return $result;
    }

    function update($data, $id){
        $this->db->where("id", $id);
        $result = $this->db->update("t_surat", $data);

        return $result;
    }
}
