<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi2 extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Konsultasi2_model", "kon_model");
    }

    private function data_list($post, $to, $deleted, $draft, $read)
    {
        $search = $post['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $post['length']; // Ambil data limit per page
        $start = $post['start']; // Ambil data start
        $order_index = $post['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $post['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $post['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $total = $this->kon_model->count_all_ajax($to, $deleted, $draft, $read);
        $data = $this->kon_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $to, $deleted, $draft, $read);
        // $this->print_out_data($this->db->last_query());
        $filter = $this->kon_model->count_filter_ajax($search, $to, $deleted, $draft, $read);

        $no = 1;
        $konsultasi = array();
        // $confir_kabag = $this->db->get("t_konsultasi")->result();
        $usr_ = $this->session->userdata("user_id");
        // $p_sent = $this->kon_model->get_permite_sent();


        // $this->print_out_data($data);
        foreach ($data as $key => $val) {
            $view_btn = "";

            if ($val["is_draft"]) {
                $view_btn = "
                    <button type='button' class='btn btn-xs btn-warning edit' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Lihat Pesan'>
                    <i class='fas fa-search'></i>
                    </button>
                ";
            } else {
                $view_btn = "
                    <button type='button' class='btn btn-xs btn-warning view' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Lihat Pesan'>
                    <i class='fas fa-search'></i>
                    </button>
                ";
            }

            $reply_btn = "";
            if ($deleted != 1) {
                $reply_btn = "
                    <button type='button' class='btn btn-xs btn-info reply' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Balas Pesan'>
                    <i class='fas fa-reply'></i>
                    </button>
                ";
            }

            $permite_btn = "
                <div class='btn-group'>
                    <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown'>
                        <i class='fas fa-exclamation'></i>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item permite' name='permite' data-id='" . $val["id"] . "' data-confir='1'>Izinkan</a>
                        <a class='dropdown-item reject' data-id='" . $val["id"] . "'>Tolak</a>
                    </div>
                </div>
            ";

            $permite_text = "";
            if ($val["is_confirmed"] == 1) {
                $permite_text = "
                    <span class='btn btn-xs btn-outline-success' style='cursor: pointer;'>Sudah Konfirmasi</span>
                ";
            } elseif ($val["is_confirmed"] == 2) {
                $permite_text = "
                    <span class='btn btn-xs btn-outline-danger' style='cursor: pointer;'>Tidak Dikonfirmasi</span>
                ";
            } else {
                $permite_text = "
                    <span class='btn btn-xs btn-outline-warning' style='cursor: pointer;'>Belum Konfirmasi</span>
                ";
            }

            $delete_btn = "
                <button type='button' class='btn btn-xs btn-danger delete' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Hapus Pesan'>
                <i class='far fa-trash-alt'></i>
                </button>
            ";

            $read = "";
            if ($val["id_from"] != $this->session->userdata("user_id")) {
                if ($val["is_read"]) {
                    $read = "
                        <span class='float-right' data-toggle='tooltip' data-placement='top' title='Sudah Dibaca'>
                            <i class='far fa-eye'></i>
                        </span>
                    ";
                } else {
                    $read = "
                        <span class='float-right' data-toggle='tooltip' data-placement='top' title='Belum Dibaca'>
                            <i class='far fa-eye-slash'></i>
                        </span>
                    ";
                }
            }

            if ($usr_ == 4) {
                if ($val["is_confirmed"] == 1) {
                    $konsultasi[] = array(
                        "id" => $no,
                        "subject" => $val["subject"] . $read,
                        // "aksi" => $view_btn . $reply_btn . $delete_btn,
                        "aksi" => $view_btn . $reply_btn,
                    );
                }
            } elseif ($usr_ == 5) {
                if ($to == 4) {
                    $konsultasi[] = array(
                        "id" => $no,
                        "subject" => $val["subject"] . $permite_text . $read,
                        "aksi" => $view_btn . $reply_btn . $permite_btn,
                        // "aksi" => $view_btn . $reply_btn,
                    );
                } else {
                    $konsultasi[] = array(
                        "id" => $no,
                        "subject" => $val["subject"] . $read,
                        // "aksi" => $view_btn . $reply_btn . $permite_btn,
                        "aksi" => $view_btn . $reply_btn,
                    );
                }
            } else {
                $konsultasi[] = array(
                    "id" => $no,
                    "subject" => $val["subject"] . $read,
                    // "aksi" => $view_btn . $reply_btn . $delete_btn,
                    "aksi" => $view_btn . $reply_btn,
                );
            }

            $no++;
        }

        $result = array(
            'draw' => $post['draw'], // Ini dari datatablenya
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $konsultasi,
        );

        return $result;
    }

    public function index()
    {
        $get = $this->input->get();

        $data["title"] = "Pesan Masuk";
        $data["_view"] = "konsultasi2/index";
        $data["_js"] = "konsultasi2/index_js";

        $data["nav"] = 1;

        $data["url"] = base_url("konsultasi2/index_ajax");
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_ajax()
    {
        $post = $this->input->post();
        $result = $this->data_list($post, 1, 2, 2, "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    public function sent()
    {
        $data["title"] = "Pesan Terkirim";
        $data["_view"] = "konsultasi2/index";
        $data["_js"] = "konsultasi2/index_js";

        $data["nav"] = 2;

        $data["url"] = base_url("konsultasi2/sent_ajax");
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function permite_sent()
    {
        $get = $this->input->get();
        if (!empty($get)) {
            $save = array(
                "is_confirmed" => 1,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->session->userdata("user_id"),
            );

            echo $this->kon_model->draft_to_send($get["konsultasi"], $save);
        } else {
            $data["title"] = "Izinkan Pesan";
            $data["_view"] = "konsultasi2/index";
            $data["_js"] = "konsultasi2/index_js";

            $data["nav"] = 3;

            $data["url"] = base_url("konsultasi2/p_sent_ajax");
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function permite_reject()
    {
        $get = $this->input->get();
        $save = array(
            "is_confirmed" => 2,
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("user_id"),
        );

        echo $this->kon_model->draft_to_send($get["konsultasi"], $save);
    }

    public function p_sent_ajax()
    {
        $post = $this->input->post();
        $result = $this->data_list($post, 4, 2, 2, "all");

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function sent_ajax()
    {
        $post = $this->input->post();
        $result = $this->data_list($post, 2, 2, 2, "all");

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function draft()
    {
        $data["title"] = "Pesan Tersimpan";
        $data["_view"] = "konsultasi2/index";
        $data["_js"] = "konsultasi2/index_js";

        $data["nav"] = 4;

        $data["url"] = base_url("konsultasi2/draft_ajax");
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function draft_ajax()
    {
        $post = $this->input->post();
        $result = $this->data_list($post, 2, 2, 1, "all");

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function deleted()
    {
        $data["title"] = "Pesan Dihapus";
        $data["_view"] = "konsultasi2/index";
        $data["_js"] = "konsultasi2/index_js";

        $data["url"] = base_url("konsultasi2/deleted_ajax");
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function deleted_ajax()
    {
        $post = $this->input->post();
        $result = $this->data_list($post, "all", 1, "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function tambah()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $save = array(
                "id_from" => $this->session->userdata("user_id"),
                "id_to" => $post["user"],
                "id_from_message" => 0,
                "subject" => $post["subject"],
                "message" => $post["message"],

                "is_draft" => false,
                "is_deleted" => false,
                "is_read" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            );

            echo $this->kon_model->save($save);
        } else {
            $data["title"] = "Tulis Pesan Baru";
            $data["_view"] = "konsultasi2/add";
            $data["_js"] = "konsultasi2/add_js";

            $group = $this->kon_model->get_userbygroup();
            $data["group"] = $group;

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function save_draft()
    {
        $post = $this->input->post();
        // $this->print_out_data($post);

        $save = array(
            "id_from" => $this->session->userdata("user_id"),
            "id_to" => $post["user"],
            "id_from_message" => 0,
            "subject" => $post["subject"],
            "message" => $post["message"],

            "is_draft" => true,
            "is_deleted" => false,
            "is_read" => false,

            "created_date" => date("Y-m-d H:i:s"),
            "created_by" => $this->session->userdata("user_id"),
        );

        echo $this->kon_model->save($save);
    }

    public function lihat()
    {
        $get = $this->input->get();
        $this->kon_model->read($get["konsultasi"]);

        $data["title"] = "Lihat Pesan";
        $data["_view"] = "konsultasi2/view";
        $data["_js"] = "konsultasi2/view_js";

        $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
        $konsultasi["user"] = $this->kon_model->get_userdetail($konsultasi["id_from"]);

        $data["konsultasi"] = $konsultasi;

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function edit()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $save = array(
                "id_to" => $post["user"],
                "subject" => $post["subject"],
                "message" => $post["message"],

                "is_draft" => false,
                "is_deleted" => false,
                "is_read" => false,

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $this->session->userdata("user_id"),
            );

            echo $this->kon_model->draft_to_send($get["konsultasi"], $save);
        } else {
            $data["title"] = "Edit Pesan";
            $data["_view"] = "konsultasi2/ubah";
            $data["_js"] = "konsultasi2/ubah_js";

            $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
            $data["konsultasi"] = $konsultasi;

            $group = $this->kon_model->get_userbygroup();
            $data["group"] = $group;

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function hapus()
    {
        $get = $this->input->get();
        echo $this->kon_model->delete($get["konsultasi"]);
    }

    public function balas()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $save = array(
                "id_from" => $this->session->userdata("user_id"),
                "id_to" => $post["user"],
                "id_from_message" => $post["from_message"],
                "subject" => $post["subject"],
                "message" => $post["message"],

                "is_draft" => false,
                "is_deleted" => false,
                "is_read" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            );

            echo $this->kon_model->save($save);
        } else {
            $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
            $konsultasi["user"] = $this->kon_model->get_userdetail($konsultasi["id_from"]);
            $from = $konsultasi["user"]["user_full_name"] . " <small>(" . $konsultasi["user"]["group_name"] . ")</small>";

            $data["title"] = "Balas Pesan dari $from";
            $data["_view"] = "konsultasi2/reply";
            $data["_js"] = "konsultasi2/reply_js";

            $data["konsultasi"] = $konsultasi;

            // $this->print_out_data($data);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }
}
