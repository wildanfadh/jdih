<script>
    $.fn.dataTable.ext.order['dom-text'] = function(settings, col) {
        return this.api().column(col, {
            order: 'index'
        }).nodes().map(function(td, i) {
            console.log($('span', td).html());

            return $('span', td).html();
        });
    }

    $(document).ready(function() {
        var tab_url = "<?php echo base_url("Pengajuan/penyusunan_report_ajax?pengajuan=a&paraf=$paraf"); ?>";
        <?php if ($pengajuan != "a") { ?>
            tab_url = "<?php echo base_url("Pengajuan/penyusunan_report_ajax?pengajuan=" . $pengajuan["id"] . "&paraf=$paraf"); ?>";
        <?php } ?>

        // PESAN KETERANGAN
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
        // PESAN KETERANGAN

        $("#tab_penyusunan").DataTable({
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
                "url": tab_url,
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
                <?php if ($pengajuan == "a") { ?> {
                        "data": "pengajuan_nama"
                    },
                <?php }

                if (!empty($opd)) { ?> {
                        "data": "user_full_name"
                    },
                <?php } ?> {
                    "data": "status",
                    // "orderDataType": "dom-text",
                    // "type": 'string'
                },
                {
                    "data": "aksi",
                },
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": <?php echo ($pengajuan == "a") ? (!empty($opd) ? 5 : 4) : 3; ?>,
            }, {
                "orderable": false,
                "targets": <?php echo ($pengajuan == "a") ? (!empty($opd) ? 6 : 5) : 4; ?>,
            }, ]
        });

        // VIEW PDF
        $(document).on("click", ".view-pdf", function() {
            var file = $(this).data("file");

            $("#modal_pdf").modal("show");
            var path = "<?php echo base_url("uploads/PENGAJUAN_PROKUM"); ?>";

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(".close").click(function() {
            $("#modal_pdf").hide();
        });

        $(".download").click(function(event) {
            event.preventDefault();
            var file = $(this).data("file");

            url = "<?php echo base_url("uploads/PENGAJUAN_PROKUM/"); ?>" + file;
            window.open(url, "_blank");
        });

        $(document).on("click", ".view-pengembalian", function() {
            var file = $(this).data("file");
            swal.close();

            $("#modal_pdf").modal("show");
            var path = "<?php echo base_url("uploads/PENGEMBALIAN_PENYUSUNAN"); ?>";

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });

        $(document).on("click", ".view-prokum", function() {
            var file = $(this).data("file");
            swal.close();

            $("#modal_pdf").modal("show");
            var path = "<?php echo base_url("uploads/PROKUM_DRAFT"); ?>";

            PDFObject.embed(path + "/" + file, "#view_pdf");
        });
        // VIEW PDF

        $(document).on("click", "#btn_tambah_penyusunan", function() {
            var id = $(this).data("id");

            window.location.href = "<?php echo base_url("Pengajuan/penyusunan?pengajuan=") ?>" + id;
        });

        $("#daftar_select").change(function() {
            var status = $(this).val();
            var opd = $("#opd_select").val();

            <?php if ($pengajuan != "a") { ?>
                $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_report_ajax?pengajuan=" . $pengajuan["id"] . "&paraf=$paraf"); ?>&status=" + status + "&opd=" + opd).load();
            <?php } else { ?>
                $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_report_ajax?pengajuan=a&paraf=$paraf&status="); ?>" + status + "&opd=" + opd).load();
            <?php } ?>
        });

        $("#opd_select").change(function() {
            var status = $("#daftar_select").val();
            var opd = $(this).val();

            var paraf = $("#paraf_select").val();
            if (paraf > 0) {
                <?php if ($pengajuan != "a") { ?>
                    $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_report_ajax?pengajuan=" . $pengajuan["id"] . "&paraf="); ?>" + paraf + "&opd=" + opd).load();
                <?php } else { ?>
                    $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_report_ajax?pengajuan=a&paraf="); ?>" + paraf + "&opd=" + opd).load();
                <?php } ?>
            } else {
                <?php if ($pengajuan != "a") { ?>
                    $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_report_ajax?pengajuan=" . $pengajuan["id"] . "&paraf=$paraf"); ?>&status=" + status + "&opd=" + opd).load();
                <?php } else { ?>
                    $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_report_ajax?pengajuan=a&paraf=$paraf&status="); ?>" + status + "&opd=" + opd).load();
                <?php } ?>
            }

        });

        $("#paraf_select").change(function() {
            var opd = $("#opd_select").val();
            var paraf = $(this).val();

            <?php if ($pengajuan != "a") { ?>
                $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_ajax?pengajuan=" . $pengajuan["id"] . "&paraf="); ?>" + paraf + "&opd=" + opd).load();
            <?php } else { ?>
                $("#tab_penyusunan").DataTable().ajax.url("<?= base_url("Pengajuan/penyusunan_ajax?pengajuan=a&paraf="); ?>" + paraf + "&opd=" + opd).load();
            <?php } ?>
        });

        $("#tambah_pengajuan").click(function() {
            window.location.href = "<?php echo base_url("Pengajuan/tambah") ?>";
        });

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
            var file = $(this).data("file");

            $("#mod_id").val(id);
            $("#mod_ubah_header").html(urut);
            $("#mod_judul").val(judul);
            $("#mod_status").val(status);
            $("#mod_keterangan").val(keterangan);

            $("#mod_div_file_keterangan").hide();
            // if (file !== "") {
            if (status == <?= PENYUSUNAN_KEMBALI ?>) {
                $("#mod_div_file_keterangan").show();
            }
        });

        $(document).on("click", ".view", function() {
            var pengajuan = $(this).data("pengajuan");
            var urut = $(this).data("urut");
            var judul = $(this).data("judul");
            var status = $(this).data("status");
            var keterangan = $(this).data("keterangan");
            var file = $(this).data("file");

            var penyusunan = $(this).data("id");
            var otoritas = $(this).data("otoritas");

            $("#view_status").html(status);

            $("#view_judul").html(judul);
            $("#view_keterangan").html(keterangan);
            $("#view_urut").html(urut);

            $(".paraf-kabag").hide();
            if (status === <?= PENYUSUNAN_DRAFT ?>) {
                $(".paraf-kabag").show();
                $("#view_id").val(penyusunan);
                $("#view_otoritas").val(otoritas);
            }

            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + pengajuan;
            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    result = JSON.parse(data);

                    $("#view_jenis").html(result.jenis_pengajuan_text);
                    $("#view_perihal").html(result.judul);

                    $("#view_nama").html(result.nama);
                    $("#view_jabatan").html(result.jabatan);

                    $("#view_opd").html(result.user_full_name);
                    $("#view_nomor").html(result.nomor_hp);

                    var surat = "";
                    var tambahan = "";
                    result.file_pengajuan_tambahan = result.file_pengajuan_tambahan.split("!!!");
                    $.each(result.file_pengajuan_tambahan, function(i, item) {

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
                    result.file_pengajuan_word = result.file_pengajuan_word.split("!!!");
                    $.each(result.file_pengajuan_word, function(i, item) {

                        if (item !== "") {
                            i++;
                            word += '<button class="btn btn-primary btn-xs download" data-file="' + item + '" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word ' + i + '"> <i class="fas fa-download"></i> </button> &nbsp;';
                        }

                    });
                    $("#view_word").html(word);

                    var excel = "";
                    result.file_pengajuan_excel = result.file_pengajuan_excel.split("!!!");
                    $.each(result.file_pengajuan_excel, function(i, item) {

                        if (item !== "") {
                            i++;
                            excel += '<button class="btn btn-success btn-xs download" data-file="' + item + '" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel ' + i + '"> <i class="fas fa-download"></i> </button> &nbsp;';
                        }

                    });
                    $("#view_excel").html(excel);
                },
            });
        });

        $("#mod_simpan").click(function(event) {
            event.preventDefault();

            var check = ["mod_judul", "mod_status", "mod_keterangan, mod_file_keterangan"];
            if (checkThis(check) == 0) {
                $("#mod_ubah").submit();
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
                            'error'
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

        $(document).on("change", "#produk_file", function() {
            var i = $(this).prev('label').clone();

            var file = $("#produk_file")[0].files[0].name;

            $(this).prev('label').text(file);
        });

        $("#produk_simpan").click(function() {
            event.preventDefault();

            // var check = ["produk_hukum", "produk_file"];
            var check = ["produk_hukum"];
            if (checkThis(check) == 0) {
                $("#produk_form").submit();
            } else {
                directView();
            }
        });

        $("#produk_form").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#produk_form")[0]);

            $.ajax({
                url: "<?php echo base_url("Pengajuan/nomor_prokum"); ?>",
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
                            'Nomor Produk Hukum berhasil disimpan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Nomor Produk Hukum gagal disimpan.',
                            'error'
                        ).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        });

        $(document).on("click", ".lacak", function() {
            var penyusunan = $(this).data("id");

            window.location.href = "<?php echo base_url("Pengajuan/pelacakan?penyusunan=") ?>" + penyusunan;
        });

        // VIEW DOKUMEN PENGEMBALIAN
        $(document).on("click", ".status-back", function() {
            var keterangan = $(this).data("keterangan");
            var file = $(this).data("file");

            if (file !== "") {
                keterangan += "<br>";
                keterangan += '<button class="btn btn-sm btn-primary view-pengembalian" style="margin-top: 10px;" data-file="' + file + '">Lihat Dokumen Pengembalian</button>';
            }

            Swal.fire({
                type: "error",
                title: "Dikembalikan",
                html: keterangan,
                showConfirmButton: false,
            });
        });

        $(document).on("change", "#mod_file_keterangan", function() {
            var i = $(this).prev('label').clone();

            var file = $("#mod_file_keterangan")[0].files[0].name;

            $(this).prev('label').text(file);
        });

        $(document).on("change", "#mod_status", function() {
            $("#mod_div_file_keterangan").hide();
            if ($(this).val() == <?= PENYUSUNAN_KEMBALI ?>) {
                $("#mod_div_file_keterangan").show();
            } else {
                $("#mod_div_file_keterangan").hide();
            }
        });

        // PARAF CODE
        $(document).on("click", "#paraf_kabag_btn", function() {
            var penyusunan = $("#view_id").val();
            var otoritas = $("#view_otoritas").val();
            var judul = $("#view_judul").html();

            var paraf_url = "<?= base_url("Pengajuan/pengajuan_paraf") ?>?penyusunan=" + penyusunan;

            Swal.fire({
                title: "Ajukan Paraf " + judul + " ke Kabag",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Ajukan",
                cancelButtonText: 'Batal',
                cancelButtonColor: "#dc3545",
                confirmButtonColor: "#007bff",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: paraf_url,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == "1") {
                                Swal.fire(
                                    'Sukses!',
                                    'Pengajuan Paraf ke Kabag berhasil',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Pengajuan Paraf ke Kabag gagal',
                                    'error'
                                )
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".paraf", function() {
            var pengajuan = $(this).data("pengajuan");
            var penyusunan = $(this).data("id");
            var judul = $(this).data("judul");

            var urut = $(this).data("urut");
            var ready = $(this).data("ready");
            var nomor = $(this).data("nomor");
            var file_prokum = $(this).data("file");

            var kabag = $(this).data("kabag");
            var asisten = $(this).data("asisten");
            var sekda = $(this).data("sekda");
            var walikota = $(this).data("walikota");

            var status = $(this).data("status");

            $("#paraf_penyusunan").val(penyusunan);
            $("#produk_penyusunan").val(penyusunan);

            $("#paraf_judul").html(judul);
            $("#paraf_urut").html(urut);

            // enabling all option set to start
            $("#paraf_status").val("");
            $("#paraf_status option[value='<?= PERM_ASISTEN ?>']").removeAttr("disabled");
            $("#paraf_status option[value='<?= PERM_SEKDA ?>'][data-ttd=0]").removeAttr("disabled");
            $("#paraf_status option[value='<?= PERM_SEKDA ?>'][data-ttd=1]").removeAttr("disabled");
            $("#paraf_status option[value='<?= PERM_WALIKOTA ?>']").removeAttr("disabled");

            if (kabag == 1) {
                $("#paraf_kabag").attr("checked", true);
                $("#paraf_status option[value='<?= PERM_SEKDA ?>'][data-ttd=0]").attr("disabled", true);
            } else {
                $("#paraf_kabag").attr("checked", false);
            }

            if (asisten == 1) {
                $("#paraf_asisten").attr("checked", true);
                $("#paraf_status option[value='<?= PERM_ASISTEN ?>']").attr("disabled", true);
                $("#paraf_status option[value='<?= PERM_SEKDA ?>'][data-ttd=0]").removeAttr("disabled");
            } else {
                $("#paraf_asisten").attr("checked", false);
            }

            if (sekda == 1) {
                $("#paraf_sekda").attr("checked", true);
                $("#paraf_status option[value='<?= PERM_SEKDA ?>']").attr("disabled", true);
            } else {
                $("#paraf_sekda").attr("checked", false);
            }

            $("#paraf_status").attr("disabled", false);
            if (walikota == 1) {
                $("#paraf_walikota").attr("checked", true);
                $("#paraf_status").attr("disabled", true);
            } else {
                $("#paraf_walikota").attr("checked", false);
            }

            $("#view_produk").hide();
            $(".paraf-footer").show();
            $("#paraf_form").hide();
            $("#paraf_simpan").hide();

            $("#produk_form").hide();
            $("#produk_simpan").hide();

            $("#ready_simpan").hide();

            if (status == 3) {
                $("#produk_form").show();
                $("#produk_simpan").show();

                $(".modal-title").html("Pengisian Nomor Produk Hukum");
                // $("#paraf_header").html("(Prokum Siap diambil)");

                if (nomor !== "") {
                    $(".modal-title").html("Proses Penyusunan Produk Hukum Selesai");
                    // $(".modal-title").html("Produk Hukum Siap <small>(dengan Nomor <strong>" + nomor + "</strong>)</small>");

                    $("#paraf_form").hide();
                    $("#paraf_simpan").hide();

                    $("#produk_form").hide();
                    $("#produk_simpan").hide();

                    $(".paraf-footer").hide();
                    if (ready == 0) {
                        $("#ready_simpan").attr("data-penyusunan", penyusunan);
                        $(".paraf-footer").show();

                        $("#ready_simpan").show();
                    }

                    $("#view_produk").show();
                    $("#view_produk_nomor").html(nomor);

                    if (file_prokum != "") {
                        file_prokum = '<button class="btn btn-danger btn-xs view-prokum" data-file="' + file_prokum + '"> <i class="far fa-eye"></i> </button>';
                    } else {
                        file_prokum = "-";
                    }

                    $("#view_produk_file").html(file_prokum);
                }
            } else if (status == 1) {
                $("#paraf_form").show();
                $("#paraf_simpan").show();


                $(".modal-title").html("Paraf Penyusunan Produk Hukum ");
            }

            // AMBIL DATA PENGAJUAN
            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + pengajuan;
            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    result = JSON.parse(data);

                    $("#paraf_jenis").html(result.jenis_pengajuan_text);
                    $("#paraf_nama").html(result.nama);
                    $("#paraf_jabatan").html(result.jabatan);

                    $("#paraf_perihal").html(result.judul);
                    $("#paraf_opd").html(result.user_full_name);
                    $("#paraf_nomor").html(result.nomor_hp);
                },
            });
        });

        $(document).on("click", "#ready_simpan", function() {
            var penyusunan = $(this).data("penyusunan");

            Swal.fire({
                title: "Apakah Anda ingin melanjutkan proses ini?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Lanjutkan",
                cancelButtonText: 'Batal',
                cancelButtonColor: "#dc3545",
                confirmButtonColor: "#007bff",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?= base_url("Pengajuan/ready_prokum?penyusunan=") ?>" + penyusunan,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == "1") {
                                Swal.fire(
                                    'Sukses!',
                                    'Produk Hukum Siap Diambil',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Proses Gagal, coba lagi!',
                                    'error'
                                )
                            }
                        },
                    });
                }
            });
        });

        $("#paraf_simpan").click(function() {
            event.preventDefault();

            var check = [];
            if ($("#paraf_status").prop("disabled")) {} else check = ["paraf_status"];

            if (checkThis(check) == 0) {
                $("#paraf_form").submit();
            }
        });

        $("#paraf_form").submit(function(event) {
            event.preventDefault();
            // var form_data = new FormData($("#paraf_form")[0]);

            var penyusunan = $("#paraf_penyusunan").val();
            var otoritas = $("#paraf_status").val();
            var ttd = $("#paraf_status").find(":selected").data("ttd");

            // alert(ttd);
            // return false;

            $.ajax({
                url: "<?php echo base_url("Pengajuan/paraf_penyusunan"); ?>",
                type: "post",
                data: {
                    penyusunan: penyusunan,
                    paraf: otoritas,
                    ttd: ttd,
                },
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    if (data == 1) {
                        Swal.fire(
                            'Sukses!',
                            'Paraf/Tanda tangan berhasil dilakukan.',
                            'success'
                        ).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Paraf/Tanda tangan gagal dilakukan.',
                            'error'
                        ).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        });

        var paraf_url = "";
        var text = "";
        var text_paraf = "";
        var judul_paraf = "";
        $(document).on("click", ".paraf-self", function() {
            var penyusunan = $(this).data("id");
            var urut = $(this).data("urut");
            var ready = $(this).data("ready");
            var nomor = $(this).data("nomor");
            var judul = $(this).data("judul");

            var kabag = $(this).data("kabag");
            var asisten = $(this).data("asisten");
            var sekda = $(this).data("sekda");
            var walikota = $(this).data("walikota");

            var otoritas = $(this).data("otoritas");

            if (otoritas == <?= PERM_KABAG ?>) {
                text = "Apakan Anda yakin akan memparaf Produk Hukum " + judul + " ini?";
                text_paraf = "Paraf";
            } else if (otoritas == <?= PERM_ASISTEN ?>) {
                text = "Apakan Anda yakin akan memparaf Produk Hukum " + judul + " ini?";
                text_paraf = "Paraf";
            } else if (otoritas == <?= PERM_SEKDA ?>) {
                text = "Apakan Anda yakin akan memparaf/menandatangani Produk Hukum " + judul + " ini?";
                text_paraf = "Paraf";
            } else if (otoritas == <?= PERM_WALIKOTA ?>) {
                text = "Apakan Anda yakin akan menandatangani Produk Hukum " + judul + " ini?";
                text_paraf = "Tanda Tangan";
            }

            judul_paraf = judul;
            paraf_url = "<?= base_url("Pengajuan/paraf_penyusunan") ?>?penyusunan=" + penyusunan + "&paraf=" + otoritas;

            // AMBIL DATA PENGAJUAN
            var pengajuan = $(this).data("pengajuan");
            var url = "<?= base_url("Pengajuan/get_detail_bypengajuan?pengajuan="); ?>" + pengajuan;
            $.ajax({
                url: url,
                beforeSend: function(x) {
                    $(".loading").show();
                },
                success: function(data) {
                    $(".loading").hide();

                    result = JSON.parse(data);

                    $("#self_judul").html(judul);
                    $("#self_urut").html(urut);

                    $("#self_jenis").html(result.jenis_pengajuan_text);
                    $("#self_nama").html(result.nama);
                    $("#self_jabatan").html(result.jabatan);

                    $("#self_perihal").html(result.judul);
                    $("#self_opd").html(result.user_full_name);
                    $("#self_nomor").html(result.nomor_hp);

                    var surat = "";
                    var tambahan = "";
                    result.file_pengajuan_tambahan = result.file_pengajuan_tambahan.split("!!!");
                    $.each(result.file_pengajuan_tambahan, function(i, item) {

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
                    $("#self_surat_pengajuan").html(surat);
                    $("#self_surat_tambahan").html(tambahan);

                    var word = "";
                    result.file_pengajuan_word = result.file_pengajuan_word.split("!!!");
                    $.each(result.file_pengajuan_word, function(i, item) {

                        if (item !== "") {
                            i++;
                            word += '<button class="btn btn-primary btn-xs download" data-file="' + item + '" data-toggle="tooltip" data-placement="top" title="File Pengajuan Word ' + i + '"> <i class="fas fa-download"></i> </button> &nbsp;';
                        }

                    });
                    $("#self_word").html(word);

                    var excel = "";
                    result.file_pengajuan_excel = result.file_pengajuan_excel.split("!!!");
                    $.each(result.file_pengajuan_excel, function(i, item) {

                        if (item !== "") {
                            i++;
                            excel += '<button class="btn btn-success btn-xs download" data-file="' + item + '" data-toggle="tooltip" data-placement="top" title="File Pengajuan Excel ' + i + '"> <i class="fas fa-download"></i> </button> &nbsp;';
                        }

                    });
                    $("#self_excel").html(excel);
                },
            });
        });

        $("#self_simpan").click(function() {
            paraf_url += "&ttd=0";
            text = "Apakan Anda yakin akan memaraf Produk Hukum " + judul_paraf + " ini?";

            Swal.fire({
                title: text,
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Paraf",
                cancelButtonText: 'Batal',
                cancelButtonColor: "#dc3545",
                confirmButtonColor: "#007bff",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: paraf_url,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == "1") {
                                Swal.fire(
                                    'Sukses!',
                                    'Paraf Data Penyusunan ' + judul_paraf + ' berhasil',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Paraf Data Penyusunan ' + judul_paraf + ' gagal',
                                    'error'
                                )
                            }
                        },
                    });
                }
            });
        });

        $("#self_simpan_ttd").click(function() {
            paraf_url += "&ttd=1";
            text = "Apakan Anda yakin akan menandatangani Produk Hukum " + judul_paraf + " ini?";

            Swal.fire({
                title: text,
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Tanda Tangani",
                cancelButtonText: 'Batal',
                cancelButtonColor: "#dc3545",
                confirmButtonColor: "#007bff",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: paraf_url,
                        beforeSend: function(x) {
                            $(".loading").show();
                        },
                        success: function(data) {
                            $(".loading").hide();

                            if (data == "1") {
                                Swal.fire(
                                    'Sukses!',
                                    'Tanda Tangan Data Penyusunan ' + judul_paraf + ' berhasil',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Tanda Tangan Data Penyusunan ' + judul_paraf + ' gagal',
                                    'error'
                                )
                            }
                        },
                    });
                }
            });
        });
    });
</script>