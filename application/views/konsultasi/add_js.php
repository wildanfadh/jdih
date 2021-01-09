<script>
    $(document).ready(function() {
        $(".text-summer").summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });

        $("#kirim").click(function() {
            $("#tambah_konsultasi").submit();
        });

        $("#tambah_konsultasi").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData($("#tambah_konsultasi")[0]);

            var check = ["subject", "message", "user"];
            if (checkThis(check) == 0) {
                $.ajax({
                    url: "<?php echo base_url("Konsultasi/tambah"); ?>",
                    type: "post",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    beforeSend: function(x) {
                        $(".loading").show();
                    },
                    success: function(data) {
                        $(".loading").hide();

                        if (data == 0 || $("#user").val() == "") {
                            Swal.fire(
                                "Error!",
                                "Pesan gagal dikirim.",
                                "error"
                            );
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Pesan telah dikirim.',
                                'success'
                            ).then((result) => {
                                window.location.href = "<?php echo base_url("Konsultasi"); ?>";
                            });
                        }
                    }
                });
            } else {
                directView();
            }
        });

        $("#simpan").click(function() {
            var form_data = new FormData($("#tambah_konsultasi")[0]);
            $.ajax({
                url: "<?php echo base_url("Konsultasi/save_draft"); ?>",
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
                            "Error!",
                            "Pesan gagal disimpan.",
                            "error"
                        );
                    } else {
                        Swal.fire(
                            'Sukses!',
                            'Pesan telah disimpan.',
                            'success'
                        ).then((result) => {
                            window.location.href = "<?php echo base_url("Konsultasi"); ?>";
                        });
                    }
                }
            });
        });
    });
</script>