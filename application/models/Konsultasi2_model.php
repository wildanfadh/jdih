<?php

class Konsultasi2_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function count_all_ajax($to, $deleted, $draft, $read)
    {
        if ($to == "all") {
            $where = "(
                id_to = " . $this->session->userdata("user_id") . " OR
                id_from = " . $this->session->userdata("user_id") . "
            )";

            $this->db->where($where, NULL);
        } elseif ($to == 1) {
            $this->db->where("id_to", $this->session->userdata("user_id"));
        } elseif ($to == 2) {
            $this->db->where("id_from", $this->session->userdata("user_id"));
        }

        if ($deleted != "all") {
            if ($deleted == 1) {
                $deleted = true;
            } elseif ($deleted == 2) {
                $deleted = false;
            }

            $this->db->where("is_deleted", $deleted);
        }

        if ($draft != "all") {
            if ($draft == 1) {
                $draft = true;
            } elseif ($draft == 2) {
                $draft = false;
            }

            $this->db->where("is_draft", $draft);
        }

        if ($read != "all") {
            if ($read == 1) {
                $read = true;
            } elseif ($read == 2) {
                $read = false;
            }

            $this->db->where("is_read", $read);
        }

        return $this->db->count_all('t_konsultasi');
    }

    public function filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $to, $deleted, $draft, $read)
    {
        if ($to == "all") {
            $where = "(
                id_to = " . $this->session->userdata("user_id") . " OR
                id_from = " . $this->session->userdata("user_id") . "
            )";

            $this->db->where($where, NULL);
        } elseif ($to == 1) {
            $this->db->where("id_to", $this->session->userdata("user_id"));
        } elseif ($to == 2) {
            $this->db->where("id_from", $this->session->userdata("user_id"));
        } else {
            $usr_ = $this->session->userdata("user_id");

            if ($usr_ == 5) {
                $this->db->where("id_to", 4);
            }
        }

        if ($deleted != "all") {
            if ($deleted == 1) {
                $deleted = true;
            } elseif ($deleted == 2) {
                $deleted = false;
            }

            $this->db->where("is_deleted", $deleted);
        }

        if ($draft != "all") {
            if ($draft == 1) {
                $draft = true;
            } elseif ($draft == 2) {
                $draft = false;
            }

            $this->db->where("is_draft", $draft);
        }

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

        return $this->db->get('t_konsultasi')->result_array();
    }

    public function count_filter_ajax($search, $to, $deleted, $draft, $read)
    {
        if ($to == "all") {
            $where = "(
                id_to = " . $this->session->userdata("user_id") . " OR
                id_from = " . $this->session->userdata("user_id") . "
            )";

            $this->db->where($where, NULL);
        } elseif ($to == 1) {
            $this->db->where("id_to", $this->session->userdata("user_id"));
        } elseif ($to == 2) {
            $this->db->where("id_from", $this->session->userdata("user_id"));
        }


        if ($deleted != "all") {
            if ($deleted == 1) {
                $deleted = true;
            } elseif ($deleted == 2) {
                $deleted = false;
            }

            $this->db->where("is_deleted", $deleted);
        }

        if ($draft != "all") {
            if ($draft == 1) {
                $draft = true;
            } elseif ($draft == 2) {
                $draft = false;
            }

            $this->db->where("is_draft", $draft);
        }

        if ($read != "all") {
            if ($read == 1) {
                $read = true;
            } elseif ($read == 2) {
                $read = false;
            }

            $this->db->where("is_read", $read);
        }

        $this->db->where("subject LIKE '%$search%'", NULL);
        return $this->db->get('t_konsultasi')->num_rows();
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

        $result = $this->db->get("t_konsultasi");
        return $result->result_array();
    }

    function get_userbygroup()
    {
        $result = array();
        $group = $this->session->userdata("group");

        if ($group == PERM_ADM || $group == PERM_JDIH_KB || $group == PERM_JDIH_PE || $group == PERM_JDIH_SK) {
            $where = "group_id != " . PERM_ADM . " AND group_id != " . PERM_JDIH_KB . " AND group_id != " . PERM_JDIH_PE . " AND group_id != " . PERM_JDIH_SK;
            $this->db->where($where, NULL);
            $result = $this->db->get("v_user_group");
        } else {
            $this->db->where("group_id", PERM_ADM);
            $this->db->or_where("group_id", PERM_JDIH_KB);
            $this->db->or_where("group_id", PERM_JDIH_PE);
            $this->db->or_where("group_id", PERM_JDIH_SK);
            $result = $this->db->get("v_user_group");
        }

        return $result->result_array();
    }

    function save($data)
    {
        $result = $this->db->insert("t_konsultasi", $data);

        return $result;
    }

    function get_byid($konsultasi)
    {
        $result = $this->db->get_where("t_konsultasi", array(
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

    function delete($konsultasi)
    {
        $this->db->where("id", $konsultasi);
        $result = $this->db->update("t_konsultasi", array(
            "is_deleted" => true,
        ));

        return $result;
    }

    function read($konsultasi)
    {
        $kon_data = $this->db->get_where("t_konsultasi", array(
            "id" => $konsultasi,
        ))->row_array();

        $result = true;
        if ($kon_data["id_from"] != $this->session->userdata("user_id")) {
            $this->db->where("id", $konsultasi);
            $result = $this->db->update("t_konsultasi", array(
                "is_read" => true,
            ));
        }

        return $result;
    }

    function draft_to_send($konsultasi, $data)
    {
        $this->db->where("id", $konsultasi);
        $result = $this->db->update("t_konsultasi", $data);

        return $result;
    }

    function get_permite_sent()
    {
        $query = $this->db->get_where("t_konsultasi", array(
            "id_to" => 4,
        ))->row_array();
        return $query;
    }
}
