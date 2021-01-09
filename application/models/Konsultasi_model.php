<?php

class Konsultasi_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function get_message_byuser($to, $deleted, $draft, $read)
    {
        if ($to) {
            $this->db->where("id_to", $this->session->userdata("user_id"));
        } else {
            $this->db->where("id_from", $this->session->userdata("user_id"));
        }

        if ($deleted != "all") {
            $this->db->where("is_deleted", $deleted);
        }

        if ($draft != "all") {
            $this->db->where("is_draft", $draft);
        }

        if ($read != "all") {
            $this->db->where("is_read", $read);
        }

        $result = $this->db->get("m_konsultasi");
        return $result->result_array();
    }

    function get_user()
    {
        $result = array();
        // $group = $this->session->userdata("group");
        $result = $this->db->get("v_user_group");
        return $result->result_array();
    }

    function get_byid($konsultasi)
    {
        $result = $this->db->get_where("m_konsultasi", array(
            "id" => $konsultasi,
        ));

        return $result->row_array();
    }

    function get_userdetail($user)
    {
        $result = $this->db->get_where("v_user_group", array(
            "user_id" => $user,
        ));

        return $result->row_array();
    }

    function deleteKonsul($konsultasi)
    {
        $this->db->where("id", $konsultasi);
        $result = $this->db->delete("m_konsultasi");
        // $result = $this->db->update("m_konsultasi", array(
        //     "is_deleted" => true,
        // ));

        return $result;
    }

    function save($data)
    {
        $result = $this->db->insert("m_konsultasi", $data);

        return $result;
    }

    function read($konsultasi)
    {
        $kon_data = $this->db->get_where("m_konsultasi", array(
            "id" => $konsultasi,
        ))->row_array();

        $result = true;
        if ($kon_data["id_from"] != $this->session->userdata("user_id")) {
            $this->db->where("id", $konsultasi);
            $result = $this->db->update("m_konsultasi", array(
                "is_read" => true,
            ));
        }

        return $result;
    }

    // function draft_to_send($konsultasi, $data)
    // {
    //     $this->db->where("id", $konsultasi);
    //     $result = $this->db->update("m_konsultasi", $data);

    //     return $result;
    // }

    // function update_draft($konsultasi, $data)
    // {
    //     $this->db->where("id", $konsultasi);
    //     $result = $this->db->update("m_konsultasi", $data);

    //     return $result;
    // }

    // function get_permite_sent()
    // {
    //     $query = $this->db->get_where("m_konsultasi", array(
    //         "id_to" => 4,
    //     ))->row_array();
    //     return $query;
    // }



    // Model Chat function

    function getChat_group($data)
    {
        $result = $this->db->get_where("m_konsultasi", array("id_to_group" => $data));

        return $result->row_array();
    }

    function getKonsul($usr)
    {
        $result = $this->db->get_where("m_konsultasi", array("id_to_group" => $usr));

        return $result->row_array();
    }

    function getChat_forStatus($data)
    {
        $result = $this->db->get_where('t_konsultasi', array("id_konsultasi" => $data));
        return $result->result_array();
    }

    public function count_allChat_ajax($to, $deleted, $draft, $read)
    {
        $done = array('has_send' => SUDAH_DIBALAS, 'status' => KONFIRMASI_SELESAI);

        if ($to == "all") {
            $_usr = $this->session->userdata("user_id");

            if ($_usr == 4) {
                $where = "(
                    id_from = " . $this->session->userdata("user_id") . "
                )";
            } else {
                $where = "(
                    id_from = 4
                )";
            }

            $this->db->where($where, NULL);
        } elseif ($to == PERM_KABAG) {
            $this->db->where("id_to_group", PERM_KABAG);
        } elseif ($to == PERM_PERUNDANGAN) {
            $this->db->where("id_to_group", PERM_PERUNDANGAN);
        } elseif ($to == PERM_DOKUM) {
            $this->db->where("id_to_group", PERM_DOKUM);
        } elseif ($to == PERM_BANKUM) {
            $this->db->where("id_to_group", PERM_BANKUM);
        } elseif ($to == "done") {
            $this->db->where('status', STATUS_DIKONFIRMASI);
        } elseif ($to == "rejected") {
            $this->db->where('status', STATUS_DIBATALKAN);
        } elseif ($to == "pending") {
            $this->db->where('has_send', null);
            // } elseif ($to == "confir") {
            //     $this->db->where('status >', KONFIRMASI_SELESAI);
        } elseif ($to == "confir") {
            $this->db->where('status', STATUS_MASUK);
        } elseif ($to == "proses-foropd") {
            $this->db->where('is_confirmed', BELUM_KONFIRMASI);
        } else {
            $usr_ = $this->session->userdata("user_id");

            if ($usr_ == 5) {
                $this->db->where("id_to", 4);
            }
        }

        // if ($deleted != "all") {
        //     if ($deleted == 1) {
        //         $deleted = true;
        //     } elseif ($deleted == 2) {
        //         $deleted = false;
        //     }

        //     $this->db->where("is_deleted", $deleted);
        // }

        if ($read != "all") {
            if ($read == 1) {
                $read = true;
            } elseif ($read == 2) {
                $read = false;
            }

            $this->db->where("is_read", $read);
        }

        return $this->db->count_all('m_konsultasi');
    }

    public function filterChat_ajax($search, $limit, $start, $order_field, $order_ascdesc, $to, $deleted, $draft, $read)
    {

        $done = array('has_send' => SUDAH_DIBALAS, 'status' => KONFIRMASI_SELESAI);

        if ($to == "all") {
            $_usr = $this->session->userdata("user_id");

            if ($_usr == 4) {
                $where = "(
                    id_from = " . $this->session->userdata("user_id") . "
                )";
            } else {
                $where = "(
                    id_from = 4
                )";
            }

            $this->db->where($where, NULL);
        } elseif ($to == PERM_KABAG) {
            $this->db->where("id_to_group", PERM_KABAG);
        } elseif ($to == PERM_PERUNDANGAN) {
            $this->db->where("id_to_group", PERM_PERUNDANGAN);
        } elseif ($to == PERM_DOKUM) {
            $this->db->where("id_to_group", PERM_DOKUM);
        } elseif ($to == PERM_BANKUM) {
            $this->db->where("id_to_group", PERM_BANKUM);
        } elseif ($to == "done") {
            $this->db->where('status', STATUS_DIKONFIRMASI);
        } elseif ($to == "rejected") {
            $this->db->where('status', STATUS_DIBATALKAN);
        } elseif ($to == "pending") {
            $this->db->where('has_send', null);
            // } elseif ($to == "confir") {
            //     $this->db->where('status >', KONFIRMASI_SELESAI);
        } elseif ($to == "confir") {
            $this->db->where('status', STATUS_MASUK);
        } elseif ($to == "proses-foropd") {
            $this->db->where('is_confirmed', BELUM_KONFIRMASI);
        } else {
            $usr_ = $this->session->userdata("user_id");

            if ($usr_ == 5) {
                $this->db->where("id_to", 4);
            }
        }

        // if ($deleted != "all") {
        //     if ($deleted == 1) {
        //         $deleted = true;
        //     } elseif ($deleted == 2) {
        //         $deleted = false;
        //     }

        //     $this->db->where("is_deleted", $deleted);
        // }

        if ($read != "all") {
            if ($read == 1) {
                $read = true;
            } elseif ($read == 2) {
                $read = false;
            }

            $this->db->where("is_read", $read);
        }

        $this->db->where("subject LIKE '%$search%'", NULL);

        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);

        return $this->db->get('m_konsultasi')->result_array();
    }

    public function count_filterChat_ajax($search, $to, $deleted, $draft, $read)
    {
        $done = array('has_send' => SUDAH_DIBALAS, 'status' => KONFIRMASI_SELESAI);

        if ($to == "all") {
            $_usr = $this->session->userdata("user_id");

            if ($_usr == 4) {
                $where = "(
                    id_from = " . $this->session->userdata("user_id") . "
                )";
            } else {
                $where = "(
                    id_from = 4
                )";
            }

            $this->db->where($where, NULL);
        } elseif ($to == PERM_KABAG) {
            $this->db->where("id_to_group", PERM_KABAG);
        } elseif ($to == PERM_PERUNDANGAN) {
            $this->db->where("id_to_group", PERM_PERUNDANGAN);
        } elseif ($to == PERM_DOKUM) {
            $this->db->where("id_to_group", PERM_DOKUM);
        } elseif ($to == PERM_BANKUM) {
            $this->db->where("id_to_group", PERM_BANKUM);
        } elseif ($to == "done") {
            $this->db->where('status', STATUS_DIKONFIRMASI);
        } elseif ($to == "rejected") {
            $this->db->where('status', STATUS_DIBATALKAN);
        } elseif ($to == "pending") {
            $this->db->where('has_send', null);
            // } elseif ($to == "confir") {
            //     $this->db->where('status >', KONFIRMASI_SELESAI);
        } elseif ($to == "confir") {
            $this->db->where('status', STATUS_MASUK);
        } elseif ($to == "proses-foropd") {
            $this->db->where('is_confirmed', BELUM_KONFIRMASI);
        } else {
            $usr_ = $this->session->userdata("user_id");

            if ($usr_ == 5) {
                $this->db->where("id_to", 4);
            }
        }

        // if ($deleted != "all") {
        //     if ($deleted == 1) {
        //         $deleted = true;
        //     } elseif ($deleted == 2) {
        //         $deleted = false;
        //     }

        //     $this->db->where("is_deleted", $deleted);
        // }

        if ($read != "all") {
            if ($read == 1) {
                $read = true;
            } elseif ($read == 2) {
                $read = false;
            }

            $this->db->where("is_read", $read);
        }

        $this->db->where("subject LIKE '%$search%'", NULL);
        return $this->db->get('m_konsultasi')->num_rows();
    }

    function saveChat($data)
    {
        $result = $this->db->insert("t_konsultasi", $data);

        return $result;
    }

    function getChat($konsultasi)
    {

        $result = $this->db->get_where("t_konsultasi", array("id_konsultasi" => $konsultasi));

        return $result->result_array();
    }

    function getChatid($konsultasi)
    {

        $result = $this->db->get_where("t_konsultasi", array("id_konsultasi" => $konsultasi));

        return $result->row_array();
    }

    function UpdateChat($chat, $data)
    {
        $this->db->where("id", $chat);
        $result = $this->db->update("t_konsultasi", $data);
        return $result;
    }

    function update_konsul($konsultasi, $data, $chat = null, $data_chat = null)
    {
        // $this->print_out_data($konsultasi);

        $this->db->where("id", $konsultasi);
        $result = $this->db->update("m_konsultasi", $data);

        if ($result && !empty($chat) && !empty($data_chat)) {
            return $this->confir_to_send($chat, $data_chat);
        } elseif ($result && !empty($chat)) {
            return $this->saveChat($chat);
        } else {
            return $result;
        }
    }

    function confir_to_send($chat, $data)
    {
        $this->db->where("id", $chat);
        $result = $this->db->update("t_konsultasi", $data);

        return $result;
    }

    function deleteChat($konsultasi)
    {
        $this->db->where("id", $konsultasi);
        $result = $this->db->update("m_konsultasi", array(
            "is_deleted" => true,
        ));

        return $result;
    }
}
