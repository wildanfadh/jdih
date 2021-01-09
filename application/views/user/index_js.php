<script>
    $(document).ready(function() {
        $("#tab_user").DataTable({
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?php echo base_url("User/index_ajax"); ?>",
                "type": "POST"
            },
            "deferRender": true,
            "columns": [{
                    "data": "user_id"
                },
                {
                    "data": "user_username"
                },
                {
                    "data": "user_email"
                },
                {
                    "data": "user_full_name"
                },
                {
                    "data": "group_description"
                },
                {
                    "data": "aksi"
                },
            ],
        });

        $("#tam_save").click(function(event) {
            event.preventDefault();

            var check = [
                "tam_username",
                "tam_password",
                "tam_email",
                "tam_phone",
                "tam_fullname",
                "tam_group",
            ];

            if (checkThis(check) == 0) {
                $("#tam_form").submit();
            }
        });

        $("#tam_form").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#tam_form")[0]);

            $.ajax({
                url: "<?php echo base_url("User/tambah"); ?>",
                type: "post",
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 0) {
                        Swal.fire(
                            'Gagal!',
                            'User gagal ditambahakan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'User berhasil ditambahakan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        });

        $(document).on("click", ".view", function() {
            var username = $(this).data("username");
            var email = $(this).data("email");
            var phone = $(this).data("phone");
            var fullname = $(this).data("fullname");
            var group = $(this).data("group");

            if (phone === "") phone = "-";

            $("#view_header").html(fullname);
            $("#view_username").html(username);
            $("#view_email").html(email);
            $("#view_phone").html(phone);
            $("#view_fullname").html(fullname);
            $("#view_group").html(group);
        });

        function selectElement(id, valueToSelect) {
            let element = document.getElementById(id);
            element.value = valueToSelect;
        }

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");
            var username = $(this).data("username");
            var email = $(this).data("email");
            var phone = $(this).data("phone");
            var fullname = $(this).data("fullname");
            var group = $(this).data("groupid");

            if (phone === "") phone = "0";

            $("#edi_header").html(fullname);
            $("#edi_id").val(id);
            $("#edi_email").val(email);
            $("#edi_phone").val(phone);
            $("#edi_fullname").val(fullname);
            $("#edi_group").val(group);

            $("#edi_password").val("");
        });

        $("#edi_save").click(function(event) {
            event.preventDefault();

            var check = [
                "edi_email",
                "edi_phone",
                "edi_fullname",
                "edi_group",
            ];

            if (checkThis(check) == 0) {
                $("#edi_form").submit();
            }
        });

        $("#edi_form").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#edi_form")[0]);

            $.ajax({
                url: "<?php echo base_url("User/ubah"); ?>",
                type: "post",
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 1) {
                        Swal.fire(
                            'Sukses!',
                            'Perubahan User berhasil disimpan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Perubahan User gagal disimpan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        });

        $(document).on("click", ".delete", function() {
            var user = $(this).data("id");
            var fullname = $(this).data("fullname");

            Swal.fire({
                title: 'Nonaktifkan User ' + fullname + '?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Nonaktifkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#007bff",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?php echo base_url("User/nonactive?user="); ?>" + user,
                        type: "get",
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == 1) {
                                Swal.fire(
                                    'Sukses!',
                                    'User berhasil dinonaktifkan.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'User gagal dinonaktifkan.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>