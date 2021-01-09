<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends WH_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model("User_model", "use_model");
    }

    public function index()
    {
        $data["title"] = "Daftar User";
        $data["_view"] = "user/index";
        $data["_js"] = "user/index_js";

        $this->ion_model->order_by("description", "asc");
        $data["group_list"] = $this->ion_model->groups()->result_array();

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

        $total = $this->use_model->count_all_ajax();
        $data = $this->use_model->filter_ajax($search, $limit, $start, $order_field, $order_ascdesc);
        $filter = $this->use_model->count_filter_ajax($search);

        $no = 1;
        $users = array();
        foreach ($data as $key => $val) {
            $data = array(
                "user_id" => $val["user_id"],
                "user_username" => $val["user_username"],
                "user_email" => $val["user_email"],
                "user_full_name" => $val["user_full_name"],
                "group_description" => $val["group_description"],
            );

            $disabled = "";
            if ($val["group_id"] == PERM_ADM) $disabled = "disabled";

            $view_btn = "
                <button type='button' $disabled class='btn btn-xs btn-info view' data-toggle='modal' data-target='#modal_view' data-backdrop='static' data-keyboard='false' data-id='" . $val["user_id"] . "' data-username='" . $val["user_username"] . "' data-email='" . $val["user_email"] . "' data-fullname='" . $val["user_full_name"] . "' data-group='" . $val["group_description"] . "' data-phone='" . $val["user_phone"] . "'>
                    <i class='far fa-eye' data-toggle='tooltip' data-placement='top' title='Lihat User " . $val["user_full_name"] . "'></i>
                </button>
            ";

            $edit_btn = "
                <button type='button' $disabled class='btn btn-xs btn-warning edit' data-toggle='modal' data-target='#modal_edit' data-backdrop='static' data-keyboard='false' data-id='" . $val["user_id"] . "' data-username='" . $val["user_username"] . "' data-email='" . $val["user_email"] . "' data-fullname='" . $val["user_full_name"] . "' data-group='" . $val["group_description"] . "' data-phone='" . $val["user_phone"] . "' data-groupid='" . $val["group_id"] . "'>
                    <i class='fas fa-pencil-alt' data-toggle='tooltip' data-placement='top' title='Ubah User " . $val["user_full_name"] . "'></i>
                </button>
            ";

            $delete_btn = "
                <button type='button' $disabled class='btn btn-xs btn-danger delete' data-id='" . $val["user_id"] . "' data-fullname='" . $val["user_full_name"] . "' style='padding: 2px 6px;'>
                    <i class='fas fa-trash'data-toggle='tooltip' data-placement='top' title='Hapus User " . $val["user_full_name"] . "'></i>
                </button>
            ";

            $aksi = $view_btn . $edit_btn . $delete_btn;
            $data["aksi"] = $aksi;

            $users[] = $data;
            $no++;
        }

        $result = array(
            'draw' => $post['draw'],
            'recordsTotal' => $total,
            'recordsFiltered' => $filter,
            'data' => $users,
        );

        // $this->print_out_data($result);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function tambah()
    {
        $post = $this->input->post();

        $username = $post["username"];
        $password = $post["password"];
        $email = $post["email"];
        $fullname = $post["full_name"];
        $phone = $post["phone"];
        $group = array($post["group"]);

        $additional_data = array(
            "full_name" => $fullname,
            "username" => $username,
            "phone" => $phone,
        );

        $user = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
        echo $user;
    }

    public function ubah()
    {
        $post = $this->input->post();
        // $this->print_out_data($post);

        $id = $post["user"];

        $additional_data = array(
            "full_name" => $post["full_name"],
            "email" => $post["email"],
            "phone" => $post["phone"],
        );

        if (!empty($post["password"]))
            $additional_data["password"] = $post["password"];

        // $this->print_out_data($additional_data);

        $good = true;
        $result = $this->ion_auth->update($id, $additional_data);
        if ($result) {
            $this->ion_auth->remove_from_group("", $id);
            $result = $this->ion_auth->add_to_group(array($post["group"]), $id);

            if (!$result)
                $good = false;
        } else {
            $good = false;
        }

        if ($good) echo 1;
        else echo 0;
    }

    public function nonactive()
    {
        $get = $this->input->get();
        $result = $this->use_model->nonactive($get["user"]);

        echo $result;
    }
}
