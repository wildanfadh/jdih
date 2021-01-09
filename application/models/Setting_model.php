<?php

class Setting_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function all_jenis()
    {
        $result = $this->db->get_where("m_jenis_prokum", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function save_jenis($data)
    {
        $result = $this->db->insert("m_jenis_prokum", $data);

        return $result;
    }

    function get_jenis_byid($id)
    {
        $result = $this->db->get("m_jenis_prokum", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function update_jenis($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_jenis_prokum", $data);

        return $result;
    }

    function delete_jenis($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_jenis_prokum", array(
            "is_deleted" => true,
        ));

        return $result;
    }

    function get_jenis_bytipe($tipe)
    {
        $result = $this->db->get_where("m_jenis_prokum", array(
            "tipe" => $tipe,
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    // KABINET
    function save_kabinet($data)
    {
        $result = $this->db->insert("m_kabinet", $data);

        return $result;
    }

    function all_kabinet()
    {
        $result = $this->db->get_where("m_kabinet", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function get_kabinet_byid($id)
    {
        $result = $this->db->get("m_kabinet", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function update_kabinet($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_kabinet", $data);

        return $result;
    }

    function delete_kabinet($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_kabinet", array(
            "is_deleted" => true,
        ));

        return $result;
    }

    // PROFIL
    function save_profil($data, $visi, $misi)
    {
        if ($data["is_active"]) {
            $this->db->update("m_profil", array(
                "is_active" => false,
                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->session->userdata("user_id"),
            ));
        }

        $result = $this->db->insert("m_profil", $data);
        $insert_id = $this->db->insert_id();

        foreach ($visi as $vis) {
            $this->db->insert("t_visi", array(
                "id_profil" => $insert_id,
                "visi" => $vis,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            ));
        }

        foreach ($misi as $mis) {
            $this->db->insert("t_misi", array(
                "id_profil" => $insert_id,
                "misi" => $mis,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            ));
        }

        return $result;
    }

    function all_profile()
    {
        $result = $this->db->get_where("m_profil", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function get_profile_byid($id)
    {
        $result = $this->db->get_where("m_profil", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function get_visi_byprofil($profil)
    {
        $result = $this->db->get_where("t_visi", array(
            "id_profil" => $profil,
        ));

        return $result->result_array();
    }

    function get_misi_byprofil($profil)
    {
        $result = $this->db->get_where("t_misi", array(
            "id_profil" => $profil,
        ));

        return $result->result_array();
    }

    function update_profil($id, $data, $visi, $misi)
    {
        if ($data["is_active"]) {
            $this->db->update("m_profil", array(
                "is_active" => false,
                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->session->userdata("user_id"),
            ));
        }

        $this->db->where("id", $id);
        $result = $this->db->update("m_profil", $data);

        $this->db->where("id_profil", $id);
        $this->db->delete("t_visi");

        $this->db->where("id_profil", $id);
        $this->db->delete("t_misi");

        foreach ($visi as $vis) {
            $this->db->insert("t_visi", array(
                "id_profil" => $id,
                "visi" => $vis,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            ));
        }

        foreach ($misi as $mis) {
            $this->db->insert("t_misi", array(
                "id_profil" => $id,
                "misi" => $mis,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            ));
        }

        return $result;
    }

    function delete_profil($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_profil", array(
            "is_deleted" => true,

            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("user_id"),
        ));

        return $result;
    }

    function get_active_profil()
    {
        $result = $this->db->get_where("m_profil", array(
            "is_active" => true,
            "is_deleted" => false,
        ));

        return $result->row_array();
    }

    // PERSONIL
    function get_personil_byprofile($profil)
    {
        $result = $this->db->get_where("t_personil", array(
            "id_profil" => $profil,
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function save_personil($data)
    {
        $result = $this->db->insert("t_personil", $data);
        return $result;
    }

    function get_personil_byid($id)
    {
        $result = $this->db->get_where("t_personil", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function update_personil($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("t_personil", $data);

        return $result;
    }

    function delete_personil($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("t_personil", array(
            "is_deleted" => true,

            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("user_id"),
        ));

        return $result;
    }

    function get_wakil($profil)
    {
        $result = $this->db->get_where("t_personil", array(
            "id_profil" => $profil,
            "posisi" => POS_WAKIL,
            "is_deleted" => false,
        ));

        return $result->row_array();
    }

    // AGENDA
    function save_agenda($data)
    {
        $result = $this->db->insert("m_agenda", $data);

        return $result;
    }

    function all_agenda($menu = false)
    {
        if ($menu) {
            $this->db->where("is_online", true);
        }

        $result = $this->db->get_where("m_agenda", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function get_agenda($id)
    {
        $result = $this->db->get_where("m_agenda", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function update_agenda($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_agenda", $data);

        return $result;
    }

    function delete_agenda($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_agenda", array(
            "is_deleted" => true,
        ));

        return $result;
    }

    function save_tupoksi($data)
    {
        $result = $this->db->insert("m_tupoksi", $data);

        return $result;
    }

    function all_tupoksi()
    {
        $result = $this->db->get_where("m_tupoksi", array(
            "is_deleted" => false,
        ));

        return $result->result_array();
    }

    function get_tupoksi_byid($id)
    {
        $result = $this->db->get_where("m_tupoksi", array(
            "id" => $id,
        ));

        return $result->row_array();
    }

    function update_tupoksi($id, $data)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_tupoksi", $data);

        return $result;
    }

    function delete_tupoksi($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->update("m_tupoksi", array(
            "is_deleted" => true,

            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("user_id"),
        ));

        return $result;
    }

    function get_tupoksi_active()
    {
        $result = $this->db->get_where("m_tupoksi", array(
            "is_active" => true,
        ));

        return $result->row_array();
    }

    function get_group_byuser()
    {
        $user_group = $this->db->get_where("users_groups", array(
            "user_id" => $this->session->userdata("user_id"),
        ))->row_array();

        $group = $this->db->get_where("groups", array(
            "id" => $user_group["group_id"],
        ))->row_array();

        $skpd = $this->db->get_where("m_skpd", array(
            "id_group" => $group["id"],
        ))->row_array();

        $user = $this->db->get_where("users", array(
            "id" => $this->session->userdata("user_id"),
        ))->row_array();


        $this->session->set_userdata("group", $user_group["group_id"]);
        $this->session->set_userdata("is_skpd", $group["is_skpd"]);
        $this->session->set_userdata("id_skpd", $skpd["id"]);
        $this->session->set_userdata("fullname", $user["full_name"]);
        $this->session->set_userdata("username", $user["username"]);
    }

    public function visitor($ip)
    {
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");

        $visitor = $this->db->get_where("visitor", array(
            "ip" => $ip,
            "date" => $date,
        ))->num_rows();

        $visitor = isset($visitor) ? ($visitor) : 0;
        if ($visitor == 0) {
            $this->db->insert("visitor", array(
                "ip" => $ip,
                "date" => $date,
                "hits" => 1,
                "online" => $waktu,
                "time" => $timeinsert,
            ));
        } else {
            $this->db->query("UPDATE visitor SET hits = hits + 1, online = '$waktu' WHERE ip = '$ip' AND date = '$date'");
        }

        $this->db->group_by("ip");
        $hari_ini  = $this->db->get_where("visitor", array(
            "date" => $date,
        ))->num_rows();

        // hitung total pengunjung
        $pengunjung = $this->db->query("SELECT COUNT(hits) AS hits FROM visitor")->row();
        $total = isset($pengunjung->hits) ? ($pengunjung->hits) : 0;

        // hitung pengunjung online
        $bataswaktu = time() - 300;
        $online  = $this->db->query("SELECT * FROM visitor WHERE online > '$bataswaktu'")->num_rows();

        return array(
            "hari_ini" => $hari_ini,
            "total" => $total,
            "online" => $online,
        );
    }

    // COUNTER
    public function counter($counter)
    {
        return $this->db->get_where("t_counter", array(
            "name" => $counter,
            "tahun" => date("Y"),
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

    function counter_old($counter)
    {
        return $this->db->get("t_counter", array(
            "id" => $counter,
        ))->row_array();
    }
    // COUNTER
}
