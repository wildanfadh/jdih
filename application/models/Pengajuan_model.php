<?php

class Pengajuan_model extends CI_Model
{
    var $user;
    var $group;

    function __construct()
    {
        parent::__construct();
        $this->group = $this->session->userdata("group");
        $this->user = $this->session->userdata("user_id");
    }

    private function print_out_data($data)
    {
        echo "<pre>";
        var_dump($data);
        exit;
    }

    private function initiate_save($data, $status, $custom = NULL)
    {
        $save = "";
        if ($status == SYSTEM_ADD) {
            $save = array(
                "jenis_pengajuan" => $data["jenis"],
                "judul" => $data["judul"],
                "nama" => $data["nama"],
                "jabatan" => $data["jabatan"],
                "nomor_hp" => $data["nomor"],
                "jumlah_prokum" => $data["jumlah"],

                "file_pengajuan_word" => $data["file_word"],
                "file_pengajuan_excel" => $data["file_excel"],
                "file_pengajuan_tambahan" => $data["file_tambahan"],

                "status" => PENGAJUAN_MASUK,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->user,
            );
        } elseif ($status == SYSTEM_UPDATE) {
            $save = array(
                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user,
            );

            if (!empty($data["jenis"]))
                $save["jenis_pengajuan"] = $data["jenis"];

            if (!empty($data["judul"]))
                $save["judul"] = $data["judul"];

            if (!empty($data["nama"]))
                $save["nama"] = $data["nama"];

            if (!empty($data["jabatan"]))
                $save["jabatan"] = $data["jabatan"];

            if (!empty($data["nomor"]))
                $save["nomor_hp"] = $data["nomor"];

            if (!empty($data["jumlah"]))
                $save["jumlah_prokum"] = $data["jumlah"];

            if (!empty($data["file_word"]))
                $save["file_pengajuan_word"] = $data["file_word"];

            if (!empty($data["file_excel"]))
                $save["file_pengajuan_excel"] = $data["file_excel"];

            if (!empty($data["file_tambahan"]))
                $save["file_pengajuan_tambahan"] = $data["file_tambahan"];

            if (!empty($data["status"]))
                $save["status"] = $data["status"];

            if (!empty($data["keterangan"]))
                $save["keterangan"] = $data["keterangan"];
        } elseif ($status == SYSTEM_DELETE) {
            $save = array(
                "is_deleted" => true,
                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->user,
            );
        }

        if (!empty($custom)) {
            foreach ($custom as $kcus => $cus) {
                $save[$kcus] = $cus;
            }
        }

        return $save;
    }

    // FILTER AREA
    private function filter($all)
    {
        if ($this->group == PERM_SKPD) {
            $this->db->where("user_id", $this->user);
        } else {
            if ($all > 1) {
                $this->db->where("user_id", $all);
            }

            if ($this->group == PERM_RESEPSIONIS) {
                $this->db->where("status", PENGAJUAN_MASUK);
            } elseif ($this->group == PERM_KABAG) {
                $this->db->where("status", PENGAJUAN_TERUS);
            } elseif (in_array($this->group, array(PERM_PERUNDANGAN, PERM_DOKUM, PERM_BANKUM))) {
                $this->db->where("status = " . PENGAJUAN_TERIMA . " OR status = " . PENGAJUAN_PROSES);
            }
        }
    }

    private function report($all, $perm, $tipe, $status)
    {
        if ($all > 1) {
            $this->db->where("user_id", $all);
        }

        if ($status != "a") {
            if (in_array($status, array(PENGAJUAN_TERIMA, PENGAJUAN_PROSES))) {
                $this->db->where("status = " . PENGAJUAN_TERIMA . " OR status = " . PENGAJUAN_PROSES);
            } else {
                $this->db->where("status", $status);
            }
        }
    }
    // FILTER AREA

    public function all_data()
    {
        $result = $this->db->get_where("t_pengajuan", array(
            "is_deleted" => false,
        ));

        $result = $result->result_array();
        return $result;
    }

