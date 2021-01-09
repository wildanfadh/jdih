<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('[data-mask]').inputmask();

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
            var file = $('#file_upload')[0].files[0].name;
            $(this).prev('label').text(file);
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
            // form_data.append("file", $("#tambah_prokum").prop("files")[0]);

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

            if ($('input#is_upload').is(':checked')) {
                check.push("file_upload");
            } else {
                check.push("file_select");
            }

            var jenis = $($("#status")).find(':selected').attr("data-jenis");
            if (jenis == "berlaku") {
                check.push("status_sesuai");
            } else if (jenis == "non-berlaku") {
                check.push("status_judul");
            }

            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Prokum/tambah"); ?>",
                    type: "post",
                    // data: $(this).serialize(),
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
                                "Jenis Produk Hukum gagal ditambahkan.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Jenis Produk Hukum telah ditambahkan.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Prokum?tipe=" . strtolower($tipe["full"])); ?>";
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