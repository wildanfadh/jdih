<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('[data-mask]').inputmask();

        $('[data-mask]').inputmask();
        if ($("#status").find(':selected').val() != "") {
            var jenis = $("#status").find(':selected').attr("data-jenis");
            $("#" + jenis).show();
        }

        $("#ganti_file").click(function() {
            $("#file_upload").attr("disabled", false);
            $("#file_upload").click();
        });

        $("#status").change(function() {
            var jenis = $(this).find(':selected').attr("data-jenis");

            $("#berlaku").hide();
            $("#non-berlaku").hide();

            if ($(this).find(':selected').val() != "") {
                $("#" + jenis).show();
            }
        });

        $('#file_upload').change(function() {
            var i = $(this).prev('label').clone();

            if ($('#file_upload')[0].files.length != 0) {
                var file = $('#file_upload')[0].files[0].name;
                $(this).prev('label').text(file);
                $("#file_change").val("1");
            } else {
                $(this).prev('label').text("Pilih File");
                $("#file_change").val("0");
            }
        });

        $("#is_upload").change(function() {
            $("#upload_file").hide();
            $("#select_file").hide();

            if ($('input#is_upload').is(':checked')) {
                $("#upload_file").show();
            } else {
                $("#select_file").show();
            }
        });

        $("#tambah_prokum").submit(function(event) {
            event.preventDefault();

            var form_data = new FormData($("#tambah_prokum")[0]);
            var check = [
                "jenis",
                "noper",
                "tentang",
                "tahun",
                "halaman",
                "seri",
                "subjek",
                "status",
                "tg_penetapan",
                "tg_pengundangan",
                "lemari",
            ];

            var jenis = $($("#status")).find(':selected').attr("data-jenis");
            if (jenis == "berlaku") {
                check.push("status_sesuai");
            } else if (jenis == "non-berlaku") {
                check.push("status_judul");
            }

            if ($('input#is_upload').is(':checked')) {
                if ($("#file_change").val() != "2") {
                    check.push("file_upload");
                }

                // check.push("file_upload");
            } else {
                check.push("file_select");
            }

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Prokum/ubah"); ?>",
                    type: "post",
                    data: form_data,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0) {
                            Swal.fire(
                                "Error!",
                                "Jenis Produk Hukum gagal diubah.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Jenis Produk Hukum berhasil diubah.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Prokum?tipe=" . strtolower($prokum["tipe"])); ?>";
                            });
                        }
                    }
                });
            } else {
                directView();
            }
        });
    });
</script>