<script>
    $(document).ready(function() {
        $("#tab_pengajuan").DataTable({
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
                "url": "<?php echo base_url("Pengajuan/penyusunan_ajax?pengajuan=" . $data["id"]); ?>",
                "type": "POST"
            },
            "deferRender": true,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nomor_urut"
                },
                {
                    "data": "judul"
                },
                {
                    "data": "status"
                },
                {
                    "data": "disposisi"
                },
                {
                    "data": "aksi"
                },
            ],
        });

        $("#tambah_pengajuan").click(function() {
            window.location.href = "<?php echo base_url("Pengajuan/tambah") ?>";
        });

        function getMessage(id, get, text) {
            if (get) {
                $.ajax({
                    url: "<?php echo base_url("Pengajuan/pengajuan_byid?pengajuan="); ?>" + id,
                    type: "get",
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $(".loading").hide();

                        data = JSON.parse(data);

                        var text = "";
                        if (data.keterangan !== null && data.keterangan != "") {
                            text = "<h5>" + data.keterangan + "</h5>";
                        } else {
                            text = "<h5>Tidak ada keterangan.</h5>";
                        }

                        Swal.fire({
                            html: text,
                            showConfirmButton: false,
                            showCancelButton: false,
                        });
                    }
                });
            } else {
                Swal.fire({
                    html: text,
                    showConfirmButton: false,
                    showCancelButton: false,
                });
            }
        }

        $(document).on("click", ".status", function() {
            var text = "<h5>" + $(this).data("keterangan") + "</h5>";

            getMessage(null, false, text);
        });

        $(document).on("click", ".edit", function() {
            $(".em-error").hide();
            $(".form-control").removeClass("is-invalid");

            var id = $(this).data("id");
            var urut = $(this).data("urut");
            var judul = $(this).data("judul");
            var status = $(this).data("status");
            var keterangan = $(this).data("keterangan");

            $("#mod_id").val(id);
            $("#mod_ubah_header").html(urut);
            $("#mod_judul").val(judul);
            $("#mod_status").val(status);
            $("#mod_keterangan").val(keterangan);
        });

        $(document).on("click", ".view", function() {
            var urut = $(this).data("urut");
            var judul = $(this).data("judul");
            var status = $(this).data("status");
            var keterangan = $(this).data("keterangan");

            $("#view_header").html(urut);
            $("#view_judul").html(judul);
            $("#view_status").html(status);
            $("#view_keterangan").html(keterangan);
        });

        $("#mod_simpan").click(function(event) {
            event.preventDefault();

            var check = ["mod_judul", "mod_status", "mod_keterangan"];
            if (checkThis(check) == 0) {
                $("#mod_ubah").submit();
            } else {
                directView();
            }
        });

        $("#mod_ubah").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#mod_ubah")[0]);

            $.ajax({
                url: "<?php echo base_url("Pengajuan/update_penyusunan"); ?>",
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
                            'Penyusunan berhasil disimpan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Penyusunan gagal disimpan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            var judul = $(this).data("judul");
            var url = "<?php echo base_url("Pengajuan/delete_penyusunan?penyusunan=") ?>" + id;

            Swal.fire({
                title: 'Hapus Data Penyusunan ' + judul + '?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#007bff",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == "1") {
                                Swal.fire(
                                    'Sukses!',
                                    'Hapus Data Penyusunan ' + judul + ' berhasil',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Hapus Data Penyusunan ' + judul + ' gagal',
                                    'error'
                                )
                            }
                        },
                    });
                }
            })
        });

        var isi = 0;
        $(document).on("click", ".disposisi", function() {
            var urut = $(this).data("urut");
            var penyusunan = $(this).data("penyusunan");
            var disposisi = $(this).data("disposisi");
            var last_to = $(this).data("lastto");

            $("#disposisi_status option[value='2']").attr("disabled", false);

            if (last_to == <?= DUM_ASISTEN; ?>) {
                last_to = "Asisten";
            } else if (last_to == <?= DUM_SEKDA; ?>) {
                last_to = "Sekertaris Daerah";
            } else if (last_to == <?= DUM_WALIKOTA; ?>) {
                last_to = "Wali Kota";
            } else {
                last_to = "Kabag. Hukum";
                $("#disposisi_status option[value='2']").attr("disabled", true);
            }

            $("#disposisi_header").html(urut);
            $("#disposisi_oleh").html(last_to);
            $("#disposisi_penyusunan").val(penyusunan);
            $("#disposisi_id").val(disposisi);
        });

        $(document).on("change", ".isi", function() {
            if (isi > 0) {
                if ($(this).prop("checked") === true) {
                    isi++;
                } else if ($(this).prop("checked") === false) {
                    isi--;
                }
            } else {
                if ($(this).prop("checked") === true) {
                    isi++;
                }
            }

            if (isi === 0) {
                $("#err_disposisi_isi").show();
            } else {
                $("#err_disposisi_isi").hide();
            }
        });

        $(document).on("change", "#disposisi_check_keterangan", function() {
            if ($(this).prop("checked") === true) {
                $("#div_keterangan").removeClass("hide");
            } else if ($(this).prop("checked") === false) {
                $("#div_keterangan").addClass("hide");
            }
        });

        $("#disposisi_simpan").click(function() {
            var check = ["disposisi_status", "disposisi_perihal"];
            if ($("#disposisi_check_keterangan").prop("checked") === true) {
                check.push("disposisi_keterangan");
            }

            if (isi === 0) {
                $("#err_disposisi_isi").show();
            } else {
                $("#err_disposisi_isi").hide();
            }

            if (checkThis(check) == 0 && isi > 0) {
                $("#disposisi_form").submit();
            }
        });

        $("#disposisi_form").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#disposisi_form")[0]);

            console.log(form_data);
            $.ajax({
                url: "<?php echo base_url("Pengajuan/save_disposisi"); ?>",
                type: "post",
                data: form_data,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                processData: false,
                contentType: false,
                success: function(data) {
                    $(".loading").hide();

                    // if (data == 1) {
                    //     Swal.fire(
                    //         'Sukses!',
                    //         'Pengajuan Produk Hukum telah ditambahkan.',
                    //         'success'
                    //     ).then((result) => {
                    //         window.location.href = "<?php echo base_url("Pengajuan"); ?>";
                    //     });
                    // } else if (data == 2) {
                    //     Swal.fire(
                    //         "Error!",
                    //         "Upload Pengajuan Produk gagal.",
                    //         "error"
                    //     );
                    // } else if (data == 0) {
                    //     Swal.fire(
                    //         "Error!",
                    //         "Pengajuan Produk Hukum gagal ditambahkan.",
                    //         "error"
                    //     );
                    // }
                }
            });
        })
    });
</script>