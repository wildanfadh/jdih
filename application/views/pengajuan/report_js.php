<script>
    $(document).ready(function() {
        var tipe = "";
        <?php foreach ($tipe as $val) { ?>
            tipe += "&tipe[]=<?= $val; ?>";
        <?php } ?>

        var tabel_url = "perm=<?= $perm; ?>" + tipe;
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
                "url": "<?php echo base_url("Pengajuan/report_ajax?"); ?>" + tabel_url,
                "type": "POST"
            },
            "deferRender": true,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "judul"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "jabatan"
                },
                <?php if ($perm != PERM_SKPD) { ?> {
                        "data": "opd"
                    },
                <?php } ?> {
                    "data": "status"
                },
            ],
        });

        $("#daftar_select").change(function() {
            var status = $(this).val();
            status = tabel_url + "&status=" + status;

            $("#tab_pengajuan").DataTable().ajax.url("<?= base_url("Pengajuan/report_ajax?"); ?>" + status).load();
        });

        $(document).on("click", ".view-pdf", function() {
            var file = $(this).data("file");

            $("#modal_pdf").modal("show");
            var path = "<?php echo base_url("uploads/PENGAJUAN_PROKUM"); ?>";

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(".close").click(function() {
            $("#modal_pdf").hide();
        });

        $(document).on("click", ".download", function(event) {
            event.preventDefault();
            var file = $(this).data("file");

            url = "<?php echo base_url("uploads/PENGAJUAN_PROKUM/"); ?>" + file;
            window.open(url, "_blank");
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

        $(document).on("click", ".in", function() {
            var text = "<h5>Pengajuan Produk Hukum sudah masuk.</h5>";

            getMessage(null, false, text);
        });

        $(document).on("click", ".process", function() {
            var text = "<h5>Pengajuan Produk Hukum sedang diproses.</h5>";

            getMessage(null, false, text);
        });

        $(document).on("click", ".accept", function() {
            var text = "<h5>Pengajuan Produk Hukum sudah diterima.</h5>";

            getMessage(null, false, text);
        });

        $(document).on("click", ".reject", function() {
            var id = $(this).data("id");

            getMessage(id, true, null);
        });

        $(document).on("click", ".edit", function() {
            var id = $(this).data("id");

            window.location.href = "<?php echo base_url("Pengajuan/ubah?pengajuan=") ?>" + id;
        });

        $(document).on("click", ".view", function() {
            var id = $(this).data("id");
            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + id;

            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    data = JSON.parse(data);
                    console.log(data);

                    $("#view_header").html(data.user_full_name);
                    $("#view_jenis").html(data.jenis_pengajuan_text);
                    $("#view_judul").html(data.judul);
                    $("#view_nama").html(data.nama);
                    $("#view_jabatan").html(data.jabatan);
                    $("#view_nomor").html(data.nomor_hp);
                    $("#view_jumlah").html(data.jumlah_prokum);

                    var surat = "";
                    var tambahan = "";
                    data.file_pengajuan_tambahan = data.file_pengajuan_tambahan.split("!!!");
                    $.each(data.file_pengajuan_tambahan, function(i, item) {

                        if (i === 0) {
                            surat = '<button class="btn btn-danger btn-xs view-pdf" data-file="' + item + '"> <i class="far fa-eye"></i> </button>';
                        } else if (i === 1) {
                            if (item !== "") {
                                tambahan = '<button class="btn btn-danger btn-xs view-pdf" data-file="' + item + '"> <i class="far fa-eye"></i> </button>';
                            } else {
                                tambahan = '<span>-</span>';
                            }
                        }

                    });
                    $("#view_surat_pengajuan").html(surat);
                    $("#view_surat_tambahan").html(tambahan);

                    var word = "";
                    data.file_pengajuan_word = data.file_pengajuan_word.split("!!!");
                    $.each(data.file_pengajuan_word, function(i, item) {

                        if (item !== "") {
                            i++;
                            word += '<button class="btn btn-primary btn-xs download" data-file="' + item + '" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word ' + i + '"> <i class="fas fa-download"></i> </button> &nbsp;';
                        }

                    });
                    $("#view_word").html(word);

                    var excel = "";
                    data.file_pengajuan_excel = data.file_pengajuan_excel.split("!!!");
                    $.each(data.file_pengajuan_excel, function(i, item) {

                        if (item !== "") {
                            i++;
                            excel += '<button class="btn btn-success btn-xs download" data-file="' + item + '" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel ' + i + '"> <i class="fas fa-download"></i> </button> &nbsp;';
                        }

                    });
                    $("#view_excel").html(excel);
                },
            });

            // window.location.href = "<?php echo base_url("Pengajuan/detail?pengajuan=") ?>" + id;
        });

        $(document).on("click", ".susun", function() {
            var id = $(this).data("id");

            window.location.href = "<?php echo base_url("Pengajuan/penyusunan?pengajuan=") ?>" + id;
        });

        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            var judul = $(this).data("judul");
            var url = "<?php echo base_url("Pengajuan/hapus?pengajuan=") ?>" + id;

            Swal.fire({
                title: 'Hapus Data Pengajuan ' + judul + '?',
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

                            if (data != "1") {
                                Swal.fire(
                                    'Error!',
                                    'Hapus Data Pengajuan ' + judul + ' gagal',
                                    'error'
                                )
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    'Hapus Data Pengajuan ' + judul + ' berhasil.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "<?php echo base_url("Pengajuan"); ?>";
                                });
                            }
                        },
                    });
                }
            })
        });

        $(document).on("click", ".list-susun", function() {
            var pengajuan = $(this).data("id");

            window.location.href = "<?php echo base_url("Pengajuan/penyusunan_list?pengajuan=") ?>" + pengajuan;
        });

        // MENU DISPOSISI
        var isi = 0;
        var diteruskan = 0;
        $(document).on("click", ".disposisi", function() {
            var judul = $(this).data("judul");
            var pengajuan = $(this).data("pengajuan");
            var status = $(this).data("status");
            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + pengajuan;

            // $("#disposisi_header").html(judul);
            $("#disposisi_pengajuan").val(pengajuan);
            $("#disposisi_status").val(status);

            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    data = JSON.parse(data);
                    $("#dis_jenis").html(data.jenis_pengajuan_text);
                    $("#dis_judul").html(data.judul);
                    $("#dis_nama").html(data.nama);

                    $("#dis_jabatan").html(data.jabatan);
                    $("#dis_nomor").html(data.nomor_hp);
                    $("#dis_jumlah").html(data.jumlah_prokum);
                },
            });
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

        $(document).on("change", ".diteruskan", function() {
            $(".diteruskan").prop("checked", false);
            $(this).prop("checked", true);

            if (diteruskan > 0) {
                if ($(this).prop("checked") === true) {
                    diteruskan++;
                } else if ($(this).prop("checked") === false) {
                    diteruskan--;
                }
            } else {
                if ($(this).prop("checked") === true) {
                    diteruskan++;
                }
            }

            if (diteruskan === 0) {
                $("#err_diteruskan_ke").show();
            } else {
                $("#err_diteruskan_ke").hide();
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
            // var check = ["disposisi_status", "disposisi_perihal"];
            var check = ["disposisi_status"];
            if ($("#disposisi_check_keterangan").prop("checked") === true) {
                check.push("disposisi_keterangan");
            }

            if (isi === 0) {
                $("#err_disposisi_isi").show();
            } else {
                $("#err_disposisi_isi").hide();
            }

            if (diteruskan === 0) {
                $("#err_diteruskan_ke").show();
            } else {
                $("#err_diteruskan_ke").hide();
            }

            if (checkThis(check) == 0 && isi > 0 && diteruskan > 0) {
                $("#disposisi_form").submit();
            }
        });

        $("#disposisi_form").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#disposisi_form")[0]);

            // console.log(form_data);
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

                    if (data == 1) {
                        Swal.fire(
                            'Sukses!',
                            'Pengajuan Produk Hukum telah diterima.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else if (data == 0) {
                        Swal.fire(
                            "Error!",
                            "Pengajuan Produk Hukum gagal diterima.",
                            "error"
                        );
                    }
                }
            });
        });

        $(document).on("click", ".view-disposisi", function() {
            var disposisi = $(this).data("disposisi");
            var judul = $(this).data("judul");

            $.ajax({
                url: "<?php echo base_url("Pengajuan/get_disposisi_byid?disposisi="); ?>" + disposisi,
                type: "get",
                beforeSend: function(x) {
                    $(".loading").show();
                },
                processData: false,
                contentType: false,
                success: function(data) {
                    $(".loading").hide();

                    var disposisi = JSON.parse(data);
                    // console.log(disposisi);

                    $("#vidis_header").html(judul);

                    $("#vidis_jenis").html(disposisi.pengajuan_jenis_text);
                    $("#vidis_judul").html(disposisi.pengajuan_judul);
                    $("#vidis_nama").html(disposisi.pengajuan_nama);

                    $("#vidis_jabatan").html(disposisi.pengajuan_jabatan);
                    $("#vidis_nomor").html(disposisi.pengajuan_nomor_hp);
                    $("#vidis_jumlah").html(disposisi.pengajuan_prokum);

                    if (disposisi.is_penyusunan == 1) $("#vidis_penyusunan").attr("checked", true);
                    else $("#vidis_penyusunan").attr("checked", false);

                    if (disposisi.is_bantuan == 1) $("#vidis_bantuan").attr("checked", true);
                    else $("#vidis_bantuan").attr("checked", false);

                    if (disposisi.is_administrasi == 1) $("#vidis_administrasi").attr("checked", true);
                    else $("#vidis_administrasi").attr("checked", false);

                    $("#vidis_perihal").val(disposisi.perihal);

                    if (disposisi.is_kordinasikan == 1) $("#vidis_koordinasikan").attr("checked", true);
                    else $("#vidis_koordinasikan").attr("checked", false);

                    if (disposisi.is_selesaikan == 1) $("#vidis_selesaikan").attr("checked", true);
                    else $("#vidis_selesaikan").attr("checked", false);

                    if (disposisi.is_tindak_lanjuti == 1) $("#vidis_tindak_lanjuti").attr("checked", true);
                    else $("#vidis_tindak_lanjuti").attr("checked", false);

                    if (disposisi.is_proses_ketentuan == 1) $("#vidis_proses_sesuai").attr("checked", true);
                    else $("#vidis_proses_sesuai").attr("checked", false);

                    if (disposisi.is_laporan == 1) $("#vidis_buatkan_laporan").attr("checked", true);
                    else $("#vidis_buatkan_laporan").attr("checked", false);

                    if (disposisi.is_bicarakan == 1) $("#vidis_bicarakan").attr("checked", true);
                    else $("#vidis_bicarakan").attr("checked", false);

                    if (disposisi.keterangan != null) {
                        $("#vidis_check_keterangan").attr("checked", true);
                        $("#div_vidis_keterangan").show();
                        $("#vidis_keterangan").val(disposisi.keterangan);
                    } else {
                        $("#vidis_check_keterangan").attr("checked", false);
                        $("#div_vidis_keterangan").hide();
                        $("#vidis_keterangan").val("");
                    }
                }
            });
        });

        // RESEPIONIS - ASSIGN/TERUSKAN
        $(document).on("click", ".assign", function() {
            var id = $(this).data("id");
            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + id;
            // var judul = $(this).data("judul");

            $("#ass_simpan").hide();
            $("#ass_back_simpan").hide();

            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    data = JSON.parse(data);

                    $("#ass_title").html("Melanjutkan Surat Pengajuan ke Kepala Bagian");
                    $("#ass_id").val(data.id);
                    $("#ass_header").html(data.user_full_name);

                    $("#ass_jenis").html(data.jenis_pengajuan_text);
                    $("#ass_judul").html(data.judul);
                    $("#ass_nama").html(data.nama);

                    $("#ass_jabatan").html(data.jabatan);
                    $("#ass_nomor").html(data.nomor_hp);
                    $("#ass_jumlah").html(data.jumlah_prokum);

                    $("#ass_simpan").show();
                },
            });
        });

        $(document).on("click", "#ass_simpan", function() {
            var pengajuan = $("#ass_id").val();
            var judul = $("#ass_judul").html();
            var url = "<?php echo base_url("Pengajuan/assign?pengajuan=") ?>" + pengajuan;

            Swal.fire({
                title: 'Teruskan Data Pengajuan ' + judul + ' ke Kabag?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Teruskan',
                confirmButtonColor: "#007bff",

                cancelButtonText: 'Batal',
                cancelButtonColor: "#dc3545",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data != "1") {
                                Swal.fire(
                                    'Error!',
                                    'Proses gagal dilakukan.',
                                    'error'
                                )
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    'Proses berhasil dilakukan.',
                                    'success'
                                ).then((result) => {
                                    window.location.href = "<?php echo base_url("Pengajuan"); ?>";
                                });
                            }
                        },
                    });
                }
            });
        });

        // RESEPIONIS - DIKEMBALIKAN
        $(document).on("click", ".verificator", function() {
            var pengajuan = $(this).data("id");
            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + pengajuan;

            $("#ass_simpan").hide();
            $("#ass_back_simpan").hide();

            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    data = JSON.parse(data);

                    $("#ass_title").html("Pengembalian Surat Pengajuan ke " + data.user_full_name);
                    $("#ass_id").val(data.id);

                    $("#ass_jenis").html(data.jenis_pengajuan_text);
                    $("#ass_judul").html(data.judul);
                    $("#ass_nama").html(data.nama);

                    $("#ass_jabatan").html(data.jabatan);
                    $("#ass_nomor").html(data.nomor_hp);
                    $("#ass_jumlah").html(data.jumlah_prokum);

                    $("#ass_back_simpan").show();
                },
            });
        });

        $(document).on("click", "#ass_back_simpan", function() {
            var pengajuan = $("#ass_id").val();
            var judul = $("#ass_judul").html();
            var url = "";

            Swal.fire({
                title: 'Masukkan Keterangan untuk Pengembalian ' + judul,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: 'Kembalikan',
                confirmButtonColor: "#dc3545",

                cancelButtonText: 'Batal',
                cancelButtonColor: "#007bff",
                preConfirm: (text) => {
                    url = "<?php echo base_url("Pengajuan/verification?status=2&pengajuan=") ?>" + pengajuan + "&keterangan=" + text;

                    $.ajax({
                        url: url,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == "1") {
                                Swal.fire(
                                    'Dikembalikan!',
                                    'Proses Pengajuan Prokum berhasil dikembalikan.',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal.fire(
                                    'Error!',
                                    'Proses Pengajuan Prokum gagal dikembalikan.',
                                    'error'
                                );
                            }
                        },
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            // if (status == 2) {
            // }
        });

        // JUMLAH
        $(document).on("click", ".view-jumlah", function() {
            var diajukan = $(this).data("prokum");
            var diproses = $(this).data("proses");
            var dikembalikan = $(this).data("kembali");

            $("#jum_pengajuan").html(diajukan);
            $("#jum_proses").html(diproses);
            $("#jum_kembali").html(dikembalikan);
        });
    });
</script>