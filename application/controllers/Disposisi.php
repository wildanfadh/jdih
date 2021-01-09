<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disposisi extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Pengajuan_model", "pen_model");
        $this->load->model("Penyusunan_model", "pey_model");
        $this->load->model("Disposisi_model", "dis_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["title"] = "Daftar Disposisi";
        $data["_view"] = "disposisi/index";
        $data["_js"] = "disposisi/index_js";

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_ajax()
    {
        $post = $this->input->post();

        $search = $post['search']['value'];
        $limit = $post['length'];
        $start = $post['start'];
        $order_index = $post['order'][0]['column'];
        $order_field = $post['columns'][$order_index]['data'];
        $order_ascdesc = $post['order'][0]['dir'];

        $group = $this->session->userdata("group");
        $all = false;
        if ($group == PERM_ADM or $group == PERM_JDIH_PE or $group == PERM_JDIH_SK or $group == PERM_JDIH_KB)
            $all = true;

        $total = $this->pen_model->count_all_ajax($all);
        $data = $this->pen_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $all);
        $filter = $this->pen_model->count_filter_ajax($search, $all);

        $no = 1;
        $pengajuan = array();
        foreach ($data as $key => $val) {
            $data = array(
                "id" => $val["id"],
                "judul" => $val["judul"],
                "nama" => $val["nama"],
                "jabatan" => $val["jabatan"],
            );

            if ($val["status"] == PENGAJUAN_MASUK) {
                $data["status"] = "
                    <span class='btn btn-sm btn-block btn-outline-primary in' style='cursor: pointer;' data-id='" . $val["id"] . "'>Masuk</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_PROSES) {
                $data["status"] = "
                    <span class='btn btn-sm btn-block btn-outline-warning process' style='cursor: pointer;' data-id='" . $val["id"] . "'>Proses</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_TERIMA) {
                $data["status"] = "
                    <span class='btn btn-sm btn-block btn-outline-success accept' style='cursor: pointer;' data-id='" . $val["id"] . "'>Diterima</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_KEMBALI) {
                $data["status"] = "
                    <span class='btn btn-sm btn-block btn-outline-danger reject' style='cursor: pointer;' data-id='" . $val["id"] . "'>Dikembalikan</span>
                ";
            }

            $disabled = "";
            $delete_btn = "
                <button type='button' class='btn btn-xs btn-danger delete' data-id='" . $val["id"] . "' data-judul='" . $val["judul"] . "' data-toggle='tooltip' data-placement='top' title='Hapus Pengajuan " . $val["judul"] . "' style='padding: 2px 6px;' $disabled>
                    <i class='fas fa-trash'></i>
                </button>
            ";

            $view_btn = "
                <button type='button' class='btn btn-xs btn-info view' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Lihat Pengajuan " . $val["judul"] . "' $disabled>
                    <i class='far fa-eye'></i>
                </button>
            ";

            $edit_btn = "
                <button type='button' class='btn btn-xs btn-warning edit' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Ubah Pengajuan " . $val["judul"] . "' $disabled>
                    <i class='fas fa-pencil-alt'></i>
                </button>
            ";

            $confirm_btn = "
            <div class='btn-group'>
                <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown'>
                    <i class='fas fa-exclamation'></i>
                </button>
                <div class='dropdown-menu' role='menu'>
                    <a class='dropdown-item verificator' data-id='" . $val["id"] . "' data-status='" . PENGAJUAN_TERIMA . "'>Diterima</a>
                    <a class='dropdown-item verificator' data-id='" . $val["id"] . "' data-status='" . PENGAJUAN_KEMBALI . "'>Ditolak</a>
                </div>
            </div>
            ";

            $penyusunan_btn = "
                <button type='button' class='btn btn-xs btn-success susun' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Proses Penyusunan " . $val["judul"] . "' $disabled>
                    <i class='fas fa-cogs'></i>
                </button>
            ";

            $list_susun_btn = "
                <button type='button' class='btn btn-xs btn-warning list-susun' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Daftar Hasil Penyusunan " . $val["judul"] . "' $disabled>
                    <i class='fas fa-list-ul'></i>
                </button>
            ";

            $aksi = "";
            if (($group == PERM_ADM or $group == PERM_JDIH_PE or $group == PERM_JDIH_SK or $group == PERM_JDIH_KB) and
                ($val["status"] == PENGAJUAN_MASUK)
            ) {
                $aksi = $confirm_btn;
            }

            if (($group == PERM_ADM or $group == PERM_JDIH_PE or $group == PERM_JDIH_SK or $group == PERM_JDIH_KB) and
                ($val["status"] == PENGAJUAN_TERIMA)
            ) {
                $aksi .= $penyusunan_btn;
            }

            if (($group == PERM_ADM or $group == PERM_JDIH_PE or $group == PERM_JDIH_SK or $group == PERM_JDIH_KB) and
                ($val["status"] == PENGAJUAN_PROSES)
            ) {
                $aksi .= $list_susun_btn;
            }

            $aksi .= $view_btn;

            if ($val["status"] == PENGAJUAN_KEMBALI and $val["created_by"] == $this->session->userdata("user_id")) {
                $aksi .= $edit_btn . $delete_btn;
            }

            $data["aksi"] = $aksi;

            $pengajuan[] = $data;

            $no++;
        }

        $result = array(
            'draw' => $post['draw'], // Ini dari datatablenya
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $pengajuan,
        );

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
