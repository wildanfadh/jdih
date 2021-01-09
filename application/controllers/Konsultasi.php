<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Konsultasi_model", "kon_model");
    }

    private function chat_list($post, $to, $deleted, $draft, $read)
    {
        $search = $post['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $post['length']; // Ambil data limit per page
        $start = $post['start']; // Ambil data start
        $order_index = $post['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $post['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $post['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $total = $this->kon_model->count_allChat_ajax($to, $deleted, $draft, $read);
        $data = $this->kon_model->filterChat_ajax($search, $limit, $start, $order_field, $order_ascdesc, $to, $deleted, $draft, $read);
        // $this->print_out_data($this->db->last_query());
        $filter = $this->kon_model->count_filterChat_ajax($search, $to, $deleted, $draft, $read);

        $no = 1;
        $konsultasi = array();

        foreach ($data as $key => $val) {
            $view_btn = "";

            $status = "";

            // if ($val["has_send"] == SUDAH_DIBALAS && $val["status"] == KONFIRMASI_SELESAI) {
            //     // if ($val["is_confirmed"] == STATUS_DIKONFIRMASI) {
            //     $status = "<button type='button' class='btn btn-xs btn-block btn-outline-success' data-toggle='tooltip' data-placement='top' title='Pesan telah Dikonfirmasi'> Dikonfirmasi
            //     </button>";
            // } elseif ($val["has_send"] == SUDAH_DIBALAS) {
            //     // } elseif ($val["is_confirmed"] == STATUS_MASUK) {
            //     $status = "<button type='button' class='btn btn-xs btn-block btn-outline-warning' data-toggle='tooltip' data-placement='top' title='Ada pesan yang belum Dikonfirmasi'> Sudah Dibalas
            //     </button>";
            // } elseif ($val["has_send"] == null) {
            //     $status = "<button type='button' class='btn btn-xs btn-block btn-outline-secondary' data-toggle='tooltip' data-placement='top' title='Pesan ini belum Dibalas'> Belum Dibalas
            //         </button>";
            // } elseif ($val["is_confirmed"] == STATUS_DIBATALKAN) {
            //     $status = "<button type='button' class='btn btn-xs btn-block btn-outline-danger' data-toggle='tooltip' data-placement='top' title='Pesan telah Dikonfirmasi'> Dibatalkan
            //     </button>";
            // }

            if ($this->session->userdata("group") != PERM_SKPD) {

                if ($val["status"] == STATUS_DIKONFIRMASI) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-success' data-toggle='tooltip' data-placement='top' title='Pesan telah Dikonfirmasi'> Dikonfirmasi
                    </button>";
                } elseif ($val["status"] == STATUS_MASUK) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-warning' data-toggle='tooltip' data-placement='top' title='Ada pesan yang belum Dikonfirmasi'> Sudah Dibalas
                    </button>";
                } elseif ($val["has_send"] == null) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-secondary' data-toggle='tooltip' data-placement='top' title='Konsultasi belum Dibalas'> Belum Dibalas
                        </button>";
                } elseif ($val["status"] == STATUS_DIBATALKAN) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-danger' data-toggle='tooltip' data-placement='top' title='Pesan telah Dibatalkan'> Dibatalkan
                    </button>";
                }
            } else {

                if ($val["status"] == STATUS_DIKONFIRMASI) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-success' data-toggle='tooltip' data-placement='top' title='Konsultasi Sudah Tersedia'> Sudah Tersedia
                    </button>";
                } elseif ($val["status"] == STATUS_MASUK) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-warning' data-toggle='tooltip' data-placement='top' title='Konsultasi sedang Diproses'> Sedang Diproses
                    </button>";
                } elseif ($val["has_send"] == null) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-secondary' data-toggle='tooltip' data-placement='top' title='Konsultasi belum Tersedia'> Belum Tersedia
                        </button>";
                } elseif ($val["is_confirmed"] == BELUM_KONFIRMASI) {
                    $status = "<button type='button' class='btn btn-xs btn-block btn-outline-warning' data-toggle='tooltip' data-placement='top' title='Konsultasi sedang Diproses'> Sedang Diproses
                    </button>";
                }
            }


            $subject = "
                <span class='float-left text-left'> " . $val["subject"] . " </span>
            ";

            $newMessage = "";
            if ($val["to_read"] == 0 && $val["id_to"] == $this->session->userdata("user_id")) {
                $newMessage = "<button type='button' class='btn btn-xs float-right btn-warning' data-toggle='tooltip' data-placement='top' title='Pesan belum Dilihat'> <i class='far fa-eye-slash'></i></i>
                </button>";
            } elseif ($val["from_read"] == 0 && $val["id_from"] == $this->session->userdata("user_id")) {
                $newMessage = "<button type='button' class='btn btn-xs float-right btn-warning' data-toggle='tooltip' data-placement='top' title='Pesan belum Dilihat'> <i class='far fa-eye-slash'></i>
                    </button>";
            } else {
                $newMessage = "<button type='button' class='btn btn-xs float-right btn-success' data-toggle='tooltip' data-placement='top' title='Pesan sudah Dilihat'> <i class='far fa-eye'></i>
                    </button>";
            }

            $delete_btn = "";

            if ($this->session->userdata("group") == PERM_SKPD && $val["has_send"] < 1) {

                $delete_btn = "
                    <button type='button' class='btn btn-xs btn-danger delete' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Hapus Pesan'>
                    <i class='far fa-trash-alt'></i>
                    </button>";
            }

            $view_btn = " <button type='button' class='btn btn-xs btn-info view' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Lihat Pesan'>
                    <i class='fas fa-search'></i>
                     </button>";

            if ($val["id_to_group"] == PERM_KABAG) {
                $idto = "Kepala Bagian";
            } elseif ($val["id_to_group"] == PERM_DOKUM) {
                $idto = "Sub Dokumentasi";
            } elseif ($val["id_to_group"] == PERM_PERUNDANGAN) {
                $idto = "Sub Perundang Undangan";
            } elseif ($val["id_to_group"] == PERM_BANKUM) {
                $idto = "Sub Bantuan Hukum";
            } elseif ($val["id_to_group"] == PERM_RESEPSIONIS) {
                $idto = "Resepsionis";
            } else {
                $idto = "Internal";
            }

            // if ($this->session->userdata("group") == PERM_SKPD) {
            //     $pesan = "from_read";
            // } else {
            //     $pesan = "to_read";
            // }

            $konsultasi[] = array(
                "id" => $no,
                "nama" => $val["nama"],
                "jabatan" => $val["jabatan"],
                "to" => $idto,
                // "subject" => $subject,
                "subject" => $subject . $newMessage,
                // $pesan => $newMessage,
                "status" => $status,
                "aksi" => $view_btn . $delete_btn,
                // "aksi" => $aksi,
            );

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

    public function konsultasi_list()
    {
        $data["title"] = "Konsultasi";
        $data["_view"] = "konsultasi/list";
        $data["_js"] = "konsultasi/list_js";

        $data["url"] = base_url("Konsultasi/index_chat_ajax");
        $data["_aside"] = "konsultasi/aside";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_chat_ajax()
    {
        $post = $this->input->post();
        // $this->print_out_data($post);
        $result = $this->chat_list($post, "all", "all", "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    // public function message_forme()
    // {
    //     // $idGroup = $this->session->userdata("group");
    //     // $konsul = $this->kon_model->get_userdetail($idGroup);

    //     // if ($idGroup != PERM_SKPD) {
    //     $data["title"] = "Tugas Konsultasi <small>( Pesan Untuk Saya )</small>";
    //     $data["_view"] = "konsultasi/list";
    //     $data["_js"] = "konsultasi/list_js";

    //     $data["url"] = base_url("Konsultasi/index_chat_ajax_me");
    //     $data["_aside"] = "konsultasi/aside";
    //     $this->show_layout($data, LAYOUT_DASHBOARD);
    // }

    // public function index_chat_ajax_me()
    // {
    //     $post = $this->input->post();
    //     $idGroup = $this->session->userdata("group");
    //     $result = $this->chat_list($post, $idGroup, "all", "all", "all");

    //     header('Content-Type: application/json');
    //     echo json_encode($result); // Convert array $callback ke json
    // }

    public function message_done()
    {
        if ($this->session->userdata("group") != PERM_SKPD) {
            $data["title"] = "Konsultasi <small>( Pesan yang sudah Dibalas dan Dikonfirmasi )</small>";
        } else {
            $data["title"] = "Konsultasi <small>( Konsultasi yang sudah Tersedia )</small>";
        }

        $data["_view"] = "konsultasi/list";
        $data["_js"] = "konsultasi/list_js";

        $data["url"] = base_url("Konsultasi/index_chat_ajax_done");
        $data["_aside"] = "konsultasi/aside";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_chat_ajax_done()
    {
        $post = $this->input->post();
        $result = $this->chat_list($post, "done", "all", "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    public function message_reject()
    {
        $data["title"] = "Konsultasi <small>( Pesan yang sudah Dibalas tapi DiBatalkan )</small>";
        $data["_view"] = "konsultasi/list";
        $data["_js"] = "konsultasi/list_js";

        $data["url"] = base_url("Konsultasi/index_chat_ajax_reject");
        $data["_aside"] = "konsultasi/aside";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_chat_ajax_reject()
    {
        $post = $this->input->post();
        $result = $this->chat_list($post, "rejected", "all", "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    public function message_pending()
    {
        if ($this->session->userdata("group") != PERM_SKPD) {
            $data["title"] = "Konsultasi <small>( Pesan yang belum Dibalas )</small>";
        } else {
            $data["title"] = "Konsultasi <small>( Konsultasi yang belum Tersedia )</small>";
        }

        $data["_view"] = "konsultasi/list";
        $data["_js"] = "konsultasi/list_js";

        $data["url"] = base_url("Konsultasi/index_chat_ajax_pending");
        $data["_aside"] = "konsultasi/aside";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_chat_ajax_pending()
    {
        $post = $this->input->post();
        $result = $this->chat_list($post, "pending", "all", "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    public function message_confir()
    {

        $data["title"] = "Konsultasi <small>( Pesan yang sudah Dibalas tapi belum Dikonfirmasi )</small>";

        $data["_view"] = "konsultasi/list";
        $data["_js"] = "konsultasi/list_js";

        $data["url"] = base_url("Konsultasi/index_chat_ajax_confir");
        $data["_aside"] = "konsultasi/aside";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_chat_ajax_confir()
    {
        $post = $this->input->post();
        $result = $this->chat_list($post, "confir", "all", "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    public function message_proses_foropd()
    {
        $data["title"] = "Konsultasi <small>( Konsultasi yang Sedang Diproses )</small>";
        $data["_view"] = "konsultasi/list";
        $data["_js"] = "konsultasi/list_js";

        $data["url"] = base_url("Konsultasi/index_chat_ajax_proses_foropd");
        $data["_aside"] = "konsultasi/aside";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_chat_ajax_proses_foropd()
    {
        $post = $this->input->post();
        $result = $this->chat_list($post, "proses-foropd", "all", "all", "all");

        header('Content-Type: application/json');
        echo json_encode($result); // Convert array $callback ke json
    }

    public function addkonsul()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $save = array(
                "id_from" => $this->session->userdata("user_id"),
                // "id_to" => $post["user"],
                // "id_to_group" => $post["idtogroup"],
                "id_to" => 6, // Langsung Kepada Bankum
                "id_to_group" => PERM_BANKUM,
                "nama" => $post["nama"],
                "jabatan" => $post["jabatan"],
                "subject" => $post["subject"],
                "message" => $post["message"],

                "status" => STATUS_KOSONG,
                "from_read" => true,
                "is_deleted" => false,
                "is_read" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $this->session->userdata("user_id"),
            );

            echo $this->kon_model->save($save);
        } else {

            $data["title"] = "Konsultasi Baru";
            $data["_view"] = "konsultasi/addkonsul";
            $data["_js"] = "konsultasi/addkonsul_js";

            // $group = $this->kon_model->get_userbygroup();
            $groups = $this->kon_model->get_user();
            $data["opd"] = $groups;

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function addchat()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            // $namaSKPD = $this->kon_model->get_skpd($get["konsultasi"]);
            $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
            $konsultasiSkpd["user"] = $this->kon_model->get_userdetail($konsultasi["id_from"]);
            $konsul = $this->kon_model->get_userdetail($konsultasi["id_to"]);
            // $this->print_out_data($konsul);

            $msg = $post["nama"];

            if ($msg == PERM_KABAG) {
                // $nama = "Kepala Bagian";
                $nama = $konsul["group_description"];
                $status = STATUS_KOSONG;
                $confirmed = BELUM_KONFIRMASI;
            } elseif ($msg == PERM_PERUNDANGAN) {
                // $nama = "Sub Perundangan Undangan";
                $nama = $konsul["group_description"];
                $status = STATUS_KOSONG;
                $confirmed = BELUM_KONFIRMASI;
            } elseif ($msg == PERM_BANKUM) {
                // $nama = "Sub Bantuan Hukum";
                $nama = $konsul["group_description"];
                $status = STATUS_KOSONG;
                $confirmed = BELUM_KONFIRMASI;
            } elseif ($msg == PERM_DOKUM) {
                // $nama = "Sub Dokumen Hukum";
                $nama = $konsul["group_description"];
                $status = STATUS_KOSONG;
                $confirmed = BELUM_KONFIRMASI;
            } else {
                $nama = $konsultasi["nama"];
                // $nama = "SKPD";
                $status = STATUS_DIKONFIRMASI;
                $confirmed = STATUS_DIKONFIRMASI;
            }

            $saveChild = array(
                "id_konsultasi" => $post["konsultasi"],
                // "id_from" => $this->session->userdata("user_id"),
                "id_from" => $post["from"],
                "id_group" => $post["group"],
                "nama" => $nama,
                "message" => $post["message"],

                "status" => $status,
                "is_confirmed" => $confirmed,
                "is_deleted" => false,

                "created_date" => date("Y-m-d H:i:s"),
                "created_by" => $post["created"],
            );

            if ($this->session->userdata("group") == PERM_SKPD) {
                $toRead = false;
            } else {
                $toRead = true;
            }

            $kon = $konsultasi["status"];
            // $kon = 0;
            if ($saveChild["is_confirmed"] == STATUS_DIKONFIRMASI) {
                $save = array(
                    // "status" => 0,
                    "to_read" => $toRead,
                    "has_send" => true,
                    "status" => STATUS_MASUK,
                );
            } else {
                $save = array(
                    // "status" => $kon + 1,
                    "to_read" => $toRead,
                    "has_send" => true,
                    "status" => STATUS_MASUK,
                );
            }

            // $this->print_out_data($save);
            echo $this->kon_model->update_konsul($post["konsultasi"], $save, $saveChild);
            // $this->print_out_data($saveChild);

            // echo $this->kon_model->saveChat($saveChild);
        } else {
            $get = $this->input->get();
            $this->kon_model->read($get["konsultasi"]);

            $data["title"] = "Detail Konsultasi";
            $data["_view"] = "konsultasi/chat";
            $data["_js"] = "konsultasi/chat_js";

            $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
            $konsultasi["user"] = $this->kon_model->get_userdetail($konsultasi["id_from"]);

            // $data["chat"] = $this->kon_model->getChat($get["konsultasi"]);
            $data["chat"] = $this->kon_model->getChat();
            // $data["chatid"] = $this->kon_model->getChatid();

            $data["konsultasi"] = $konsultasi;

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function chat()
    {
        $get = $this->input->get();

        $penerima = $this->kon_model->get_byid($get["konsultasi"]);
        $usr = $this->session->userdata("user_id");

        if ($penerima["id_to"] == $usr) {
            $savekon = array(
                "to_read" => true,
            );
            echo $this->kon_model->update_konsul($get["konsultasi"], $savekon);
        } elseif ($penerima["id_from"] == $usr) {
            $savekon = array(
                "from_read" => true,
            );
            echo $this->kon_model->update_konsul($get["konsultasi"], $savekon);
        }

        if (in_array($this->session->userdata("group"), array(PERM_KABAG, PERM_SKPD))) {
            $data["hide"] = "hide";
        } else {
            $data["hide"] = "";
        }

        $this->kon_model->read($get["konsultasi"]);

        $data["title"] = "Detail Konsultasi";
        $data["_view"] = "konsultasi/chat";
        $data["_js"] = "konsultasi/chat_js";

        $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
        $konsultasi["user"] = $this->kon_model->get_userdetail($konsultasi["id_from"]);

        // $data["chat"] = $this->kon_model->getChat($get["konsultasi"]);
        $data["chat"] = $this->kon_model->getChat($get["konsultasi"]);
        // $data["chatid"] = $this->kon_model->getChatid($get["konsultasi"]);

        $data["kon"] = $get["konsultasi"];
        $data["konsultasi"] = $konsultasi;
        // $this->print_out_data($data);
        $data["_aside"] = "konsultasi/asidechat";
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function updatechat()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            // $this->print_out_data($post);

            $saveChild = array(
                "message" => $post["message-mod"],

                "modified_date" => date("Y-m-d H:i:s"),
                "modified_by" => $post["from"],
            );


            echo $this->kon_model->UpdateChat($post["id"], $saveChild);
        } else {
            $get = $this->input->get();
            $this->kon_model->read($get["konsultasi"]);

            $data["title"] = "Detail Konsultasi";
            $data["_view"] = "konsultasi/chat";
            $data["_js"] = "konsultasi/chat_js";

            $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
            $konsultasi["user"] = $this->kon_model->get_userdetail($konsultasi["id_from"]);

            // $data["chat"] = $this->kon_model->getChat($get["konsultasi"]);
            $data["chat"] = $this->kon_model->getChat();
            // $data["chatid"] = $this->kon_model->getChatid();

            $data["konsultasi"] = $konsultasi;

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function confir_chat()
    {
        $get = $this->input->get();

        $sts["status"] = $this->kon_model->getChat_forStatus($get["konsultasi"]);
        $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
        // if (!empty($get)) {
        $save = array(
            "is_confirmed" => true,
            "is_deleted" => false,
            "status" => STATUS_DIKONFIRMASI,
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("user_id"),
        );

        $kon = $konsultasi["status"];
        if ($save["status"] == STATUS_DIKONFIRMASI) {
            $savekon = array(
                // "status" => $kon - 1,
                "from_read" => false,
                "status" => STATUS_DIKONFIRMASI,
            );
        } elseif ($save["status"] == STATUS_DIBATALKAN) {
            $savekon = array(
                // "status" => $kon - 1,
                "status" => STATUS_DIBATALKAN,
            );
        } else {
            $savekon = array(
                "status" => STATUS_KOSONG,
            );
        }

        // $this->print_out_data($savekon);
        // $this->print_out_data($get["konsultasi"]);
        echo $this->kon_model->update_konsul($get["konsultasi"], $savekon, $get["chat"], $save);

        // echo $this->kon_model->confir_to_send($get["chat"], $save);
    }

    public function reject_chat()
    {
        $get = $this->input->get();

        $sts["status"] = $this->kon_model->getChat_forStatus($get["konsultasi"]);
        $konsultasi = $this->kon_model->get_byid($get["konsultasi"]);
        $save = array(
            "is_confirmed" => 0,
            "is_deleted" => true,
            "status" => STATUS_DIBATALKAN,
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("user_id"),
        );

        $kon = $konsultasi["status"];
        if ($save["status"] == STATUS_DIKONFIRMASI) {
            $savekon = array(
                // "status" => $kon - 1,
                "status" => STATUS_DIKONFIRMASI,
            );
        } elseif ($save["status"] == STATUS_DIBATALKAN) {
            $savekon = array(
                // "status" => $kon - 1,
                "status" => STATUS_DIBATALKAN,
                "is_confirmed" => BELUM_KONFIRMASI,
            );
        } else {
            $savekon = array(
                "status" => STATUS_KOSONG,
            );
        }

        echo $this->kon_model->update_konsul($get["konsultasi"], $savekon, $get["chat"], $save);

        // echo $this->kon_model->confir_to_send($get["chat"], $save);
    }


    public function hapusKonsul()
    {
        $get = $this->input->get();
        echo $this->kon_model->deleteKonsul($get["konsultasi"]);
    }


    public function end_konsul()
    {
        $get = $this->input->get();


        // if ($save["status"] == 1) {
        $savekon = array(
            "is_end" => true,
        );
        // } else {
        //     $savekon = array(
        //         "status" => 0,
        //     );
        // }

        echo $this->kon_model->update_konsul($get["konsultasi"], $savekon);
    }
}