    public function count_all_ajax($all, $perm, $tipe, $status, $report = false)
    {
        if ($report) {
            $this->report($all, $perm, $tipe, $status);
        } else {
            $this->filter($all);
        }

        $this->db->where("is_deleted", false);
        return $this->db->count_all('v_pengajuan');
    }

    public function filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $all, $perm, $tipe, $status, $report = false)
    {
        if ($report) {
            $this->report($all, $perm, $tipe, $status);
        } else {
            $this->filter($all);
        }

        $this->db->where("(judul LIKE '%$search%'", NULL);
        $this->db->where("nama LIKE '%$search%'", NULL);
        $this->db->where("jabatan LIKE '%$search%'", NULL);
        $this->db->where("user_full_name LIKE '%$search%')", NULL);

        $this->db->where("is_deleted", false);
        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);
        $result = $this->db->get('v_pengajuan')->result_array();

        foreach ($result as $key => $val) {
            $jumlah_penyusunan = $this->db->query("SELECT COUNT(id) AS jumlah_penyusunan FROM t_penyusunan WHERE id_pengajuan = " . $val["id"])->row_array()["jumlah_penyusunan"];
            $result[$key]["jumlah_prokum_before"] = $val["jumlah_prokum"];
            $result[$key]["jumlah_prokum"] = $val["jumlah_prokum"] - (int) $jumlah_penyusunan;
        }

        // $this->print_out_data($result);
        return $result;
    }

    public function count_filter_ajax($search, $all, $perm, $tipe, $status, $report = false)
    {
        if ($report) {
            $this->report($all, $perm, $tipe, $status);
        } else {
            $this->filter($all);
        }

        $this->db->where("(judul LIKE '%$search%'", NULL);
        $this->db->where("nama LIKE '%$search%'", NULL);
        $this->db->where("jabatan LIKE '%$search%'", NULL);
        $this->db->where("user_full_name LIKE '%$search%')", NULL);

        $this->db->where("is_deleted", false);
        return $this->db->get('v_pengajuan')->num_rows();
    }

    public function save($data, $test = false)
    {
        if ($test)
            $this->print_out_data($data);

        $save = $this->initiate_save($data, SYSTEM_ADD);
        $result = $this->db->insert("t_pengajuan", $save);

        return $result;
    }

    public function update($data, $resend = false)
    {
        if ($resend) {
            $save = $this->initiate_save($data, SYSTEM_UPDATE, array(
                "status" => PENGAJUAN_MASUK,
            ));
        } else {
            $save = $this->initiate_save($data, SYSTEM_UPDATE);
        }

        // $this->print_out_data($save);

        $this->db->where("id", $data["id"]);
        $result = $this->db->update("t_pengajuan", $save);

        return $result;
    }

    public function delete($pengajuan)
    {
        $save = $this->initiate_save(NULL, SYSTEM_DELETE);

        $this->db->where("id", $pengajuan);
        $result = $this->db->update("t_pengajuan", $save);

        return $result;
    }

    public function pengajuan_byid($pengajuan)
    {
        $result = $this->db->get_where("v_pengajuan", array(
            "id" => $pengajuan,
        ))->row_array();

        $jumlah_penyusunan = $this->db->query("SELECT COUNT(id) AS jumlah_penyusunan FROM t_penyusunan WHERE id_pengajuan = $pengajuan")->row_array()["jumlah_penyusunan"];
        $result["jumlah_prokum"] = $result["jumlah_prokum"] - (int) $jumlah_penyusunan;

        return $result;
    }

    public function assign($pengajuan)
    {
        $this->db->where("id", $pengajuan);
        $result = $this->db->update("t_pengajuan", array(
            "status" => 4,
            "modified_by" => $this->user,

            "modified_date" => date("Y-m-d H:i:s"),
            "assign_date" => date("Y-m-d H:i:s"),
        ));

        return $result;
    }

    public function get_user_opd()
    {
        $this->db->where("group_id", PERM_SKPD);
        $result = $this->db->get("v_user_group")->result_array();

        return $result;
    }
}
