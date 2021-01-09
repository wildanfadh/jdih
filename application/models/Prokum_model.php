<?php

class Prokum_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function all_prokum($limited = false, $start = 0, $limit = 0, $search = "")
    {
        if ($limited) {
            $this->db->limit($limit, $start);
        }

        if (!empty($search)) {
            $where = "(no_peraturan LIKE '%$search%' OR tentang LIKE '%$search%' OR tahun_peraturan LIKE '%$search%' ";
            $where .= "OR subjek_singkat LIKE '%$search%' OR singkatan LIKE '%$search%' OR nama LIKE '%$search%')";
            $this->db->where($where, NULL);
        }

        $result = $this->db->get_where("v_prokum_detail", array(
            "is_deleted_prokum" => false,
            "is_deleted_jenis" => false,
            "is_deleted_kabinet" => false,
        ));

        return $result->result_array();
    }

    function get_prokum_bytipe($tipe)
    {
        $result = $this->db->get_where("v_prokum_detail", array(
            "tipe" => $tipe,
            "is_deleted_prokum" => false,
            "is_deleted_jenis" => false,
            "is_deleted_kabinet" => false,
            "is_online" => true,
        ));

        return $result->result_array();
    }

    function save_prokum($data)
    {
        $result = $this->db->insert("t_prokum", $data);

        return $result;
    }

    function get_prokum_byid($id)
    {
        $result = $this->db->get_where("v_prokum_detail", array(
            "id" => $id,
            "is_deleted_prokum" => false,
            "is_deleted_jenis" => false,
            "is_deleted_kabinet" => false,
        ));

        return $result->row_array();
    }

    function update_prokum($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("t_prokum", $data);

        return $result;
    }

    function delete_prokum($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("t_prokum", array(
            "is_deleted" => true,
        ));

        return $result;
    }

    function get_prokum_byjenis($jenis)
    {
        $result = $this->db->get_where("v_prokum_detail", array(
            "singkatan" => ucwords($jenis),
            "is_deleted_prokum" => false,
            "is_deleted_jenis" => false,
            "is_deleted_kabinet" => false,
            "is_online" => true,
        ));

        return $result->result_array();
    }

    function filter_prokum($jenis, $nomor, $tahun, $tentang)
    {
        $filter = array();
        if (!empty($nomor)) {
            $filter[] = "no_peraturan LIKE '%$nomor%'";
        }

        if (!empty($tahun)) {
            $filter[] = "tahun_peraturan = $tahun";
        }

        if (!empty($tentang)) {
            $filter[] = "tentang LIKE '%$tentang%'";
        }

        $filter_text = "";
        if (count($filter) > 1) {
            foreach ($filter as $key => $val) {
                if ($key == 0) {
                    $filter_text .= "(" . $val;
                } elseif ((count($filter) - 1) == $key) {
                    $filter_text .= " AND " . $val . ")";
                } else {
                    $filter_text .= " AND " . $val;
                }
            }
        } else {
            $filter_text = $filter[0];
        }

        // $filter = "(no_peraturan LIKE '%$nomor%' OR tahun_peraturan = '$tahun' OR tentang LIKE '%$tentang')";

        $this->db->where($filter_text, NULL);
        if ($jenis != "all") {
            $this->db->where("singkatan", $jenis);
        }

        $result = $this->db->get_where("v_prokum_detail", array(
            "is_deleted_prokum" => false,
            "is_deleted_jenis" => false,
            "is_deleted_kabinet" => false,
            "is_online" => true,
        ));

        return $result->result_array();
    }
}
