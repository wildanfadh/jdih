<?php

class Menu_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_text_jalan()
    {
        $result = $this->db->get("m_text_jalan");

        return $result->result_array();
    }

    function get_text_jalanactive()
    {
        $result = $this->db->get_where("m_text_jalan", array(
            "is_active" => true,
        ));

        return $result->result_array();
    }

    function count_text_jalan()
    {
        return count($this->get_text_jalan());
    }

    function save_text_jalan($data)
    {
        $result = $this->db->insert("m_text_jalan", $data);

        return $result;
    }

    function get_text_jalan_byid($id)
    {
        $result = $this->db->get_where("m_text_jalan", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function update_text_jalan($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_text_jalan", $data);

        return $result;
    }

    function dashboard()
    {
        $prokum_daerah = $this->db->get_where("v_prokum_detail", array(
            "tipe" => PROK_DAERAH,
            "is_deleted_prokum" => false,
        ))->num_rows();

        $prokum_pusat = $this->db->get_where("v_prokum_detail", array(
            "tipe" => PROK_PUSAT,
            "is_deleted_prokum" => false,
        ))->num_rows();

        $prokum_non = $this->db->get_where("v_prokum_detail", array(
            "tipe" => PROK_NON,
            "is_deleted_prokum" => false,
        ))->num_rows();

        $lemari = $this->db->get_where("m_kabinet", array(
            "is_deleted" => false,
        ))->num_rows();

        $result = array(
            "prokum_daerah" => $prokum_daerah,
            "prokum_pusat" => $prokum_pusat,
            "prokum_non" => $prokum_non,
            "lemari" => $lemari,
        );

        return $result;
    }

    function save_survei($data)
    {
        $result = $this->db->insert("t_survey", $data);

        return $result;
    }

    function all_survei()
    {
        $result = $this->db->get("t_survey");

        return $result->result_array();
    }
}
