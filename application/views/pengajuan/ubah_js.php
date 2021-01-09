<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('[data-mask]').inputmask();

        $('#file_word').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_word')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#file_excel').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_excel')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $('#file_tambahan').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file_tambahan')[0].files[0].name;
            $(this).prev('label').text(file);
        });

        $("#jenis").change(function() {
            var jenis = $(this).val();

            if (jenis == <?php echo JENP_PERWALI ?>) {
                $(".file-tambahan").removeClass("hide");
            } else {
                $(".file-tambahan").addClass("hide");
            }
        });

        $(".change").click(function() {
            var tipe = $(this).data("tipe");
            var file = $(this).data("file");
            var status = $("#status_" + tipe).val();

            var text = "Ganti File";
            var text_uc = "Ganti File " + ucwords(tipe);

            $(this).removeClass("btn-danger");
            $(this).removeClass("btn-warning");

            if (status == 0) {
                status = 1;
                text = "Pilih File";

                $(this).addClass("btn-warning");
                $("#file_" + tipe).attr("disabled", false);
                $("#label_" + tipe).html(text_uc);
            } else if (status == 1) {
                status = 0;
                text = "Ganti File";

                $(this).addClass("btn-danger");
                $("#file_" + tipe).attr("disabled", true);
                $("#label_" + tipe).html(file);
            }

            $("#status_" + tipe).val(status);
            $("#change_" + tipe).html(text);
        });

        $("#ubah_pengajuan").submit(function(event) {
            event.preventDefault();

            var form_data = new FormData($("#ubah_pengajuan")[0]);
            var check = [
                "judul",
                "nama",
                "jabatan",
                "nomor",
                "jenis",
            ];

            if ($("#status_word") == "1") {
                check.push("file_word");
            }

            if ($("#status_excel") == "1") {
                check.push("file_excel");
            }

            if ($("#status_surat") == "1") {
                check.push("file_surat");
            }

            if ($("#jenis").val() == <?php echo JENP_PERWALI ?>) {
                if ($("#status_tambahan") == "1") {
                    check.push("file_tambahan");
                }
            }

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Pengajuan/ubah?pengajuan=" . $_GET["pengajuan"]); ?>",
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
                                'Pengajuan Produk Hukum telah ditambahkan.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Pengajuan"); ?>";
                            });
                        } else if (data == 2) {
                            Swal.fire(
                                "Error!",
                                "Upload Pengajuan Produk gagal.",
                                "error"
                            );
                        } else if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Pengajuan Produk Hukum gagal ditambahkan.",
                                "error"
                            );
                        }
                    }
                });
            } else {
                directView();
            }
        });
    });
</script>