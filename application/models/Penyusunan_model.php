<?php

class Penyusunan_model extends CI_Model
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

    private function filter($pengajuan, $all, $status, $paraf)
    {
        if (in_array($this->group, array(PERM_PERUNDANGAN, PERM_DOKUM, PERM_BANKUM))) {
            if ($status == PENYUSUNAN_PROSES) {
                $this->db->where("status = " . PENYUSUNAN_PROSES . " AND is_kabag = true", NULL);
            } else {
                $this->db->where("(is_ready = false AND (status = " . PENYUSUNAN_DRAFT . " OR status = " . PENYUSUNAN_SIAP . " OR status = " . PENYUSUNAN_KEMBALI . " OR (status = " . PENYUSUNAN_PROSES . " AND is_kabag = true)))", NULL);
            }
        } elseif ($this->group == PERM_KABAG) {
            $this->db->where("status", PENYUSUNAN_PROSES);
            $this->db->where("is_kabag", false);
        } elseif ($this->group == PERM_ASISTEN) {
            $this->db->where("status", PENYUSUNAN_PROSES);
            $this->db->where("is_kabag", true);
            $this->db->where("is_asisten", false);
        } elseif ($this->group == PERM_SEKDA) {
            $this->db->where("status", PENYUSUNAN_PROSES);
            $this->db->where("is_kabag", true);
            $this->db->where("is_walikota", false);
        } elseif ($this->group == PERM_WALIKOTA) {
            $this->db->where("status", PENYUSUNAN_PROSES);
            $this->db->where("is_kabag", true);
        }

        if (in_array($this->group, array(PERM_KABAG, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) {
            $this->db->where("is_ready", false);
        }

        if ($pengajuan != "a") {
            $this->db->where("pengajuan_id", $pengajuan);
        }

        if ($all > 0) {
            $this->db->where("pengajuan_created_by", $all);
        }

        if ($status != "a") {
            $this->db->where("status", $status);
        }
    }

    private function report($pengajuan, $all, $status, $paraf)
    {
        if ($all != 0) {
            $this->db->where("pengajuan_created_by", $all);
        }

        if ($pengajuan != "a") {
            $this->db->where("pengajuan_id", $pengajuan);
        }

        if ($status != "a") {
            if ($status != PENYUSUNAN_SIAP) {
                $this->db->where("status", $status);
            } else {
                $this->db->where("status = " . PENYUSUNAN_SIAP . " AND is_ready", NULL);
            }
        }
    }

    public function count_all_ajax($pengajuan, $all, $status, $paraf)
    {
        $this->filter($pengajuan, $all, $status, $paraf);

        $this->db->where("is_deleted", false);
        $this->db->where("pengajuan_deleted", false);
        return $this->db->count_all('v_penyusunan');
    }

    public function filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $pengajuan, $all, $status, $paraf, $report = false)
    {
        if ($report) {
            $this->report($pengajuan, $all, $status, $paraf);
        } else {
            $this->filter($pengajuan, $all, $status, $paraf);
        }

        $this->db->where("(nomor_urut LIKE '%$search%'", NULL);
        $this->db->where("judul LIKE '%$search%'", NULL);
        $this->db->where("keterangan LIKE '%$search%')", NULL);

        $this->db->where("is_deleted", false);
        $this->db->where("pengajuan_deleted", false);

        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);
        $result = $this->db->get('v_penyusunan')->result_array();

        $last = $this->db->last_query();
        // $this->print_out_data($last);

        return $result;
    }

    public function count_filter_ajax($search, $pengajuan, $all, $status, $paraf)
    {
        $this->filter($pengajuan, $all, $status, $paraf);

        $this->db->where("(nomor_urut LIKE '%$search%'", NULL);
        $this->db->where("judul LIKE '%$search%'", NULL);
        $this->db->where("keterangan LIKE '%$search%')", NULL);

        $this->db->where("is_deleted", false);
        $this->db->where("pengajuan_deleted", false);
        return $this->db->get('v_penyusunan')->num_rows();
    }

    public function get_byid($penyusunan)
    {
        $result = $this->db->get_where("v_penyusunan", array(
            "id" => $penyusunan,
        ))->row_array();

        return $result;
    }

    private function result_counter($counter)
    {
        $counter = str_pad($counter, 4, "0", STR_PAD_LEFT);
        $counter_m = "";
        switch (date("m")) {
            case 1:
                $counter_m = "I";
                break;
            case 2:
                $counter_m = "II";
                break;
            case 3:
                $counter_m = "III";
                break;
            case 4:
                $counter_m = "IV";
                break;
            case 5:
                $counter_m = "V";
                break;
            case 6:
                $counter_m = "VI";
                break;
            case 7:
                $counter_m = "VII";
                break;
            case 8:
                $counter_m = "VIII";
                break;
            case 9:
                $counter_m = "IX";
                break;
            case 10:
                $counter_m = "X";
                break;
            case 11:
                $counter_m = "XI";
                break;
            case 12:
                $counter_m = "XII";
                break;
        }

        $year = date("Y");
        $counter = "$year/$counter_m/$counter";

        return $counter;
    }

    public function get_counter($counter)
    {
        return $this->db->get_where("t_counter", array(
            "tahun" => date("Y"),
            "name" => $counter,
        ))->row_array();
    }

    public function update_counter($counter, $value)
    {
        $this->db->where("name", $counter);
        $result = $this->db->update("t_counter", array(
            "counter" => $value,
        ));

        return $result;
    }

    public function save_penyusunan($pengajuan, $data)
    {
        $this->db->trans_begin();
        $counter = (int) $this->get_counter("pengajuan")["counter"];

        $created_date = date("Y-m-d H:i:s");
        $created_by = $this->user;

        $value = "";
        foreach ($data["judul"] as $key => $val) {
            $result_counter = $this->result_counter($counter);

            $value .= "($pengajuan, '$result_counter', '" . $val . "', " . $data["status"][$key] . ", '" . $data["keterangan"][$key] . "', '" . $data["file_keterangan"][$key] . "', " . PENYUSUNAN_DRAFT . ", $created_by, '$created_date'), ";

            $counter++;
        }

        $value = rtrim($value, ", ");

        $save = "INSERT INTO t_penyusunan (id_pengajuan, nomor_urut, judul, status, keterangan, file_keterangan, is_deleted, created_by, created_date) VALUES ";
        $save .= $value;

        // $this->print_out_data($save);

        $this->db->query($save);
        $this->update_counter("pengajuan", $counter);

        $this->db->where("id", $pengajuan);
        $this->db->update("t_pengajuan", array(
            "status" => PENGAJUAN_PROSES,
        ));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {
            $this->db->trans_commit();

            return true;
        }
    }

    public function update_penyusunan($data)
    {
        $save = array(
            "judul" => $data["judul"],
            "status" => $data["status"],
            "keterangan" => $data["keterangan"],
            "file_keterangan" => $data["file_keterangan"],

            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->user,
        );

        $this->db->where("id", $data["id"]);
        $result = $this->db->update("t_penyusunan", $save);

        return $result;
    }

    public function delete_penyusunan($id)
    {
        $save = array(
            "is_deleted" => true,
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->user,
        );

        $this->db->where("id", $id);
        $result = $this->db->update("t_penyusunan", $save);

        return $result;
    }

    private function get_user_byid($user)
    {
        $result = $this->db->get_where("v_user_group", array(
            "user_id" => $user,
        ))->row_array();

        return $result;
    }

    public function timeline($penyusunan)
    {
        $this->db->trans_begin();
        $result = array();

        $penyusunan = $this->db->get_where("t_penyusunan", array(
            "id" => $penyusunan,
        ))->row_array();

        $pengajuan = $this->db->get_where("v_pengajuan", array(
            "id" => $penyusunan["id_pengajuan"],
        ))->row_array();
        $pengajuan["modified_by"] = $this->get_user_byid($pengajuan["modified_by"])["group_description"];

        $penyusunan_list = $this->db->get_where("t_penyusunan", array(
            "id_pengajuan" => $pengajuan["id"],
        ))->result_array();

        $result = array(
            "penyusunan" => $penyusunan,
            "penyusunan_list" => $penyusunan_list,
            "pengajuan" => $pengajuan,
        );

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $result = array();
            return $result;
        } else {
            $this->db->trans_commit();

            return $result;
        }
    }

    public function paraf_penyusunan($penyusunan)
    {
        $penyusunan_select = $this->db->get_where("t_penyusunan", array(
            "id" => $penyusunan["penyusunan"],
        ))->row_array();

        $update = array(
            // "is_ready" => ($penyusunan["ready"] == 1) ? true : false,

            "modified_by" => $this->user,
            "modified_date" => date("Y-m-d H:i:s"),
        );

        // $this->print_out_data($penyusunan);

        if (!empty($penyusunan["paraf"])) {
            if ($penyusunan["paraf"] == PERM_KABAG) {
                $update["is_kabag"] = true;
                $update["kabag_date"] = date("Y-m-d H:i:s");
            } elseif ($penyusunan["paraf"] == PERM_ASISTEN) {
                $update["is_asisten"] = true;
                $update["asisten_date"] = date("Y-m-d H:i:s");
            } elseif ($penyusunan["paraf"] == PERM_SEKDA) {
                // Jika diparaf oleh Walikota, maka Asisten ikut terparaf
                $update["is_asisten"] = true;
                if (empty($penyusunan_select["asisten_date"])) {
                    $update["asisten_date"] = date("Y-m-d H:i:s");
                }

                $update["is_sekda"] = true;
                $update["sekda_date"] = date("Y-m-d H:i:s");
            } elseif ($penyusunan["paraf"] == PERM_WALIKOTA) {
                // Jika diparaf oleh Walikota, maka Asisten dan Sekda ikut terparaf
                $update["is_asisten"] = true;
                if (empty($penyusunan_select["asisten_date"])) {
                    $update["asisten_date"] = date("Y-m-d H:i:s");
                }

                $update["is_sekda"] = true;
                if (empty($penyusunan_select["sekda_date"])) {
                    $update["sekda_date"] = date("Y-m-d H:i:s");
                }

                $update["is_walikota"] = true;
                $update["walikota_date"] = date("Y-m-d H:i:s");
            }
        }

        if ($penyusunan["ttd"] == 1) {
            $update["status"] = PENYUSUNAN_SIAP;
        }

        $this->db->where("id", $penyusunan["penyusunan"]);
        $result = $this->db->update("t_penyusunan", $update);

        return $result;
    }

    public function nomor_prokum($penyusunan)
    {
        $update = array(
            "nomor_prokum" => $penyusunan["produk_hukum"],
            "file_prokum" => $penyusunan["file_produk"],
            // "is_ready" => true,

            "modified_by" => $this->user,
            "modified_date" => date("Y-m-d H:i:s"),
        );

        $this->db->where("id", $penyusunan["penyusunan"]);
        $result = $this->db->update("t_penyusunan", $update);

        return $result;
    }

    public function ready_prokum($penyusunan)
    {
        $update = array(
            "is_ready" => true,

            "modified_by" => $this->user,
            "modified_date" => date("Y-m-d H:i:s"),
        );

        $this->db->where("id", $penyusunan);
        $result = $this->db->update("t_penyusunan", $update);

        return $result;
    }

    public function pengajuan_paraf($penyusunan)
    {
        $this->db->where("id", $penyusunan);
        $result = $this->db->update("t_penyusunan", array(
            "status" => PENYUSUNAN_PROSES,
        ));

        return $result;
    }

    // private function report($pengajuan, $all, $status, $paraf)
    // {
    //     // if ($status == "a") {
    //     // } elseif ($status == PENYUSUNAN_PROSES) {
    //     //     // diproses
    //     //     $this->db->where("status", PENYUSUNAN_PROSES);
    //     //     $this->db->where("nomor_prokum", NULL);

    //     //     $where = "status = " . PENYUSUNAN_PROSES;
    //     //     $where .= " AND nomor_prokum IS NULL";

    //     //     $this->db->where($where, NULL);
    //     // } elseif ($status == PENYUSUNAN_KEMBALI) {
    //     //     // dikembalikan
    //     //     $this->db->where("status", PENYUSUNAN_KEMBALI);
    //     // } elseif ($status == PENYUSUNAN_SIAP) {
    //     //     // siap diambil
    //     //     $this->db->where("is_ready", true);
    //     //     $this->db->where("nomor_prokum !=", "");
    //     // }

    //     // if ($this->group == PERM_ASISTEN or $this->group == PERM_SEKDA or $this->group == PERM_WALIKOTA) {
    //     //     $this->db->where("(status = " . PENYUSUNAN_PROSES . " or status = " . PENYUSUNAN_SIAP . ")", NULL);

    //     //     if ($this->group == PERM_ASISTEN) {
    //     //         $this->db->where("is_kabag", true);
    //     //     } elseif ($this->group == PERM_SEKDA) {
    //     //         $this->db->where("is_kabag", true);
    //     //         $this->db->where("is_asisten", true);
    //     //     } elseif ($this->group == PERM_WALIKOTA) {
    //     //         $this->db->where("is_kabag", true);
    //     //         $this->db->where("is_asisten", true);
    //     //     }
    //     // }

    //     // if ($paraf == 1) {
    //     //     if ($this->group == PERM_KABAG) {
    //     //         $this->db->where("is_kabag", false);
    //     //         $this->db->where("is_asisten", false);
    //     //         $this->db->where("is_sekda", false);
    //     //         $this->db->where("is_walikota", false);
    //     //     } elseif ($this->group == PERM_ASISTEN) {
    //     //         $this->db->where("is_kabag", true);
    //     //         $this->db->where("is_asisten", false);
    //     //         $this->db->where("is_sekda", false);
    //     //         $this->db->where("is_walikota", false);
    //     //     } elseif ($this->group == PERM_SEKDA) {
    //     //         $this->db->where("is_kabag", true);
    //     //         $this->db->where("is_asisten", true);
    //     //         $this->db->where("is_sekda", false);
    //     //         $this->db->where("is_walikota", false);
    //     //     } elseif ($this->group == PERM_WALIKOTA) {
    //     //         $this->db->where("is_kabag", true);
    //     //         $this->db->where("is_asisten", true);
    //     //         $this->db->where("is_walikota", false);

    //     //         $this->db->where("is_ready", false);
    //     //     }

    //     //     $this->db->where("status !=", PENYUSUNAN_KEMBALI);
    //     // } elseif ($paraf == 2) {
    //     //     if ($this->group == PERM_KABAG) {
    //     //         $this->db->where("is_kabag", true);
    //     //     } elseif ($this->group == PERM_ASISTEN) {
    //     //         $this->db->where("is_asisten", true);
    //     //     } elseif ($this->group == PERM_SEKDA) {
    //     //         $this->db->where("is_sekda", true);
    //     //     } elseif ($this->group == PERM_WALIKOTA) {
    //     //         $this->db->where("is_walikota", true);
    //     //     }

    //     //     $this->db->where("status !=", PENYUSUNAN_KEMBALI);
    //     //     // $this->db->where("is_ready", true);
    //     //     // $this->db->where("nomor_prokum !=", "");
    //     // }

    //     if ($all != 0) {
    //         $this->db->where("pengajuan_created_by", $all);
    //     }

    //     if ($pengajuan != "a") {
    //         $this->db->where("pengajuan_id", $pengajuan);
    //     }
    // }
}
