<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends WH_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->login_check();

        $this->load->model("Pengajuan_model", "pen_model");
        $this->load->model("Penyusunan_model", "pey_model");
        $this->load->model("Disposisi_model", "dis_model");
    }

    public function index()
    {
        $get = $this->input->get();

        $perm = $this->group;
        if (!empty($get["_p"])) {
            $perm = $get["_p"];
        }

        $tipe = array();
        if (!empty($get["_t"])) {
            $tipe = array();
            foreach ($get["_t"] as $val) {
                $tipe[] = $val;
            }
        }

        $data["title"] = "Daftar Surat Pengajuan Produk Hukum";
        $data["_view"] = "pengajuan/index";
        $data["_js"] = "pengajuan/index_js";

        $data["perm"] = $perm;
        $data["tipe"] = $tipe;

        $data["opd"] = $this->pen_model->get_user_opd();

        // $this->print_out_data($data);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function index_ajax()
    {
        $post = $this->input->post();
        $get = $this->input->get();

        $tipe = array();

        // PERMISSION FILTER
        $perm = PERM_ADM;
        if (!empty($get["perm"])) {
            $perm = $get["perm"];
        }

        if ($this->group == PERM_ASISTEN or $this->group == PERM_SEKDA or $this->group == PERM_WALIKOTA) {
            $status = array(1, 2);
        }
        // PERMISSION FILTER

        // FILTER STATUS
        $status = "a";
        if (isset($get["status"])) {
            if ($get["status"] != "undefined") {
                $status = $get["status"];
            }
        }
        // FILTER STATUS

        // FILTER USER/GROUP
        $all = 0;
        if ($this->group != PERM_SKPD) {
            $all = 1;
        }

        if (isset($get["opd"])) {
            $all = $get["opd"];
        }
        // FILTER USER/GROUP

        // DATA FOR DATATABLE
        $search = $post['search']['value'];
        $limit = $post['length'];
        $start = $post['start'];
        $order_index = $post['order'][0]['column'];
        $order_field = $post['columns'][$order_index]['data'];
        $order_ascdesc = $post['order'][0]['dir'];

        $total = $this->pen_model->count_all_ajax($all, $perm, $tipe, $status);
        $data = $this->pen_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $all, $perm, $tipe, $status);
        $filter = $this->pen_model->count_filter_ajax($search, $all, $perm, $tipe, $status);
        // DATA FOR DATATABLE

        // IMPLEMENT DATA
        $no = 1;
        $pengajuan = array();
        foreach ($data as $key => $val) {
            $judul = "<span class='view-jumlah' data-toggle='modal' data-target='#modal_view_jumlah' data-prokum='" . $val["jumlah_prokum_before"] . "' data-proses='" . $val["jumlah_proses"] . "' data-kembali='" . $val["jumlah_kembali"] . "' style='cursor: pointer;'>";
            $judul .= $val["judul"];
            $judul .= " <small><strong>";

            $judul .= "(<span class='text-primary'>" . $val["jumlah_prokum_before"] . "</span>";
            $judul .= "/<span class='text-success'>" . $val["jumlah_proses"] . "</span>";
            $judul .= "/<span class='text-danger'>" . $val["jumlah_kembali"] . "</span>)";

            $judul .= "</strong></small></span>";

            $data = array(
                "id" => $no,
                "judul" => $judul,
                "nama" => "<center>" . $val["nama"] . "</center>",

                // "jabatan" => $val["jabatan"] . "//". $val["jumlah_prokum"],
                "jabatan" => "<center>" . $val["jabatan"] . "</center>",
            );

            // if (!$all)
            $data["opd"] = "<center>" . $val["user_full_name"] . "</center>";

            $status = "";
            if ($val["status"] == PENGAJUAN_MASUK) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' data-id='" . $val["id"] . "'>Usulan Masuk</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_PROSES) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Proses Kasubbag</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_TERIMA) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Proses Kasubbag</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_KEMBALI) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-danger reject' style='cursor: pointer;' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Klik untuk melihat Keterangan Pengembalian'>Usulan Dikembalikan</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_TERUS) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Disposisi Kabag</span>
                ";
            }

            $data["status"] = $status;

            $disabled = "";

            // VIEW JIKA PINDAH HALAMAN
            $view_btn = "
                <button type='button' class='btn btn-xs btn-info view' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Lihat Pengajuan " . $val["judul"] . "' $disabled>
                    <i class='far fa-eye'></i>
                </button>
            ";

            // VIEW POP UP MODAL
            $view_btn = "
                <button type='button' class='btn btn-xs btn-info view' data-id='" . $val["id"] . "' data-toggle='modal' data-target='#modal_view'>
                    <i class='far fa-eye' data-toggle='tooltip' data-placement='top' title='Lihat Detail Pengajuan " . $val["judul"] . "'></i>
                </button>
            ";

            // EDIT BUTTON UNTUK OPD
            $edit_btn = "
                <button type='button' class='btn btn-xs btn-warning edit' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Ubah Pengajuan " . $val["judul"] . "' $disabled>
                    <i class='fas fa-pencil-alt'></i>
                </button>
            ";

            // HAPUS BUTTON
            $delete_btn = "
                <button type='button' class='btn btn-xs btn-danger delete' data-id='" . $val["id"] . "' data-judul='" . $val["judul"] . "' data-toggle='tooltip' data-placement='top' title='Hapus Pengajuan " . $val["judul"] . "' style='padding: 2px 6px;' $disabled>
                    <i class='fas fa-trash'></i>
                </button>
            ";

            $disabled = ($val["status"] == PENGAJUAN_MASUK) ? "" : "disabled";

            // MENERUSKAN KE KABAG BUTTON
            $assign_btn = "
                <div class='btn-group'>
                    <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown'>
                        <i class='fas fa-exclamation'></i>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item assign' data-id='" . $val["id"] . "' data-judul='" . $val["judul"] . "' data-toggle='modal' data-target='#modal_assign' data-backdrop='static' data-keyboard='false' style='cursor: pointer;'>
                            <span data-toggle='tooltip' data-placement='top' title='Teruskan Pengajuan " . $val["judul"] . " ke Kabag'>Diteruskan</span>
                        </a>
                        <a class='dropdown-item verificator' data-id='" . $val["id"] . "' data-status='" . PENGAJUAN_KEMBALI . "' data-toggle='modal' data-target='#modal_assign' data-backdrop='static' data-keyboard='false' style='cursor: pointer;'>
                            <span data-toggle='tooltip' data-placement='top' title='Kembalikan Pengajuan " . $val["judul"] . " ke OPD'>Dikembalikan</span>
                        </a>
                    </div>
                </div>
            ";

            // MENERIMA BUTTON
            $confirm_btn = "
                <button type='button' class='btn btn-xs bg-purple verificator disposisi' data-id='" . $val["id"] . "' data-status='" . PENGAJUAN_TERIMA . "' data-toggle='modal' data-target='#modal_disposisi' data-backdrop='static' data-keyboard='false' data-pengajuan='" . $val["id"] . "' data-judul='" . $val["judul"] . "'>
                    <i class='fas fa-share' data-toggle='tooltip' data-placement='top' title='Disposisi Pengajuan " . $val["judul"] . " ke Sub. Bagian'></i>
                </button>
            ";

            $disabled = "";
            // PENYUSUNAN BUTTON
            $penyusunan_btn = "
                <button type='button' class='btn btn-xs btn-success susun' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Proses Penyusunan " . $val["judul"] . "' $disabled>
                    <i class='fas fa-cogs'></i>
                </button>
            ";

            // DAFTAR PENYUSUNAN BUTTON
            $list_susun_btn = "
                <button type='button' class='btn btn-xs btn-warning list-susun' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Daftar Hasil Penyusunan " . $val["judul"] . "' $disabled>
                    <i class='fas fa-list-ul'></i>
                </button>
            ";

            $disposisi_id = 0;
            if (!empty($val["disposisi_id"])) $disposisi_id = $val["disposisi_id"];

            // DISPOSISI BUTTON
            $view_disposisi_btn = "
                <button type='button' class='btn btn-xs bg-purple view-disposisi' data-id='" . $val["id"] . "' data-disposisi='$disposisi_id' data-judul='" . $val["judul"] . "' data-toggle='modal' data-target='#modal_view_disposisi'>
                    <i class='fas fa-mail-bulk' data-toggle='tooltip' data-placement='top' title='Hasil Disposisi " . $val["judul"] . "'></i>
                </button>
            ";

            $aksi = "";
            // OTORISASI TOMBOL ASSIGN/FORWARD
            if ($get["perm"] == PERM_RESEPSIONIS and $val["status"] == PENGAJUAN_MASUK) {
                $aksi .= $assign_btn;
            }

            // OTORISASI TOMBOL KONFIRMASI
            if ($get["perm"] == PERM_KABAG and $val["status"] == PENGAJUAN_TERUS) {
                $aksi .= $confirm_btn;
            }

            // OTORISASI TOMBOL PENYUSUNAN
            if (($get["perm"] == PERM_DOKUM
                    or $get["perm"] == PERM_PERUNDANGAN
                    or $get["perm"] == PERM_BANKUM)
                and $val["status"] == PENGAJUAN_TERIMA
                // and ($val["status"] == PENGAJUAN_TERIMA
                //     or $val["status"] == PENGAJUAN_PROSES)
                // and $val["jumlah_prokum"] != 0
            ) {
                $aksi .= $penyusunan_btn;
            }

            // OTORISASI TOMBOL DAFTAR PENYUSUNAN
            if ($val["status"] == PENGAJUAN_PROSES) {
                $aksi .= $list_susun_btn;
            }

            $aksi .= $view_btn;
            if (
                ($get["perm"] != PERM_SKPD
                    and $get["perm"] != PERM_RESEPSIONIS)
                and ($val["status"] == PENGAJUAN_TERIMA
                    or $val["status"] == PENGAJUAN_PROSES)
            ) {
                $aksi .= $view_disposisi_btn;
            }

            // OTORISASI OPD UNTUK EDIT KETIKA DIKEMBALIKAN
            if ($get["perm"] == PERM_SKPD and $val["status"] == PENGAJUAN_KEMBALI) {
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
        // IMPLEMENT DATA

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function report()
    {
        $get = $this->input->get();

        $perm = $this->group;
        if (!empty($get["_p"])) {
            $perm = $get["_p"];
        }

        $tipe = array();
        if (!empty($get["_t"])) {
            $tipe = array();
            foreach ($get["_t"] as $val) {
                $tipe[] = $val;
            }
        }

        $data["title"] = "Progress Surat Pengajuan Produk Hukum";
        $data["_view"] = "pengajuan/report";
        $data["_js"] = "pengajuan/report_js";

        $data["perm"] = $perm;
        $data["tipe"] = $tipe;

        // $this->print_out_data($data);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function report_ajax()
    {
        $post = $this->input->post();
        $get = $this->input->get();

        $tipe = array();

        // PERMISSION FILTER
        $perm = PERM_ADM;
        if (!empty($get["perm"])) {
            $perm = $get["perm"];
        }

        if ($this->group == PERM_ASISTEN or $this->group == PERM_SEKDA or $this->group == PERM_WALIKOTA) {
            $status = array(1, 2);
        }
        // PERMISSION FILTER

        // FILTER STATUS
        $status = "a";
        if (isset($get["status"])) {
            if ($get["status"] != "undefined") {
                $status = $get["status"];
            }
        }
        // FILTER STATUS

        // FILTER USER/GROUP
        $all = 0;
        if ($this->group != PERM_SKPD) {
            $all = 1;
        }

        if (isset($get["opd"])) {
            $all = $get["opd"];
        }
        // FILTER USER/GROUP

        // DATA FOR DATATABLE
        $search = $post['search']['value'];
        $limit = $post['length'];
        $start = $post['start'];
        $order_index = $post['order'][0]['column'];
        $order_field = $post['columns'][$order_index]['data'];
        $order_ascdesc = $post['order'][0]['dir'];

        $total = $this->pen_model->count_all_ajax($all, $perm, $tipe, $status, true);
        $data = $this->pen_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $all, $perm, $tipe, $status, true);
        $filter = $this->pen_model->count_filter_ajax($search, $all, $perm, $tipe, $status, true);
        // DATA FOR DATATABLE

        // IMPLEMENT DATA
        $no = 1;
        $pengajuan = array();
        foreach ($data as $key => $val) {
            $judul = "<span class='view-jumlah' data-toggle='modal' data-target='#modal_view_jumlah' data-prokum='" . $val["jumlah_prokum_before"] . "' data-proses='" . $val["jumlah_proses"] . "' data-kembali='" . $val["jumlah_kembali"] . "' style='cursor: pointer;'>";
            $judul .= $val["judul"];
            $judul .= " <small><strong>";

            $judul .= "(<span class='text-primary'>" . $val["jumlah_prokum_before"] . "</span>";
            $judul .= "/<span class='text-success'>" . $val["jumlah_proses"] . "</span>";
            $judul .= "/<span class='text-danger'>" . $val["jumlah_kembali"] . "</span>)";

            $judul .= "</strong></small></span>";

            $data = array(
                "id" => $no,
                "judul" => $judul,
                "nama" => "<center>" . $val["nama"] . "</center>",
                "jabatan" => "<center>" . $val["jabatan"] . "</center>",
            );

            $data["opd"] = "<center>" . $val["user_full_name"] . "</center>";

            // INITIATE STATUS
            $status = "";
            if ($val["status"] == PENGAJUAN_MASUK) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' data-id='" . $val["id"] . "'>Usulan Masuk</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_PROSES) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Proses Kasubbag</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_TERIMA) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Proses Kasubbag</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_KEMBALI) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-danger reject' style='cursor: pointer;' data-id='" . $val["id"] . "' data-toggle='tooltip' data-placement='top' title='Klik untuk melihat Keterangan Pengembalian'>Usulan Dikembalikan</span>
                ";
            } elseif ($val["status"] == PENGAJUAN_TERUS) {
                $status = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Disposisi Kabag</span>
                ";
            }

            $data["status"] = $status;
            // INITIATE STATUS

            $pengajuan[] = $data;

            $no++;
        }

        $result = array(
            'draw' => $post['draw'], // Ini dari datatablenya
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $pengajuan,
        );
        // IMPLEMENT DATA

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function tambah()
    {
        $post = $this->input->post();
        if (!empty($post)) {
            $this->load->library('upload');

            $error = 0;
            $error_messages = array();

            $file_word = array();
            $file_excel = array();
            $file_tambahan = array();
            if (!empty($_FILES)) {
                $save = $post;

                $files = $_FILES;
                $cpt = count($_FILES["file"]["name"]);

                $word_count = 0;
                $excel_count = 0;
                $pdf_count = 0;
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES["file"]["name"] = $files["file"]["name"][$i];
                    $_FILES["file"]["type"] = $files["file"]["type"][$i];
                    $_FILES["file"]["tmp_name"] = $files["file"]["tmp_name"][$i];
                    $_FILES["file"]["error"] = $files["file"]["error"][$i];
                    $_FILES["file"]["size"] = $files["file"]["size"][$i];

                    $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    if ($file_ext == "docx")
                        $word_count++;
                    elseif ($file_ext == "xlsx")
                        $excel_count++;
                    elseif ($file_ext == "pdf")
                        $pdf_count++;

                    $config = array();
                    $config["upload_path"]      = "./uploads/PENGAJUAN_PROKUM";
                    $config["allowed_types"]    = "pdf|docx|xlsx";
                    $config["overwrite"]        = FALSE;
                    $config["file_type"]        = $files["file"]["type"][$i];
                    // $config["file_name"]        = $post["judul"];

                    if ($file_ext == "docx")
                        $config["file_name"]    = $post["judul"] . "_$word_count";
                    elseif ($file_ext == "xlsx")
                        $config["file_name"]    = $post["judul"] . "_$excel_count";
                    elseif ($file_ext == "pdf")
                        $config["file_name"]    = $post["judul"] . "_$pdf_count";

                    if (!empty($files["file"]["name"][$i])) {
                        if (!is_dir("uploads"))
                            mkdir("./uploads", 0777, true);

                        if (!is_dir("uploads/PENGAJUAN_PROKUM"))
                            mkdir("./uploads/PENGAJUAN_PROKUM", 0777, true);

                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload("file")) {
                            $error++;

                            $error_messages[] = array(
                                "error" => $this->upload->display_errors('<span>', '</span>')
                            );
                        } else {
                            $data = $this->upload->data();
                            if ($data["file_ext"] == ".docx") {
                                $file_word[] = $data["file_name"];
                            } elseif ($data["file_ext"] == ".xlsx") {
                                $file_excel[] = $data["file_name"];
                            } elseif ($data["file_ext"] == ".pdf") {
                                $file_tambahan[] = $data["file_name"];
                            }
                        }
                    }
                }
            }

            $save["file_word"] = "";
            $save["file_excel"] = "";
            $save["file_tambahan"] = "";

            foreach ($file_word as $val) {
                $save["file_word"] .= $val . "!!!";
            }

            foreach ($file_excel as $val) {
                $save["file_excel"] .= $val . "!!!";
            }

            foreach ($file_tambahan as $val) {
                $save["file_tambahan"] .= $val . "!!!";
            }

            // $this->print_out_data($error_messages);

            if ($error == 0) {
                echo $this->pen_model->save($save);
            } else {
                echo 2;
            }
        } else {
            $data["title"] = "Tambah Surat Pengajuan Produk Hukum";
            $data["_view"] = "pengajuan/tambah";
            $data["_js"] = "pengajuan/tambah_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function ubah()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($post)) {
            $this->load->library('upload');
            // $this->print_out_data($post);

            $error = 0;
            $error_messages = array();

            $file_word = array();
            $file_excel = array();
            $file_tambahan = array();

            $save = $post;
            $save["id"] = $get["pengajuan"];
            if (!empty($_FILES)) {
                $files = $_FILES;
                $cpt = count($_FILES["file"]["name"]);

                $word_count = 0;
                $excel_count = 0;
                $pdf_count = 0;
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES["file"]["name"] = $files["file"]["name"][$i];
                    $_FILES["file"]["type"] = $files["file"]["type"][$i];
                    $_FILES["file"]["tmp_name"] = $files["file"]["tmp_name"][$i];
                    $_FILES["file"]["error"] = $files["file"]["error"][$i];
                    $_FILES["file"]["size"] = $files["file"]["size"][$i];

                    $go = 0;
                    $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    foreach ($post["jenis_ganti"] as $key => $val) {
                        if (str_replace(".", "", $val) == $file_ext) {
                            if ($post["status_ganti"][$key] == "1") {
                                $go = 1;
                            }
                        }
                    }

                    if ($file_ext == "docx")
                        $word_count++;
                    elseif ($file_ext == "xlsx")
                        $excel_count++;
                    elseif ($file_ext == "pdf")
                        $pdf_count++;

                    if ($go == 1) {
                        $config = array();
                        $config["upload_path"]      = "./uploads/PENGAJUAN_PROKUM";
                        $config["allowed_types"]    = "pdf|docx|xlsx";
                        $config["overwrite"]        = TRUE;
                        $config["file_type"]        = $files["file"]["type"][$i];

                        if ($file_ext == "docx")
                            $config["file_name"]    = $post["judul"] . "_$word_count";
                        elseif ($file_ext == "xlsx")
                            $config["file_name"]    = $post["judul"] . "_$excel_count";
                        elseif ($file_ext == "pdf")
                            $config["file_name"]    = $post["judul"] . "_$pdf_count";

                        if (!empty($files["file"]["name"][$i])) {
                            if (!is_dir("uploads"))
                                mkdir("./uploads", 0777, true);

                            if (!is_dir("uploads/PENGAJUAN_PROKUM"))
                                mkdir("./uploads/PENGAJUAN_PROKUM", 0777, true);

                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload("file")) {
                                $error++;

                                $error_messages[] = array(
                                    "error" => $this->upload->display_errors('<span>', '</span>')
                                );
                            } else {
                                $data = $this->upload->data();
                                if ($data["file_ext"] == ".docx") {
                                    $file_word[] = $data["file_name"];
                                } elseif ($data["file_ext"] == ".xlsx") {
                                    $file_excel[] = $data["file_name"];
                                } elseif ($data["file_ext"] == ".pdf") {
                                    $file_tambahan[] = $data["file_name"];
                                }
                            }
                        }
                    }
                }
            }

            $save["file_word"] = "";
            $save["file_excel"] = "";
            $save["file_tambahan"] = "";

            foreach ($file_word as $val) {
                $save["file_word"] .= $val . "!!!";
            }

            foreach ($file_excel as $val) {
                $save["file_excel"] .= $val . "!!!";
            }

            foreach ($file_tambahan as $val) {
                $save["file_tambahan"] .= $val . "!!!";
            }

            // $this->print_out_data($save);

            if ($error == 0) {
                $save["id"] = $get["pengajuan"];
                echo $this->pen_model->update($save, true);
            } else {
                echo 2;
            }
        } else {
            $data = $this->pen_model->pengajuan_byid($get["pengajuan"]);

            $data["data"] = $data;
            $data["title"] = "Ubah Surat Pengajuan Produk Hukum <small>(" . $data["judul"] . ")</small>";
            $data["_view"] = "pengajuan/ubah";
            $data["_js"] = "pengajuan/ubah_js";

            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function detail()
    {
        $get = $this->input->get();
        $data = $this->pen_model->pengajuan_byid($get["pengajuan"]);

        $data["data"] = $data;
        $data["title"] = "Detail Surat Pengajuan Produk Hukum";
        $data["_view"] = "pengajuan/lihat";
        $data["_js"] = "pengajuan/lihat_js";

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function get_detail_bypengajuan()
    {
        $get = $this->input->get();
        $data = $this->pen_model->pengajuan_byid($get["pengajuan"]);

        echo json_encode($data);
    }

    public function hapus()
    {
        $get = $this->input->get();
        $result = $this->pen_model->delete($get["pengajuan"]);

        echo $result;
    }

    public function pengajuan_byid()
    {
        $get = $this->input->get();
        $result = $this->pen_model->pengajuan_byid($get["pengajuan"]);

        echo json_encode($result);
    }

    public function verification()
    {
        $get = $this->input->get();
        $save = array(
            "id" => $get["pengajuan"],
            "status" => $get["status"],
            "keterangan" => $get["keterangan"],
        );

        echo $this->pen_model->update($save, false);
    }

    public function pengajuan_counter()
    {
        $get = $this->input->get();
        $result = $this->counter($get["name"]);

        $this->print_out_data($result);
    }

    public function assign()
    {
        $get = $this->input->get();
        echo $this->pen_model->assign($get["pengajuan"]);
    }

    // PENYUSUNAN
    public function penyusunan()
    {
        $get = $this->input->get();
        $post = $this->input->post();
        if (!empty($post)) {
            $this->load->library('upload');

            $error = 0;
            $error_messages = array();

            $save = $post;

            $files = $_FILES;
            $cpt = count($_FILES["file"]["name"]);

            $file_keterangan = array();
            for ($i = 0; $i < $cpt; $i++) {
                if (!empty($files["file"]["name"][$i])) {
                    $_FILES["file"]["name"] = $files["file"]["name"][$i];
                    $_FILES["file"]["type"] = $files["file"]["type"][$i];
                    $_FILES["file"]["tmp_name"] = $files["file"]["tmp_name"][$i];
                    $_FILES["file"]["error"] = $files["file"]["error"][$i];
                    $_FILES["file"]["size"] = $files["file"]["size"][$i];

                    $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

                    $config = array();
                    $config["upload_path"]      = "./uploads/PENGEMBALIAN_PENYUSUNAN";
                    $config["allowed_types"]    = "pdf";
                    $config["overwrite"]        = FALSE;
                    $config["file_type"]        = $files["file"]["type"][$i];

                    $config["file_name"]        = $save["judul"][$i];

                    if (!is_dir("uploads"))
                        mkdir("./uploads", 0777, true);

                    if (!is_dir("uploads/PENGEMBALIAN_PENYUSUNAN"))
                        mkdir("./uploads/PENGEMBALIAN_PENYUSUNAN", 0777, true);

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("file")) {
                        $error++;

                        $error_messages[] = array(
                            "error" => $this->upload->display_errors('<span>', '</span>')
                        );
                    } else {
                        $data = $this->upload->data();

                        $file_keterangan[$i] = $data["file_name"];
                    }
                } else {
                    $file_keterangan[$i] = "";
                }
            }

            if ($error == 0) {
                foreach ($post["judul"] as $key => $val) {
                    $post["file_keterangan"][$key] = $file_keterangan[$key];
                }

                $result = $this->pey_model->save_penyusunan($get["pengajuan"], $post);
            }

            echo $result;
        } else {
            $pengajuan = $this->pen_model->pengajuan_byid($get["pengajuan"]);
            $disposisi = $this->dis_model->get_disposisi_bypengajuan($get["pengajuan"]);
            $data["pengajuan"] = $pengajuan;
            $data["disposisi"] = $disposisi;

            $data["title"] = "Penyusunan Produk Hukum <small>(" . $pengajuan["judul"] . ")</small>";
            $data["_view"] = "pengajuan/susun";
            $data["_js"] = "pengajuan/susun_js";

            // $this->print_out_data($data);
            $this->show_layout($data, LAYOUT_DASHBOARD);
        }
    }

    public function penyusunan_list()
    {
        $get = $this->input->get();
        $title = "Progress Penyusunan Produk Hukum";

        $pengajuan = "";
        if ($get["pengajuan"] != "a") {
            $pengajuan = $this->pen_model->pengajuan_byid($get["pengajuan"]);
        } else {
            $pengajuan = "a";

            if ($this->group != PERM_SKPD) {
                $data["opd"] = $this->pen_model->get_user_opd();
            }
        }

        $paraf = 0;
        if (isset($get["paraf"])) {
            $paraf = $get["paraf"];

            $title = "Progress Paraf/Tanda Tangan Produk Hukum";
        }

        if (in_array($this->group, array(PERM_KABAG, PERM_ASISTEN, PERM_SEKDA, PERM_WALIKOTA))) {
            $title = "Lembar Paraf Penyusunan Produk Hukum";
        }

        $disposisi = $this->dis_model->get_disposisi_bypengajuan($get["pengajuan"]);
        $data["disposisi"] = $disposisi;
        $data["pengajuan"] = $pengajuan;

        $data["paraf"] = $paraf;

        $data["title"] = $title;
        $data["_view"] = "penyusunan/index";
        $data["_js"] = "penyusunan/index_js";

        // $this->print_out_data($data);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function penyusunan_ajax()
    {
        $post = $this->input->post();
        $get = $this->input->get();

        $search = $post['search']['value'];
        $limit = $post['length'];
        $start = $post['start'];
        $order_index = $post['order'][0]['column'];
        $order_field = $post['columns'][$order_index]['data'];
        $order_ascdesc = $post['order'][0]['dir'];

        // OPD FILTER
        $all = 0;
        if ($this->group == PERM_SKPD) {
            $all = $this->user_id;
        }

        if (isset($get["opd"])) {
            $all = $get["opd"];
        }
        // OPD FILTER

        // PENGAJUAN FILTER
        $pengajuan = "a";
        if (isset($get["pengajuan"])) {
            $pengajuan = $get["pengajuan"];
        }
        // PENGAJUAN FILTER

        // STATUS FILTER
        $status = "a";
        if (isset($get["status"])) {
            if ($get["status"] != "undefined") {
                $status = $get["status"];
            }
        }
        // STATUS FILTER

        // PARAF FILTER
        $paraf = 0;
        if (isset($get["paraf"])) {
            $paraf = $get["paraf"];
        }
        // PARAF FILTER

        $total = $this->pey_model->count_all_ajax($pengajuan, $all, $status, $paraf);
        $data = $this->pey_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $pengajuan, $all, $status, $paraf);
        $filter = $this->pey_model->count_filter_ajax($search, $pengajuan, $all, $status, $paraf);

        $no = 1;
        $penyusunan = array();
        foreach ($data as $key => $val) {
            $data = array(
                "id" => $no,
                "nomor_urut" => "<center>" . $val["nomor_urut"] . "</center>",
                "judul" => $val["judul"],
            );

            if ($pengajuan == "a") {
                $data["pengajuan_nama"] = "<center>" . $val["pengajuan_nama"] . "</center>";
                $data["user_full_name"] = "<center>" . $val["user_full_name"] . "</center>";
            }

            // SETTING STATUS
            $disabled = ($val["is_ready"] or $val["status"] == PENYUSUNAN_SIAP) ? "disabled" : "";
            $tooltip_status = "data-toggle='tooltip' data-placement='top' title='Klik untuk melihat Keterangan terkait.'";
            $status = "";
            if ($val["status"] == PENYUSUNAN_DRAFT) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Proses Kasubbag</span>
                ";
            } elseif ($val["status"] == PENYUSUNAN_PROSES) {
                $text_paraf = "Menunggu Paraf Kabag";
                if ($val["is_kabag"]) {
                    $text_paraf = "Menunggu Paraf Asisten";
                }

                if ($val["is_asisten"]) {
                    $text_paraf = "Menunggu Paraf/Tandatangan Sekda";
                }

                if ($val["is_sekda"]) {
                    $text_paraf = "Menunggu Tandatangan Walikota";
                }

                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-warning' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "'>$text_paraf</span>
                ";
            } elseif ($val["status"] == PENYUSUNAN_KEMBALI) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-danger status-back' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "' data-file='" . $val["file_keterangan"] . "'>Prokum Usulan Dikembalikan</span>
                ";
            } elseif ($val["status"] == PENYUSUNAN_SIAP) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "'>Menunggu Prokum Siap Diambil</span>
                ";
            }

            if ($val["is_ready"] and !empty($val["nomor_prokum"])) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "'>Prokum Siap Diambil</span>
                ";
            } elseif ($val["is_ready"]) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "'>Menunggu Prokum Siap Diambil</span>
                ";
            }
            // SETTING STATUS

            // STANDARD ACTION
            $view_btn = "
                <button type='button' class='btn btn-primary btn-xs view' data-toggle='modal' data-target='#modal_view' data-id='" . $val["id"] . "' data-urut='" . $val["nomor_urut"] . "' data-judul='" . $val["judul"] . "' data-status='" . $val["status"] . "' data-keterangan='" . $val["keterangan"] . "' data-file='" . $val["file_keterangan"] . "' data-pengajuan='" . $val["pengajuan_id"] . "' data-otoritas='" . PERM_KABAG . "'>
                    <i class='far fa-eye'></i>
                </button>
            ";

            if ($val["status"] == PENYUSUNAN_PROSES) $disabled = "disabled";
            $edit_btn = "
                <button type='button' class='btn btn-xs btn-warning edit' data-toggle='modal' data-target='#modal_edit' data-backdrop='static' data-keyboard='false' data-id='" . $val["id"] . "' data-urut='" . $val["nomor_urut"] . "' data-judul='" . $val["judul"] . "' data-status='" . $val["status"] . "' data-keterangan='" . $val["keterangan"] . "' $disabled>
                  <i class='fas fa-pencil-alt' data-toggle='tooltip' data-placement='top' title='Ubah Produk Hukum " . $val["judul"] . "'></i>
                </button>
            ";

            $delete_btn = "
                <button type='button' class='btn btn-xs btn-danger delete' data-id='" . $val["id"] . "' data-judul='" . $val["judul"] . "' data-toggle='tooltip' data-placement='top' title='Hapus Pengajuan " . $val["judul"] . "' style='padding: 2px 6px;' $disabled>
                    <i class='fas fa-trash'></i>
                </button>
            ";
            // STANDARD ACTION

            // PARAF/TTD ACTION
            $icon = "fas fa-highlighter";
            if ($val["is_ready"]) $icon = "fas fa-search";
            $paraf_btn = "
                <button type='button' class='btn btn-xs bg-purple paraf' data-toggle='modal' data-target='#modal_paraf' data-backdrop='static' data-keyboard='false' data-id='" . $val["id"] . "' data-urut='" . $val["nomor_urut"] . "' data-judul='" . $val["judul"] . "' data-kabag='" . $val["is_kabag"] . "' data-asisten='" . $val["is_asisten"] . "' data-sekda='" . $val["is_sekda"] . "' data-walikota='" . $val["is_walikota"] . "' data-ready='" . $val["is_ready"] . "' data-nomor='" . $val["nomor_prokum"] . "' data-file='" . $val["file_prokum"] . "' data-pengajuan='" . $val["pengajuan_id"] . "' data-status='" . $val["status"] . "'>
                    <i class='$icon' data-toggle='tooltip' data-placement='top' title='Paraf/Tanda Tangani Produk Hukum " . $val["judul"] . "'></i>
                </button>
            ";

            $paraf_self_btn = "
                <button type='button' class='btn btn-xs bg-purple paraf-self' data-toggle='modal' data-target='#modal_paraf_self' data-backdrop='static' data-keyboard='false' data-id='" . $val["id"] . "' data-urut='" . $val["nomor_urut"] . "' data-judul='" . $val["judul"] . "' data-kabag='" . $val["is_kabag"] . "' data-asisten='" . $val["is_asisten"] . "' data-sekda='" . $val["is_sekda"] . "' data-walikota='" . $val["is_walikota"] . "' data-ready='" . $val["is_ready"] . "' data-nomor='" . $val["nomor_prokum"] . "' data-otoritas='" . $this->group . "' data-pengajuan='" . $val["pengajuan_id"] . "'>
                    <i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='Paraf/Tanda Tangani Produk Hukum " . $val["judul"] . "'></i>
                </button>
            ";
            // PARAF/TTD ACTION

            // IMPLEMENTASI TOMBOL AKSI
            $aksi = $view_btn;
            // TOMBOL CRUD
            if (
                ($this->group == PERM_PERUNDANGAN
                    or $this->group == PERM_BANKUM
                    or $this->group == PERM_DOKUM)
                and ($val["status"] == PENYUSUNAN_DRAFT
                    or $val["status"] == PENYUSUNAN_KEMBALI)
            ) {
                $aksi .=  $edit_btn . $delete_btn;
            }

            // TOMBOL PARAF
            if (($this->group == PERM_PERUNDANGAN
                    or $this->group == PERM_BANKUM
                    or $this->group == PERM_DOKUM)
                and ($val["status"] == PENYUSUNAN_PROSES
                    or $val["status"] == PENYUSUNAN_SIAP)
                and $val["is_kabag"]
            ) {
                $aksi .= $paraf_btn;
            }

            // PARAF PER BAGIAN
            if (
                (!$val["is_kabag"] and !$val["is_asisten"] and !$val["is_sekda"] and !$val["is_walikota"])
                and $this->group == PERM_KABAG
                and $val["status"] == PENYUSUNAN_PROSES
            ) {
                $aksi .= $paraf_self_btn;
            } elseif (
                ($val["is_kabag"] and !$val["is_asisten"] and !$val["is_sekda"] and !$val["is_walikota"])
                and $this->group == PERM_ASISTEN
                and $val["status"] == PENYUSUNAN_PROSES
            ) {
                $aksi .= $paraf_self_btn;
            } elseif (
                ($val["is_kabag"] and !$val["is_sekda"] and !$val["is_walikota"])
                and $this->group == PERM_SEKDA
                and $val["status"] == PENYUSUNAN_PROSES
            ) {
                $aksi .= $paraf_self_btn;
            } elseif (
                ($val["is_kabag"] and !$val["is_walikota"])
                and $this->group == PERM_WALIKOTA
                and $val["status"] == PENYUSUNAN_PROSES
                and !$val["is_ready"]
            ) {
                $aksi .= $paraf_self_btn;
            }

            $data["aksi"] = $aksi;
            // IMPLEMENTASI TOMBOL AKSI

            $penyusunan[] = $data;

            $no++;
        }

        $result = array(
            'draw' => $post['draw'], // Ini dari datatablenya
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $penyusunan,
        );

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function penyusunan_report_list()
    {
        $get = $this->input->get();
        $title = "Progress Penyusunan Produk Hukum";

        $pengajuan = "";
        if ($get["pengajuan"] != "a") {
            $pengajuan = $this->pen_model->pengajuan_byid($get["pengajuan"]);
        } else {
            $pengajuan = "a";

            if ($this->group != PERM_SKPD) {
                $data["opd"] = $this->pen_model->get_user_opd();
            }
        }

        $paraf = 0;
        if (isset($get["paraf"])) {
            $paraf = $get["paraf"];

            $title = "Progress Paraf/Tanda Tangan Produk Hukum";
        }

        $disposisi = $this->dis_model->get_disposisi_bypengajuan($get["pengajuan"]);
        $data["disposisi"] = $disposisi;
        $data["pengajuan"] = $pengajuan;

        $data["paraf"] = $paraf;

        $data["title"] = $title;
        $data["_view"] = "penyusunan/report";
        $data["_js"] = "penyusunan/report_js";

        // $this->print_out_data($data);
        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function penyusunan_report_ajax()
    {
        $post = $this->input->post();
        $get = $this->input->get();

        $search = $post['search']['value'];
        $limit = $post['length'];
        $start = $post['start'];
        $order_index = $post['order'][0]['column'];
        $order_field = $post['columns'][$order_index]['data'];
        $order_ascdesc = $post['order'][0]['dir'];

        // OPD FILTER
        $all = 0;
        if (isset($get["opd"])) {
            $all = $get["opd"];
        } elseif ($this->group == PERM_SKPD) {
            $all = $this->user_id;
        }
        // OPD FILTER

        // PENGAJUAN FILTER
        $pengajuan = "a";
        if (isset($get["pengajuan"])) {
            $pengajuan = $get["pengajuan"];
        }
        // PENGAJUAN FILTER

        // STATUS FILTER
        $status = "a";
        if (isset($get["status"])) {
            if ($get["status"] != "undefined") {
                $status = $get["status"];
            }
        }
        // STATUS FILTER

        // PARAF FILTER
        $paraf = 0;
        if (isset($get["paraf"])) {
            $paraf = $get["paraf"];
        }
        // PARAF FILTER

        $total = $this->pey_model->count_all_ajax($pengajuan, $all, $status, $paraf, true);
        $data = $this->pey_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc, $pengajuan, $all, $status, $paraf, true);
        $filter = $this->pey_model->count_filter_ajax($search, $pengajuan, $all, $status, $paraf, true);

        $no = 1;
        $penyusunan = array();
        foreach ($data as $key => $val) {
            $data = array(
                "id" => $no,
                "nomor_urut" => "<center>" . $val["nomor_urut"] . "</center>",
                "judul" => $val["judul"],
            );

            if ($pengajuan == "a") {
                $data["pengajuan_nama"] = "<center>" . $val["pengajuan_nama"] . "</center>";
                $data["user_full_name"] = "<center>" . $val["user_full_name"] . "</center>";
            }

            // SETTING STATUS
            $disabled = ($val["is_ready"] or $val["status"] == PENYUSUNAN_SIAP) ? "disabled" : "";
            $tooltip_status = "data-toggle='tooltip' data-placement='top' title='Klik untuk melihat Keterangan terkait.'";
            $status = "";
            if ($val["status"] == PENYUSUNAN_DRAFT) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' data-id='" . $val["id"] . "'>Menunggu Proses Kasubbag</span>
                ";
            } elseif ($val["status"] == PENYUSUNAN_PROSES) {
                $text_paraf = "Menunggu Paraf Kabag";
                if ($val["is_kabag"]) {
                    $text_paraf = "Menunggu Paraf Asisten";
                }

                if ($val["is_asisten"]) {
                    $text_paraf = "Menunggu Paraf/Tandatangan Sekda";
                }

                if ($val["is_sekda"]) {
                    $text_paraf = "Menunggu Tandatangan Walikota";
                }

                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-warning' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "'>$text_paraf</span>
                ";
            } elseif ($val["status"] == PENYUSUNAN_KEMBALI) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-danger status-back' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "' data-file='" . $val["file_keterangan"] . "'>Prokum Usulan Dikembalikan</span>
                ";
            } elseif ($val["status"] == PENYUSUNAN_SIAP) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "'>Menunggu Prokum Siap Diambil</span>
                ";
            }

            if ($val["is_ready"] and !empty($val["nomor_prokum"])) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-success' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "'>Prokum Siap Diambil</span>
                ";
            } elseif ($val["is_ready"]) {
                $data["status"] = "
                    <span class='btn btn-xs btn-block btn-outline-primary' style='cursor: pointer;' $tooltip_status data-id='" . $val["id"] . "' data-keterangan='" . $val["keterangan"] . "'>Menunggu Prokum Siap Diambil</span>
                ";
            }
            // SETTING STATUS

            // IMPLEMENTASI TOMBOL AKSI
            $view_btn = "
                <div class='btn-group'>
                    <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown'>
                        <i class='far fa-eye'></i>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item view' data-toggle='modal' data-target='#modal_view' data-id='" . $val["id"] . "' data-urut='" . $val["nomor_urut"] . "' data-judul='" . $val["judul"] . "' data-status='$status' data-keterangan='" . $val["keterangan"] . "' data-file='" . $val["file_keterangan"] . "' data-pengajuan='" . $val["pengajuan_id"] . "'>Lihat Detail</a>
                        <a class='dropdown-item lacak' data-id='" . $val["id"] . "'>Lihat Proses</a>
                    </div>
                </div>
            ";

            $aksi = $view_btn;
            $data["aksi"] = $aksi;
            // IMPLEMENTASI TOMBOL AKSI

            $penyusunan[] = $data;

            $no++;
        }

        $result = array(
            'draw' => $post['draw'], // Ini dari datatablenya
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $penyusunan,
        );

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function update_penyusunan()
    {
        $post = $this->input->post();
        $this->load->library('upload');

        $error = 0;
        $file_keterangan = "";

        $files = $_FILES;
        // $this->print_out_data($files);

        if (!empty($files["file"]["name"][0])) {
            $_FILES["file"]["name"] = $files["file"]["name"][0];
            $_FILES["file"]["type"] = $files["file"]["type"][0];
            $_FILES["file"]["tmp_name"] = $files["file"]["tmp_name"][0];
            $_FILES["file"]["error"] = $files["file"]["error"][0];
            $_FILES["file"]["size"] = $files["file"]["size"][0];

            $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            $config = array();
            $config["upload_path"]      = "./uploads/PENGEMBALIAN_PENYUSUNAN";
            $config["allowed_types"]    = "pdf";
            $config["overwrite"]        = FALSE;
            $config["file_type"]        = $files["file"]["type"];

            $config["file_name"]        = $post["judul"];

            if (!is_dir("uploads"))
                mkdir("./uploads", 0777, true);

            if (!is_dir("uploads/PENGEMBALIAN_PENYUSUNAN"))
                mkdir("./uploads/PENGEMBALIAN_PENYUSUNAN", 0777, true);

            $this->upload->initialize($config);
            if (!$this->upload->do_upload("file")) {
                $error++;

                $error_messages[] = array(
                    "error" => $this->upload->display_errors('<span>', '</span>')
                );
            } else {
                $data = $this->upload->data();

                $file_keterangan = $data["file_name"];
            }
        } else {
            $file_keterangan = "";
        }

        $post["file_keterangan"] = $file_keterangan;
        if ($error == 0) {
            $result = $this->pey_model->update_penyusunan($post);
        }

        echo $result;
    }

    public function delete_penyusunan()
    {
        $get = $this->input->get();
        $result = $this->pey_model->delete_penyusunan($get["penyusunan"]);

        echo $result;
    }

    public function pengajuan_paraf()
    {
        $get = $this->input->get();
        $result = $this->pey_model->pengajuan_paraf($get["penyusunan"]);

        echo $result;
    }

    public function paraf_penyusunan()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if (!empty($get)) {
            $post = array(
                "penyusunan" => $get["penyusunan"],
                "paraf" => $get["paraf"],
                "ready" => false,
            );
        }

        if (isset($get["ttd"])) {
            $post["ttd"] = $get["ttd"];
        }

        $result = $this->pey_model->paraf_penyusunan($post);

        echo $result;
    }

    public function nomor_prokum()
    {
        $post = $this->input->post();
        $this->load->library('upload');

        $error = 0;
        $file_keterangan = "";

        $files = $_FILES;
        // $this->print_out_data($files);

        if (!empty($files["file"]["name"][0])) {
            $_FILES["file"]["name"] = $files["file"]["name"][0];
            $_FILES["file"]["type"] = $files["file"]["type"][0];
            $_FILES["file"]["tmp_name"] = $files["file"]["tmp_name"][0];
            $_FILES["file"]["error"] = $files["file"]["error"][0];
            $_FILES["file"]["size"] = $files["file"]["size"][0];

            $file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            $config = array();
            $config["upload_path"]      = "./uploads/PROKUM_DRAFT";
            $config["allowed_types"]    = "pdf";
            $config["overwrite"]        = FALSE;
            $config["file_type"]        = $files["file"]["type"];

            $config["file_name"]        = $post["produk_hukum"];

            if (!is_dir("uploads"))
                mkdir("./uploads", 0777, true);

            if (!is_dir("uploads/PROKUM_DRAFT"))
                mkdir("./uploads/PROKUM_DRAFT", 0777, true);

            $this->upload->initialize($config);
            if (!$this->upload->do_upload("file")) {
                $error++;

                $error_messages[] = array(
                    "error" => $this->upload->display_errors('<span>', '</span>')
                );
            } else {
                $data = $this->upload->data();

                $file_keterangan = $data["file_name"];
            }
        } else {
            $file_keterangan = "";
        }

        $post["file_produk"] = $file_keterangan;
        if ($error === 0) {
            $result = $this->pey_model->nomor_prokum($post);
        }

        echo $result;
    }

    public function ready_prokum()
    {
        $get = $this->input->get();

        $result = $this->pey_model->ready_prokum($get["penyusunan"]);
        echo $result;
    }


    public function pelacakan()
    {
        $get = $this->input->get();
        $result = $this->pey_model->timeline($get["penyusunan"]);

        $data["data"] = $result;
        $data["title"] = "Lacak Pengajuan Produk Hukum <small>(" . $result["penyusunan"]["judul"] . ")</small>";
        $data["_view"] = "penyusunan/timeline";
        $data["_js"] = "penyusunan/timeline_js";

        // $this->print_out_data($data);

        $this->show_layout($data, LAYOUT_DASHBOARD);
    }

    public function save_disposisi()
    {
        $post = $this->input->post();
        $result = $this->dis_model->save($post);

        echo $result;
    }

    public function get_disposisi_byid()
    {
        $get = $this->input->get();
        $result = $this->dis_model->get_disposisi_byid($get["disposisi"]);

        echo json_encode($result);
    }
}
