<?php

class Disposisi_model extends WH_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        $this->db->trans_begin();

        $this->db->where("id", $data["pengajuan"]);
        $this->db->update("t_pengajuan", array(
            "status" => $data["status"],
        ));

        $save = array(
            "id_pengajuan" => $data["pengajuan"],
            "is_kordinasikan" => isset($data["koordinasikan"]) ? true : false,
            "is_selesaikan" => isset($data["selesaikan"]) ? true : false,
            "is_tindak_lanjuti" => isset($data["tindak_lanjuti"]) ? true : false,
            "is_proses_ketentuan" => isset($data["proses_sesuai"]) ? true : false,
            "is_laporan" => isset($data["buatkan_laporan"]) ? true : false,
            "is_bicarakan" => isset($data["bicarakan"]) ? true : false,
            // "perihal" => $data["perihal"],

            "is_penyusunan" => isset($data["penyusunan"]) ? true : false,
            "is_bantuan" => isset($data["bantuan"]) ? true : false,
            "is_administrasi" => isset($data["administrasi"]) ? true : false,

            "created_date" => date("Y-m-d H:i:s"),
            "created_by" => $this->session->userdata("user_id"),
        );

        if (isset($data["check_keterangan"])) {
            $save["keterangan"] = $data["keterangan"];
        }

        $this->db->insert("t_disposisi", $save);
        // $last_query = $this->db->last_query();
        // $this->print_out_data($save);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {
            $this->db->trans_commit();

            return true;
        }
    }

    public function get_disposisi_byid($disposisi)
    {
        $result = $this->db->get_where("v_disposisi", array(
            "id" => $disposisi,
        ))->row_array();

        return $result;
    }

    public function get_disposisi_bypengajuan($pengajuan)
    {
        $result = $this->db->get_where("v_disposisi", array(
            "pengajuan_id" => $pengajuan,
        ))->row_array();

        return $result;
    }

    // public function count_all_ajax($pengajuan, $all)
    // {
    //     if (!$all)
    //         $this->db->where("created_by", $this->session->userdata("user_id"));

    //     $this->db->where("pengajuan_id", $pengajuan);

    //     $this->db->where("is_deleted", false);
    //     $this->db->where("pengajuan_deleted", false);
    //     return $this->db->count_all('v_penyusunan');
    // }

    // public function filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $pengajuan, $all = true)
    // {
    //     if (!$all)
    //         $this->db->where("pengajuan_created_by", $this->session->userdata("user_id"));

    //     $this->db->where("(nomor_urut LIKE '%$search%'", NULL);
    //     $this->db->where("judul LIKE '%$search%'", NULL);
    //     $this->db->where("keterangan LIKE '%$search%')", NULL);

    //     $this->db->where("pengajuan_id", $pengajuan);

    //     $this->db->where("is_deleted", false);
    //     $this->db->where("pengajuan_deleted", false);

    //     $this->db->order_by($order_field, $order_ascdesc);
    //     $this->db->limit($limit, $start);
    //     $result = $this->db->get('v_penyusunan')->result_array();

    //     return $result;
    // }

    // public function count_filter_ajax($search, $pengajuan, $all)
    // {
    //     if (!$all)
    //         $this->db->where("created_by", $this->session->userdata("user_id"));

    //     $this->db->where("(nomor_urut LIKE '%$search%'", NULL);
    //     $this->db->where("judul LIKE '%$search%'", NULL);
    //     $this->db->where("keterangan LIKE '%$search%')", NULL);

    //     $this->db->where("pengajuan_id", $pengajuan);

    //     $this->db->where("is_deleted", false);
    //     $this->db->where("pengajuan_deleted", false);
    //     return $this->db->get('v_penyusunan')->num_rows();
    // }

    // public function get_bypenyusunan($penyusunan)
    // {
    //     $result = $this->db->get_where("t_disposis", array(
    //         "id_penyusunan" => $penyusunan,
    //     ))->result_array(0);

    //     return $result;
    // }
}
